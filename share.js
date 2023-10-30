(function() {
    let share = {
         ...window.share,
        defaults: {
            url: location.href,
            title: document.title,
            user_id: "@thechrisrobison"
        },
        socialsites: [
            { "title": "LinkedIn", "link": "https://www.linkedin.com/sharing/share-offsite/?url={url}", "icon": "/crblog/assets/share-icons/linkedin.svg" },
            { "title": "HackerNews", "link": "https://news.ycombinator.com/submitlink?u={url}&t={title}", "icon": "/crblog/assets/share-icons/hackernews.svg" },
            { "title": "Reddit", "link": "https://reddit.com/submit?url={url}&title={title}", "icon": "/crblog/assets/share-icons/reddit.svg" },
            { "title": "Twitter", "link": "https://twitter.com/intent/tweet?url={url}&text={title}&via=@thechrisrobison&hashtags={hash_tags}", "icon": "/crblog/assets/share-icons/twitter.svg" },
            { "title": "Facebook", "link": "https://www.facebook.com/sharer.php?u={url}", "icon": "/crblog/assets/share-icons/facebook.svg" },
            { "title": "Email", "link": "mailto:someone@somewhere.com&subject={title}&body=Though you might find this interesting: <a href='{url}'>{title}</a>", "icon": "/crblog/assets/share-icons/email.svg" }
        ],
        init() {
        },
        showlist(evt) {
            if (evt) evt.preventDefault();
            let el = share.buildlist(share.socialsites);
            let sharehtml = share.createElement("div", "sharehtml", "sharehtml", 
                `<h2 style="width:100%;border-bottom:2px solid #fff;">Share<a title="Close Share Dialog" style="cursor:pointer;float:right;position:relative;top:-8px;" onclick="return share.closeshare()"><i class="fa-solid fa-circle-xmark"></i></a></h2>`, 
                {
                   top: (window.scrollY + (window.innerHeight * 0.25)) + 'px',
                }); 
            sharehtml.appendChild(el);
            let shareurl = share.createElement("input", "shareurl", "shareurl", "", { }, "text", location.href)
            shareurl.disabled = true;
            let copy = share.createElement("i", "", "fas fa-paste", "", { fontSize: "24px", textAlign: "right", width: "2rem" });
            copy.className = "fas fa-paste";
            copy.title = "Copy to Clipboard";
            copy.style.cursor = "pointer";
            copy.onclick = share.copy;
            
            let inputwrap = share.createElement("div", "", "", "", {}, "", "");
            inputwrap.appendChild(shareurl);
            inputwrap.appendChild(copy);
            sharehtml.appendChild(inputwrap);

            document.querySelector(".content-wrapper").appendChild(sharehtml);
            document.addEventListener("keydown", share.dokey);
            console.log("Loaded.");
            return false;
        },
        dokey(evt) {
            console.dir(evt);

            if (evt.keyCode === 27) {
                share.closeshare();
            }
        },
        closeshare() {
            let el = document.querySelector("#sharehtml");
            el.style.display = "none";
            el.parentElement.removeChild(el);
            return false;
        },
        createElement(tag="div", id, className, html, styles, type="", value="") {
            let el = document.createElement(tag);
            if (id) el.id = id;
            if (className) el.className = className;
            if (html) el.innerHTML = html;
            if (type) el.type = type;
            if (value) el.value = value;

            if (styles) {
                let keys = Object.keys(styles);
                for (const style of keys) {
                    el.style[style] = styles[style];
                }
            }
            return el;
        },
        copy(evt) {
            let el = document.querySelector("#shareurl");
            el.select();
            el.setSelectionRange(0, 999999);    // for mobile
            navigator.clipboard.writeText(el.value);
            share.copyval = el.value;

            el.value = "COPIED";
            el.style.textAlign = "center";
            el.style.backgroundColor = "#ffa";
            setTimeout(function() { let el = document.querySelector("#shareurl"); el.value = share.copyval; el.style.textAlign = "left", el.style.backgroundColor="#fff"; }, 2000);
        },
        buildlist(data) {
            let out = document.createElement("div");
            out.className = "sharelist";
            out.style.display = "flex";
            out.style.flexDirection = "row";
            out.style.width = "100%";
            out.style.justifyContent = "space-around";

            let linkout = { url: location.href, title: document.title };
            let link;
            for (let site of data) {
                link = site.link.replace(/\{([^\}]+)\}/g, function(match, p1) {
                    if (linkout[p1]) {
                        return encodeURIComponent(linkout[p1]);
                    }
                });
                let shortname = site.title.toLowerCase();
                out.innerHTML += `<a class="social-wrap shareicon ${shortname}" href="${link}" title="Share on ${site.title}" onclick="return share.share('${site.title}')"></a>`;
            }

            return out;
        },
        /**
         * share(who, { title: "title", url: "url", user_id: "user_id", hash_tags: "hash_tags" })
         * 
         **/
        share(who, obj) {
            if (!obj) obj = {};
            if (!obj.url) obj.url = location.href;
            if (!obj.title) obj.title = document.title;

            let socialsite = share.socialsites.find(function(obj) { return obj.title == who; });
            if (socialsite) {
               let link = socialsite.link.replace(/\{([^\}]+)\}/g, function(match, p1) {
                   console.log(`Matched ${p1}`);
                   console.dir(match);
                   return encodeURIComponent(obj[p1]);
                });
                console.log(`Link: ${link}`);
                window.open(link, "_blank");
            }
            return false;
        },
        state: { }

    };
    window.share = share;
    share.init();
    
})();
