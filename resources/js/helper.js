window.url = () => {
    return document.querySelector('meta[name="url"]').getAttribute("content");
};

window.datos = (FormData) => {
    var json = {};
    FormData.forEach((value, key) => {
        json[key] = value;
    });
    return json;
};

window.getAuthors = () => {
    fetch(url() + "/api/v1/authors", {
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
            if (data.hasOwnProperty("data")) {
                let select = document.getElementById("author_id");

                for (const iterator of data.data) {
                    let option = document.createElement("option");
                    option.value = iterator.id;
                    option.text = iterator.name + " " + iterator.last_name;
                    select.appendChild(option);
                }
            }
        })
        .catch(function (error) {
            console.log(error);
        });
};

window.getEditorials = () => {
    fetch(url() + "/api/v1/editorials", {
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
            if (data.hasOwnProperty("data")) {
                let select = document.getElementById("editorial_id");
                for (const iterator of data.data) {
                    let option = document.createElement("option");
                    option.value = iterator.id;
                    option.text = iterator.name;
                    select.appendChild(option);
                }
            }
        })
        .catch(function (error) {
            console.log(error);
        });
};

window.convertArrayToUrlParams = (array) => {
    let params = new URLSearchParams();

    array.forEach((item, index) => {
      Object.keys(item).forEach(key => {
        params.append(key , item[key]);
      });
    });
    
    let queryString = params.toString();

    return queryString;
};
