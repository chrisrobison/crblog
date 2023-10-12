(function() {
    const $ = str => document.querySelector(str);
    const $$ = str => document.querySelectorAll(str);

    if (!window['app']) {
        window.app = app = {};
    }
    window.app = app = {
        ...window['app'],
        init: function() {
            fetch("nav.json").then(response=>response.json()).then(data=>{
                app.data.nav = data;
                console.dir(data);
                app.buildNav(data["sidemenu"]);
                app.state.loaded = true;
            });
        },
        state: {
            loaded: false
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
        buildNav: function(tree) {
            let out = `<ul class="nav nav-treeview nav-pills nav-sidebar flex-column nav-child-indent nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">`;
            out += app.makeList(tree, true);
            out += `</ul>`;

            $("#sidemenu").innerHTML = out;
            jQuery("ul").Treeview();
        },
        makeList: function(arr, noul=false) {
            let out = (noul) ? "" : `<ul class="nav nav-treeview">`;
            let target, haschild, toggle = '', arrow = `<i class="right fas fa-angle-left" onclick="parentElement.parentElement.parentElement.classList.toggle('menu-open');"></i>`;
            let mopen = 0;

            arr.forEach(item => {
                if (!item['hidden']) {
                    haschild = item.hasOwnProperty("_children");
                    toggle = (haschild) ? arrow : "";
                    //menuopen = (!mopen && noul && haschild) ? " menu-open" : '';
                    menuopen = item.open ? " menu-open" : "";
                    target = (item.target) ? ` target="${item.target}"` : '';
                    let navicon = (item.icon.match(/\.(gif|png|jpg|svg)/)) ? `<img src="${item.icon}" class="nav-icon">` : `<i class="nav-icon ${item.icon}"></i>`;
                    out += `<li class="nav-item${menuopen}"><a href="${item.link}" ${target} class="nav-link">${navicon}<p>${item.title}${toggle}</p></a>`;
                    if (haschild) {
                        out += app.makeList(item["_children"]);
                    }
                    out += "</li>";
                    mopen = 0;
                }
            });
            out += (noul) ? "" : "</ul>";
            return out;
        },
        confirmJob: function(id) {
            fetch("/portal/api.php?type=confirm&id="+id).then(r=>r.json()).then(data=>{
               console.log("Job confirmed");
               console.dir(data);
            });
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
            let cachebuster = new Date().getTime();

            jQuery(".content-wrapper").IFrame('createTab', title, url + `?bust=${cachebuster}`, name, autoshow);
            return false;
        }

    };

    app.init();
})();

