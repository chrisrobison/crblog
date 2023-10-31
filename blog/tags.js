let alltags = [];
(function() {
    let tags = {
        data: {},
        async init() {
            let sortedTags = await tags.gettags();
            let list = tags.buildlist(sortedTags);
            let out = document.createElement("div");
            out.style.position = "absolute";
            out.style.top = "5rem";
            out.style.right = "1rem";
            out.style.width = "10rem";
            out.innerHTML = "<h3>Tags</h3>";
            out.append(list);
            document.querySelector(".content-wrapper").append(out);
        },
        async gettags(file="posts.json") {
            let fetched = await fetch(file);
            let data = await fetched.json();
            tags.data = data;
            for (const post of data) {
                if (post.tags) {
                    let tags = post.tags.split(/\,\s*/);
                    console.dir(tags);
                    for (let i=0; i < tags.length; i++) {
                        let mytag = tags[i];
                        if (!alltags[mytag]) alltags[mytag] = 0;
                        alltags[mytag]++
                        console.log(`Added ${mytag} [${alltags[mytag]}]`);
                    }
                }
            }
            let sortedTags = Object.keys(alltags).sort();
            console.dir(sortedTags);
            return sortedTags;
        },
        buildlist(data) {
            let out = "";
            const thelist = document.createElement("ul");
            thelist.id = "taglist";

            for (item of data) {
                let el = document.createElement("li");
                el.style.listStyle = "none";
                el.innerHTML = `<a style="color:#222;" href='/crblog/blog/category.html?category=${item}'>${item} [${alltags[item]}]</a>`;
                thelist.appendChild(el);
            }
            return thelist;
        }
    };
    window.tags = tags;
    tags.init();
})();
