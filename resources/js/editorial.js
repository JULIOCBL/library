window.create = () => {
    fetch(url() + "/api/v1/books", {
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json, ",
            "X-CSRF-TOKEN": csrf_token(),
        },
        method: "POST",
        body: JSON.stringify({ lang: lang }),
    })
        .then((data) => {
            return data.json();
        })
        .then((data) => {
            
            console.log(data);
        })
        .catch(function (error) {
            console.log(error);
        });
};
