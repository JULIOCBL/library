(()=>{function t(t,n){var o="undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(!o){if(Array.isArray(t)||(o=function(t,n){if(!t)return;if("string"==typeof t)return e(t,n);var o=Object.prototype.toString.call(t).slice(8,-1);"Object"===o&&t.constructor&&(o=t.constructor.name);if("Map"===o||"Set"===o)return Array.from(t);if("Arguments"===o||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(o))return e(t,n)}(t))||n&&t&&"number"==typeof t.length){o&&(t=o);var a=0,r=function(){};return{s:r,n:function(){return a>=t.length?{done:!0}:{done:!1,value:t[a++]}},e:function(t){throw t},f:r}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var i,c=!0,l=!1;return{s:function(){o=o.call(t)},n:function(){var t=o.next();return c=t.done,t},e:function(t){l=!0,i=t},f:function(){try{c||null==o.return||o.return()}finally{if(l)throw i}}}}function e(t,e){(null==e||e>t.length)&&(e=t.length);for(var n=0,o=new Array(e);n<e;n++)o[n]=t[n];return o}document.addEventListener("DOMContentLoaded",(function(){getAuthors(),getEditorials(),window.getBook=function(e){var n=document.getElementById("editorial_id").value,o=document.getElementById("author_id").value,a=[];"*"!=n&&a.push({editorial_id:n}),"*"!=o&&a.push({author_id:o}),a=convertArrayToUrlParams(a);var r=url()+"/api/v1/books?"+a;void 0!==e&&(r=e),fetch(r,{headers:{"Content-Type":"application/json",Accept:"application/json, "},method:"GET"}).then((function(t){return t.json()})).then((function(e){var n=document.getElementById("list-books");if(n.innerHTML="",e.hasOwnProperty("data")){var o,i=t(e.data);try{for(i.s();!(o=i.n()).done;){var c=o.value;n.appendChild(item(c,r))}}catch(t){i.e(t)}finally{i.f()}}e.hasOwnProperty("links")&&paginator(e.links,a)})).catch((function(t){console.log(t)}))},getBook(),document.getElementById("editorial_id").addEventListener("change",(function(){getBook()})),document.getElementById("author_id").addEventListener("change",(function(){getBook()})),window.item=function(t,e){var n=document.createElement("tr"),o=document.createElement("td"),a=document.createElement("td"),r=document.createElement("td"),i=document.createElement("td"),c=document.createElement("td"),l=document.createElement("td"),d=document.createElement("td");return o.textContent=t.id,a.textContent=t.title,r.textContent=t.description,i.textContent=t.year,c.textContent=t.author.name+" "+t.author.last_name,l.textContent=t.editorial.name,d.innerHTML='<a type="button" href="'.concat(url()+"/book/".concat(t.id),'" class="btn btn-success">Edit</a>\n        <a type="button" onclick="deleteBook(').concat(t.id,", '").concat(e,'\')" class="btn btn-danger">Delete</a>'),n.appendChild(o),n.appendChild(a),n.appendChild(r),n.appendChild(i),n.appendChild(c),n.appendChild(l),n.appendChild(d),n},window.paginator=function(t,e){var n=document.getElementById("paginate"),o="";for(var a in t){var r=t[a].active?"active":"",i=t[a].url+(0==e.length?"":"&"+e);0==a?o+='<li class="page-item">\n                <a class="page-link"onclick="getBook(\''.concat(i,'\')" aria-label="Previous">\n                    <span aria-hidden="true">&laquo;</span>\n                </a>\n            </li>'):a==t.length-1?o+='<li class="page-item">\n                <a class="page-link" onclick="getBook(\''.concat(i,'\')" aria-label="Next">\n                    <span aria-hidden="true">&raquo;</span>\n                </a>\n            </li>'):o+=' <li class="page-item"><a class="page-link '.concat(r,'" onclick="getBook(\'').concat(i,"')\" >").concat(t[a].label,"</a></li>")}n.innerHTML=o},window.deleteBook=function(t,e){fetch(url()+"/api/v1/books/"+t,{headers:{"Content-Type":"application/json",Accept:"application/json, "},method:"DELETE"}).then((function(t){return t.json()})).then((function(t){t.hasOwnProperty("data")&&(Swal.fire({icon:"success",title:"Your work has been saved",showConfirmButton:!1,timer:1500}),getBook(e))})).catch((function(t){console.log(t)}))}}))})();