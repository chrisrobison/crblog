(async function() {
    const $ = str => document.querySelector(str);
    const $$ = str => document.querySelectorAll(str);

    if (!window['app']) {
        window.app = app = {};
    }
    window.app = app = {
        ...window['app'],
        addData: function(data) {
            app.data.nav = data;
            console.dir(data);
            app.state.loaded = true;
            
            let navhtml = app.buildNav(data["sidemenu"]);
            return navhtml; 
        },
        init: async function() {
            let navjson = await app.getNav("nav/nav.json");
            app.addData(navjson);
            app.buildTopNav(navjson.topmenu);
            setInterval(function() { fixIframeHeight(); }, 5000);
            document.addEventListener("click", function() {
              setTimeout(function() { fixIframeHeight(); }, 2000);
            });
            jQuery('.content-wrapper').IFrame({
              onTabClick(item) {
                    console.log(`onTabClick`);
                    console.dir(item);
                    return item;
              },
              onTabChanged(item) {
                    console.log(`onTabChanged`);
                    console.dir(item);
                return item
              },
              onTabCreated(item) {
                    console.log(`onTabCreated`);
                    console.dir(item);
                return item
              },
              autoIframeMode: true,
              autoItemActive: true,
              autoShowNewTab: true,
              autoDarkMode: true,
              allowDuplicates: false,
              loadingScreen: 500,
              useNavbarItems: true
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
        getNav: async function(url="nav2.json") {
            let resp = await fetch(url);
            let data = await resp.json();
            
            if (data) {
              for (let item of data.sidemenu) {
                if (item._include) {
                  item._children = await app.getChildren(item._include);        
                  delete item._include;
                }
              }
            }

            return data;
        },
        getChildren: async function(file) {
            if (file) {
              let resp = await fetch(file);
              let children = await resp.json();
              
              for (let item of children) {
                if (item._include) {
                  item._children = await app.getChildren(item._include);
                  delete item._include;
                }
              }
              return children;
            }
        },
        buildTopNav: function(topmenu) {
            let out = `<li class="nav-item" style="margin-left:0.7rem;"><a class="nav-link" data-widget="pushmenu" onclick="saveMenuState()" href="#" role="button"><i class="fas fa-bars"></i></a></li>`;
            for (const item of topmenu) {
              out += `<li class="nav-item d-none d-sm-inline-block"><a href="${item.link}" class="nav-link">${item.title}</a></li>`;
            }
            $("#navbar-top-left").innerHTML = out;
            return out;
        },
        buildNav: function(tree) {
            let out = `<ul class="nav nav-treeview nav-pills nav-sidebar flex-column nav-child-indent nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">`;
            out += app.makeList(tree, true);
            out += `</ul>`;

            $("#sidemenu").innerHTML = out;
            jQuery("ul").Treeview();
            return out;
        },
        makeList: function(arr, noul=false, noicons=false) {
            let icos = noicons ? "icons-no" : "icons-yes";
            let out = (noul) ? "" : `<ul class="nav nav-treeview ${icos}">`;
            let target, haschild, hasinclude, toggle = '', arrow = `<i class="right fas fa-angle-left" onclick="parentElement.parentElement.parentElement.classList.toggle('menu-open');"></i>`;
            let mopen = 0;
            
            for (let i=0; i<arr.length; i++) {
                item = arr[i];
                if (!item['hidden']) {
                    haschild = item.hasOwnProperty("_children");
                    hasinclude = item.hasOwnProperty("_include");
                    if (!item.link) item.link = "#";
                    toggle = (haschild || hasinclude) ? arrow : "";
                    //menuopen = (!mopen && noul && haschild) ? " menu-open" : '';
                    menuopen = item.open ? " menu-open" : "";
                    target = (item.target) ? ` target="${item.target}"` : '';
                    let navicon = (item.icon.match(/\.(gif|png|jpg|svg)/)) ? `<img src="${item.icon}" class="nav-icon">` : `<i class="nav-icon ${item.icon}"></i>`;

                    if (noicons) {
                        navicon = " <i class='far fa-circle'></i> ";
                    }
                    out += `<li class="nav-item${menuopen}"><a href="${item.link}" ${target} title="${item.title} ${item.subtitle}" onclick="return app.doClick(this, event)" class="nav-link">${navicon}<p>${item.title}${toggle}</p></a>`;
                    
                    if (haschild) {
                        out += app.makeList(item["_children"], false, !item["_childicons"]);
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
            
            document.querySelectorAll(".fa-circle-dot")?.forEach(el=>{el.classList.remove("fa-circle-dot"); el.classList.add("fa-circle")});

            if (who) {
                if (who.closest(".icons-no")) {
                    who.querySelector("i").classList.remove("fa-circle");
                    who.querySelector("i").classList.add("fa-circle-dot");
                }
                let tgt = who.getAttribute("target");
                who.parentElement.classList.add("active");
                if (tgt == "_blank") {
                    window.open(who.getAttribute("href"), tgt);
                } else {
                    let href = who.getAttribute("href");
                    if (href !== "#") {
                        app.loadTab(who.getAttribute("href"), who.innerText, who.innerText.replace(/\W/g, ''), true, evt);
                    }
                    let ma = who.closest("li");
                    if (ma.querySelector("ul")) {
                      ma.classList.toggle("menu-open");
                    }
                }

            }
            setTimeout(function() { app.fixIframeHeight(); }, 1000);
            return false;
        },
        fixIframeHeight: function() {
            let  newheight = window.innerHeight -
                document.querySelector(".nav.navbar").getBoundingClientRect()['height'] -
                document.querySelector("nav.main-header").getBoundingClientRect()['height'];

            document.querySelectorAll("iframe").forEach(el=>{
                el.style.height = newheight + 'px';
            });
        },
        loadTab: function(url="home.html", tabtitle="New Tab", name="newtab", autoshow=true, evt) {
            if (evt) {
                evt.preventDefault();
                evt.stopPropagation();
            }
            let tab = document.querySelector(`#tab-${name}`);
            if (tab) {
                jQuery(`#tab-${name}`).trigger("click");
            } else if (url && tabtitle && name) {
                tabtitle = tabtitle.replace(/^([a-z])/, function(str) { return str.toUpperCase(); });

                app.state.tabs[name] = {id: `tab-${name}`, title: `${tabtitle}` };
                jQuery(".content-wrapper").IFrame('createTab', tabtitle, url, name, autoshow);
            }

            return false;
        }

    };

    app.init();
})();

