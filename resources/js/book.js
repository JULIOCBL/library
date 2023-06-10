getAuthors();
getEditorials();

window.create = () => {
    let frm = document.getElementById("frmBook");
    let data = datos(new FormData(frm));

    fetch(frm.action, {
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json, ",
        },
        method: "POST",
        body: JSON.stringify(data),
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
            } else {
                Swal.fire({
                    icon: "warning",
                    title: "Fill in the fields correctly",
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
        })
        .catch(function (error) {
            console.log(error);
        });
};

window.show = () => {
    fetch(url() + "/api/v1/books/" + id_book, {
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
            console.log(data);

            if (data.hasOwnProperty("data")) {
                let frm = document.getElementById("frmBook");
                frm.title.value = data.data.title;
                frm.description.value = data.data.description;
                frm.year.value = data.data.year;
                frm.author_id.value = data.data.author.id;
                frm.editorial_id.value = data.data.editorial.id;
            }
        })
        .catch(function (error) {
            console.log(error);
        });
};

if (typeof id_book !== "undefined") {
    console.log("La variable no está definida");

    show();
}

window.update = () => {
    let frm = document.getElementById("frmBook");
    let data = datos(new FormData(frm));

    fetch(frm.action, {
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json, ",
        },
        method: "PUT",
        body: JSON.stringify(data),
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

            } 
        })
        .catch(function (error) {
            console.log(error);
        });
};
