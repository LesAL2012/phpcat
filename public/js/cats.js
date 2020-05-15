//select Records per page - fetch
let numberPages = document.querySelector('#perPageCat');
numberPages.addEventListener("change", function () {
    let dataNumber = numberPages.value;
    let query = `numberPages=${dataNumber}`;
    fetch(`/cats/perPage`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: query,
    })
        .then(response => {
            if (response.status == 200) {
                window.location.replace("/cats")
            }
        })
});

document.querySelectorAll('.dangerDel').forEach(item => {
    item.addEventListener('click', event => {
        if (confirm("Are you sure? REMOVE?")) {
            let id = item.getAttribute('data-id');
            let query = `id=${id}&action=deleteCats`;
            fetch(`/cats/deleteCats`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: query,
            })
                .then(response => {
                    if (response.status == 200) {
                        window.location.replace("/cats");
                    }
                })
        }
    });
});

document.querySelectorAll('.dangerEd').forEach(item => {
    item.addEventListener('click', event => {
        if (confirm("Are you sure? EDIT?")) {
            localStorage.setItem('idEdit', item.getAttribute('data-id'));
            window.location.replace("/cats/add-article");
        }
    });
});