# crblog
Blog website for Christopher Robison (no wordpress!)

Site structure is as follows:

    assets/
        img/
        ...
    blog/
        markdown/
            ...
        <blog_entry>.html
        ...
    nav/
        nav.json
        <child_nav>.json
        ...
    incoming/
        <json_message>.json
        ...
    main.js
    index.html
    home.html

Navigation for both top and side is generated via javascript in main.js. 
main.js reads nav/nav.json, loading any includes or children and generates 
HTML lists containing standard anchor links that additionally have the 'click'
event handler captured and will programatically handling loading clicked navigation
items. This is done this way so search engines can still crawl the site easily 
and we don't lose any UI control.

Add more stuff here about blog/mkblogentry, creating new blog entries and 
anything else important.

