document.addEventListener("DOMContentLoaded", function () {
    getAuthors();
    getEditorials();

    window.getBook = (pagination) => {
        let editorial = document.getElementById("editorial_id").value;
        let author = document.getElementById("author_id").value;
        let params = [];

        // Agregar elementos al array usando push

        if (editorial != "*") {
            params.push({ editorial_id: editorial });
        }

        if (author != "*") {
            params.push({ author_id: author });
        }

        params = convertArrayToUrlParams(params);
        let get_url = url() + "/api/v1/books?" + params;

        if (typeof pagination != "undefined") {
            get_url = pagination;
        }

        fetch(get_url, {
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json, ",
            },
            method: "GET",
        })
            .then((data) => {
                return data.json();
            })
            .then((data) => {
                let list_books = document.getElementById("list-books");
                list_books.innerHTML = "";

                if (data.hasOwnProperty("data")) {
                    for (const iterator of data.data) {
                        list_books.appendChild(item(iterator,get_url));
                    }
                }
                if (data.hasOwnProperty("links")) {
                    paginator(data.links, params);
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    };

    getBook();

    document
        .getElementById("editorial_id")
        .addEventListener("change", function () {
            getBook();
        });

    document
        .getElementById("author_id")
        .addEventListener("change", function () {
            getBook();
        });

    window.item = (data,get_url) => {
        let row = document.createElement("tr");

        let cell1 = document.createElement("td");
        let cell2 = document.createElement("td");
        let cell3 = document.createElement("td");
        let cell4 = document.createElement("td");
        let cell5 = document.createElement("td");
        let cell6 = document.createElement("td");
        let cell7 = document.createElement("td");

        cell1.textContent = data.id;
        cell2.textContent = data.title;
        cell3.textContent = data.description;
        cell4.textContent = data.year;
        cell5.textContent = data.author.name + " " + data.author.last_name;
        cell6.textContent = data.editorial.name;
        cell7.innerHTML = `<a type="button" href="${
            url() + `/book/${data.id}`
        }" class="btn btn-success">Edit</a>
        <a type="button" onclick="deleteBook(${
            data.id
        }, '${get_url}')" class="btn btn-danger">Delete</a>`;

        // Agregar las celdas a la fila
        row.appendChild(cell1);
        row.appendChild(cell2);
        row.appendChild(cell3);
        row.appendChild(cell4);
        row.appendChild(cell5);
        row.appendChild(cell6);
        row.appendChild(cell7);

        return row;
    };

    window.paginator = (links, params) => {
        let paginate = document.getElementById("paginate");

        let output = "";
        for (const iterator in links) {
            let active = links[iterator].active ? "active" : "";

            let link =
                links[iterator].url + (params.length == 0 ? "" : "&" + params);

            if (iterator == 0) {
                output += `<li class="page-item">
                <a class="page-link"onclick="getBook('${link}')" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>`;
            } else if (iterator == links.length - 1) {
                output += `<li class="page-item">
                <a class="page-link" onclick="getBook('${link}')" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>`;
            } else {
                output += ` <li class="page-item"><a class="page-link ${active}" onclick="getBook('${link}')" >${links[iterator].label}</a></li>`;
            }
        }

        paginate.innerHTML = output;
    };

    window.deleteBook = (id,get_url) => {
       
        fetch(url() + "/api/v1/books/" + id, {
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json, ",
            },
            method: "DELETE",
        })
            .then((data) => {
                return data.json();
            })
            .then((data) => {
                
                if (data.hasOwnProperty("data")) {
                    Swal.fire({
                        icon: "success",
                        title: "Your work has been saved",
                        showConfirmButton: false,
                        timer: 1500,
                    });

                    getBook(get_url);
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    };
});
