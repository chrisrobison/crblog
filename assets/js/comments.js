(function() {
  const $ = str => document.querySelector(str);
  const $$ = str => document.querySelectorAll(str);
  
  if (!window.app) {
    app = {};
  }

  app.comments = {
    data: {},
    state: {
      loaded: false
    },
    init() {
      let name = location.href.replace(/^.+\//, '').replace(/\.html$/, '');
      console.log(`page name: ${name}`);;
      
      try {
        fetch(`/crblog/blog/comment.php?page=${name}`).then(r=>r.json()).then(data=>{
          app.comments.comments = data;
          app.comments.buildComments(data);
          console.log(`Retrieved ${name}.json`);
          console.dir(data);
        });
      } catch(e) {
        console.log(`No comments file found for ${name}`);
        console.dir(e);
      }
      app.comments.state.loaded = true;
    },
    mkcomment(obj, key='1', pid='0') {
      let item = `
 <li class='comment-item' data-key='${key}' data-parentid='${pid}'>
  <div class='comment-head'>
      <div class='commenter'>${obj.name}</div><div class='comment-date'>${obj.date}</div>
  </div>
  <p class='comment'>${obj.comment}</p><div class='reply-wrap'><span class='comment-tools'></span> <a class='reply-link' href='#' onclick='app.comments.reply(this, event, "${key}");return false'>Reply →</a></div>`;
      return item; 
    },
    fetch(url, callback) {
      fetch(url).then(response=>response.json()).then(data=>{
          app.comments.data = data;
          app.comments.state.loaded = true;
          if (callback && typeof(callback) === "function") {
              callback(data);
          }
      });
    },
    postComment(who, evt) {
      if (evt) {
        evt.stopPropagation();
        evt.preventDefault();
      }
      let tgt;
      if (who) {
        tgt = who.closest("#commentFormWrap");
      }

      if (!tgt) {
        tgt = document.querySelector("#comment-form");
      }

      let pid = tgt.dataset._parent;
      let post = {
        email: tgt.querySelector("#comment-email")?.value,
        name: tgt.querySelector("#comment-name")?.value,
        site: tgt.querySelector("#comment-website")?.value,
        comment: tgt.querySelector("#comment-comment")?.value,
        date: app.comments.getDate()
      };
      
      /**
       * TODO: All this should be a recursive function that accepts a reference to the next level of comments
       * and recurses each level's replies. As it stands, there is too much hard-coded dereferencing and
       * it currently only handles nested comments 4 levels deep. This limit is imposed on the client by
       * not providing a reply link to comments that are nested too deep.
       *
       * something like the following: 
       *
       * function doComments(comments, pid, post) {
       *    let pids = pid.split(/\./);
       *    let curlvl = pids.shift();
       *    if (pids.length === 1) {
       *      if (!comments.replies) {
       *        comments.replies = [];
       *      }
       *      comments.replies[] = post;
       *    }
       *
       *    if (comments[curlvl] && comments[curlvl].replies) {
       *      app.doComments(comments[curlvl].replies, pids, post);
       *    }
       *    return out;
       * }
       * */
      let pids = pid.split(/\./);
      if ((pid == 0) || (!pid)) {
        post._id = (app.comments.comments.length + 1).toString();    // set to length of array + 1 (so we don't start at zero)
        post._parent = "0";
        app.comments.comments.push(post); 
      } else if (pids.length === 1) {
        let idx = parseInt(pids[0]) - 1;
      
        if (!app.comments.comments[idx]) {
          app.comments.comments[idx] = post;
        }
        if (!app.comments.comments[idx].replies) {
          app.comments.comments[idx].replies = [ ];
        }
        post._id = (parseInt(pid) + 1) + "." + (app.comments.comments[idx].replies.length + 1);
        post._parent = parseInt(pid) + 1;
        app.comments.comments[idx].replies.push(post);
      } else if (pids.length === 2) {
        let idx1 = parseInt(pids[0]) - 1,
            idx2 = parseInt(pids[1]) - 1;

        if (!app.comments.comments[idx1].replies[idx2].replies) {
          app.comments.comments[idx1].replies[idx2].replies = [];
        }

        post._id = pid + "." + (app.comments.comments[idx1].replies[idx2].replies.length + 1);
        post._parent = pid;
        app.comments.comments[idx1].replies[idx2].replies.push(post);
      } else if (pids.length === 3) {
        let idx1 = parseInt(pids[0]) - 1,
            idx2 = parseInt(pids[1]) - 1,
            idx3 = parseInt(pids[2]) - 1;

        if (!app.comments.comments[idx1].replies[idx2].replies[idx3].replies) {
          app.comments.comments[idx1].replies[idx2].replies[idx3].replies = [];
        }

        post._id = pid + "." + (app.comments.comments[idx1].replies[idx2].replies[idx3].length + 1);
        post._parent = pid;
        app.comments.comments[idx1].replies[idx2].replies[idx3].replies.push(post);
      } else if (pids.length === 4) {
        let idx1 = parseInt(pids[0]) - 1,
            idx2 = parseInt(pids[1]) - 1,
            idx3 = parseInt(pids[2]) - 1,
            idx4 = parseInt(pids[3]) - 1;

        if (!app.comments.comments[idx1].replies[idx2].replies[idx3].replies[idx4].replies) {
          app.comments.comments[idx1].replies[idx2].replies[idx3].replies[idx4].replies = [];
        }

        post._id = pid + "." + (app.comments.comments[idx1].replies[idx2].replies[idx3].replies[idx4].length + 1);
        post._parent = pid;
        app.comments.comments[idx1].replies[idx2].replies[idx3].replies[idx4].replies.push(post);
      }

      let page = location.href.replace(/^.*\//, '').replace(/.html/, '');
        fetch("comment.php?x=save&page="+page, {
          method: 'POST',
          body: JSON.stringify(app.comments.comments),
          headers: {
            "Content-type": "application/json; charset=UTF-8"
          }
        }).then(resp=>resp.json()).then(data=>{
          app.comments.buildComments(data);
        });
      console.dir(app.comments.comments);
      console.log(`New comment:`);
      console.dir(post);
      let replywrap = tgt.closest("#commentFormWrap");
      if (replywrap) {
        replywrap.parentNode.removeChild(replywrap);
      } else {
        tgt.querySelector("#comment-email").value = "";
        tgt.querySelector("#comment-name").value = "";
        tgt.querySelector("#comment-website").value = "";
        tgt.querySelector("#comment-comment").value = "";
      }
    },
    buildComments(arr, ul) {
      if (!ul) ul = document.querySelector("ul.comment-reply");
      if (!ul) {
        ul = document.createElement("ul");
        ul.className = "comment-reply";
        document.querySelector("#comment-comments").append(ul);
      }    
      let out = "";
      for (let i=0; i<arr.length; i++) {
        out += app.comments.mkcomment(arr[i], arr[i]._id, arr[i]._parent);
        if (arr[i].replies) {
          out += app.comments.buildComments(arr[i].replies); 
        }
        out += `</li>`;
      }
      ul.innerHTML = out;
      return ul.outerHTML;
    },
    getParentComment(comments, pid, tgt, post) {
       let pids = pid.split(/\./);
       let curlvl = pids.shift();
       let myid;
       if (pids.length === 1) {
         if (!comments.replies) {
           comments.replies = [];
         }
         
         myid = tgt + '.' + (comments.replies.length + 1);
         post._id = myid;
         post._parent = tgt;
         comments.replies.push(post);
         return myid;
       }

       if (comments[curlvl] && comments[curlvl].replies) {
         myid = app.getParentComment(comments[curlvl].replies, pids, tgt, post);
       }
       return myid;
    },
    findParent(id, tree) {
      for (let k in tree) {
        if (tree[k]._id === id) {
          
        }
      }
    },
    getDate() {
      let now = new Date();
      let hr = now.getHours();
      let xm = "am";

      if (hr > 12) {
        xm = "pm";
        hr -= 12;
      }

      return now.getFullYear() + '-' + (now.getMonth() + 1) + '-' + now.getDate() + ' ' + hr + ':' + now.getMinutes() + xm;
    },
    reply(who, evt, pid='0') {
      if (evt) {
        evt.stopPropagation();
        evt.preventDefault();
      }
      let cwrap = $("#commentFormWrap");
      if (cwrap) {
        cwrap.parentNode.removeChild(cwrap);
      }
      app.comments.data.commentForm = $("#comment").outerHTML;
      let wrap = document.createElement("div");
      wrap.id = "commentFormWrap";
      wrap.dataset._parent = pid;
      wrap.innerHTML = app.comments.data.commentForm;
      wrap.querySelector("#comment").id = "reply";
      
      who.parentNode.append(wrap);

      return false;
    },
    display(data, tgt) {
      let out = "<table><thead><tr>";
      const keys = Object.keys(data[0]);
      if (keys) {
          keys.forEach(key => {
              out += `<th>${key}</th>`;
          });
      }
      out += "</tr></thead><tbody>";
      data.forEach(item=>{
          out += `<tr>`;
          keys.forEach(key => {
              out += `<td>${item[i]}</td>`;
          });
          out += `</tr>`;
      });
      out += "</tbody></table>";

      if (tgt) {
        tgt.innerHTML = out;
      }
      return out;
    },
    cancelComment(who, evt) {
      let el = who.closest(".commentFormWrap");
      if (el) {
        el.parentNode.removeChild(el);
      }
    }
  }
  window.app = app;
  app.comments.init();
})();

