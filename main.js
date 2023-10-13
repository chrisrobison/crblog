(async function() {
    const $ = str => document.querySelector(str);
    const $$ = str => document.querySelectorAll(str);

    if (!window['app']) {
        window.app = app = {};
    }
    window.app = app = {
        ...window['app'],
        addData: async function(data) {
                app.data.nav = data;
                console.dir(data);
                app.state.loaded = true;
                app.buildNav(data["sidemenu"]);
             
        },
        init: function() {
            fetch("nav.json").then(response=>response.json()).then(app.addData);
            jQuery(".content-wrapper").IFrame({ 
                onTabClick(item) {
                    console.log(`onTabClick`);
                    console.dir(item);
                    return item;
                },
                onTabChanged(item) {
                    console.log(`onTabChanged`);
                    console.dir(item);
                    return item;
                },
                onTabCreated(item) {
                    console.log(`onTabCreated`);
                    console.dir(item);
                    return item;
                },
                allowDuplicates: false
            });
        },
        state: {
            loaded: false,
            tabs: {},
            alltabs: []
        },
        data: {
            store: function(key, obj) {
                if (key && obj) {
                    localStorage.setItem(key, JSON.stringify(obj));
                }
            },
            get: function(key) {
                if (key) {
                    return JSON.parse(localStorage.getItem(key));
                }
            },
            nav: {}
        },
        buildNav: async function(tree) {
            let out = `<ul class="nav nav-treeview nav-pills nav-sidebar flex-column nav-child-indent nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">`;
            out += await app.makeList(tree, true);
            out += `</ul>`;

            $("#sidemenu").innerHTML = out;
            jQuery("ul").Treeview();
            return out;
        },
        makeList: async function(arr, noul=false, noicons=false) {
            let out = (noul) ? "" : `<ul class="nav nav-treeview">`;
            let target, haschild, hasinclude, toggle = '', arrow = `<i class="right fas fa-angle-left" onclick="parentElement.parentElement.parentElement.classList.toggle('menu-open');"></i>`;
            let mopen = 0;
            
            for (let i=0; i<arr.length; i++) {
                item = arr[i];
                if (!item['hidden']) {
                    haschild = item.hasOwnProperty("_children");
                    hasinclude = item.hasOwnProperty("_include");
                    if (!item.url) item.url = "#";
                    toggle = (haschild || hasinclude) ? arrow : "";
                    //menuopen = (!mopen && noul && haschild) ? " menu-open" : '';
                    menuopen = item.open ? " menu-open" : "";
                    target = (item.target) ? ` target="${item.target}"` : '';
                    let navicon = (item.icon.match(/\.(gif|png|jpg|svg)/)) ? `<img src="${item.icon}" class="nav-icon">` : `<i class="nav-icon ${item.icon}"></i>`;

                    if (noicons) {
                        navicon = " <i class='far fa-circle'></i> ";
                    }
                    out += `<li class="nav-item${menuopen}"><a href="${item.url}" ${target} onclick="return app.doClick(this, event)" class="nav-link">${navicon}<p>${item.title}${toggle}</p></a>`;
                    if (hasinclude) {
                        console.log(`grabbing ${item._include}`);
                        const resp = await fetch(item._include);
                        console.log("response");
                        console.dir(resp);
                        item["_children"] = await resp.json();
                        console.log("item children");
                        console.dir(item["_children"]);
                        haschild = 1;
                    }
                    if (haschild) {
                        out += await app.makeList(item["_children"], false, true);
                    }
                    out += "</li>";
                    mopen = 0;
                }
            };
            out += (noul) ? "" : "</ul>";
            return out;
        },
        doClick: function(who, evt) {
            if (evt) {
                evt.preventDefault();
                evt.stopPropagation();
            }

            if (who) {
                let tgt = who.getAttribute("target");
                if (tgt == "_blank") {
                    window.open(who.getAttribute("href"), tgt);
                } else {
                    let href = who.getAttribute("href");
                    if (href !== "#") {
                        app.loadTab(who.getAttribute("href"), who.innerText, who.innerText.replace(/\W/g, ''), true, evt);
                    }
                    who.parentElement.classList.toggle("menu-open");
                }

            }

            return false;
        },
        override: function(id) {
            console.log(`Switch business to BusinessID ${id}`);
            fetch("/portal/api.php?type=switch&bid="+id).then(r=>r.json()).then(data=>{
                console.log("Business ID override");
                console.dir(data);
                document.querySelectorAll("iframe").forEach(item=>{ item.contentWindow.location.reload() });
            });
        },
        switchUser: function(evt, email) {
            console.log(`Switch user to ${email}`);
            console.dir(evt);
            fetch("switch.php?email=" + email).then(r=>r.json()).then(data=>{
                console.log("switched user");
                console.dir(data);
                document.querySelectorAll("iframe").forEach(item=>{ item.contentDocument.location.reload() });
            });;
        },
        loadTab: function(url="home.html", title="New Tab", name="newtab", autoshow=true, evt) {
            //document.querySelector("#overlay").style.display = "block";
            //setTimeout(function() { document.querySelector("#overlay").style.display = "none"; }, 3000);

            if (evt) {
                evt.preventDefault();
                evt.stopPropagation();
            }
            let tab = document.querySelector(`#tab-${name}`);
            if (tab) {
                jQuery(`#tab-${name}`).trigger("click");
            } else {
                let cachebuster = new Date().getTime();
                app.state.tabs[name] = {id: `tab-${name}`, title: `${title}` };
                app.state.alltabs.push(jQuery(".content-wrapper").IFrame('createTab', title, url + `?bust=${cachebuster}`, name, autoshow));
            }
            return false;
        }

    };

    app.init();
})();

