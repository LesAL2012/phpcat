//fetch
document.querySelector('#addPost').addEventListener("click", function (event) {

    event.preventDefault();

    let formData = new FormData();
    formData.append("action", 'addPost');

    let title = document.querySelector('#title').value.trim();
    let summary = document.querySelector('#summary').value.trim();
    //let article = document.querySelector('#article').value.trim();
    let article = CKEDITOR.instances.article.getData();
    let cat = document.querySelector('#cat').value.trim();
    let tag = document.querySelector('#tag').value.trim();

    if (title == '' || summary == '' || article == '' || tag == '') {
        alert('All Fields of POST FORM are REQUIRED!')
    } else {
        formData.append("title", title);
        formData.append("summary", summary);
        formData.append("article", article);
        formData.append("cat", cat);
        formData.append("tag", tag);

        if (document.querySelector('#image').files[0] == undefined) {
            alert('File is REQUIRED! Just to add Photo.')
        } else {
            formData.append("image", document.querySelector('#image').files[0]);

            fetch('/cats/addPostCat',
                {method: "POST", body: formData},
            )
                .then(response => {
                    if (response.status === 200) {
                        return response.text();
                    } else {
                        alert('Some trouble with server or network - try to connect again')
                    }
                })
                .then(data => {
                    data = JSON.parse(data);

                    document.querySelector('#title').value = '';
                    document.querySelector('#summary').value = '';
                    //document.querySelector('#article').value = '';
                    CKEDITOR.instances.article.setData('');

                    document.querySelector('#cat').value = '';
                    document.querySelector('#tag').value = '';

                    tableCatsHTML(data, 5);
                })
        }
    }
});

document.querySelector('#editPost').addEventListener("click", function (event) {

    event.preventDefault();

    let formData = new FormData();
    formData.append("action", 'editPost');

    let title = document.querySelector('#title').value.trim();
    let summary = document.querySelector('#summary').value.trim();
    //let article = document.querySelector('#article').value.trim();
    let article = CKEDITOR.instances.article.getData();
    let cat = document.querySelector('#cat').value.trim();
    let tag = document.querySelector('#tag').value.trim();

    if (title == '' || summary == '' || article == '' || tag == '') {
        alert('All Fields of POST FORM are REQUIRED!')
    } else {
        formData.append("id", localStorage.getItem('idEdit'));
        formData.append("title", title);
        formData.append("summary", summary);
        formData.append("article", article);
        formData.append("cat", cat);
        formData.append("tag", tag);


        if (document.querySelector('#image').files[0] != undefined) {
            formData.append("image", document.querySelector('#image').files[0]);
        }
        fetch('/cats/addPostCat',
            {method: "POST", body: formData},
        )
            .then(response => {
                if (response.status === 200) {
                    return response.text();
                } else {
                    alert('Some trouble with server or network - try to connect again')
                }
            })
            .then(data => {
                data = JSON.parse(data);

                document.querySelector('#title').value = '';
                document.querySelector('#summary').value = '';
                //document.querySelector('#article').value = '';
                CKEDITOR.instances.article.setData('');
                document.querySelector('#cat').value = '';
                document.querySelector('#tag').value = '';

                tableCatsHTML(data, 1);

                localStorage.removeItem('idEdit');

                document.querySelector('#editPost').classList.add("d-none");
                document.querySelector('#addPost').classList.remove("d-none");
            })

    }

});

document.querySelector('#reload').addEventListener("click", function (event) {
    localStorage.removeItem('idEdit');
    window.location.replace("/cats/add-article");
});

function tableCatsHTML(data, numberEntries) {
    let out = '<h4 class="text-primary text-center">Last ' + numberEntries + ' entries</h4>';
    out += '<table class="table table-sm">';
    out += '<thead>';
    out += '<tr>';
    out += '<th scope="col">ID</th>';
    out += '<th scope="col">Title</th>';
    out += '<th scope="col">Summary</th>';
    out += '<th scope="col">Article</th>';
    out += '<th scope="col">Category</th>';
    out += '<th scope="col">Tags</th>';
    out += '<th scope="col">Photo</th>';
    out += '</tr>';
    out += '</thead>';
    out += '<tbody>';

    Object.keys(data).map(key => out += `<tr>
                        <th scope="row">${data[key]['id']}</th>
                        <td>${data[key]['title']}</td>
                        <td>${data[key]['summary']}</td>
                        <td>${data[key]['article']}</td>
                        <td>${data[key]['category']}</td>

                        <td>                                           
                        ${data[key]['tag'].map(element => ` ${element}`)}
                        </td>

                        <td><img src="/images/images_animals/${data[key]['pictures']}" alt="edit" class="w-32"></td>
                        </tr>`);

    out += ' </tbody>';
    out += '</table>';
    document.querySelector('#insert').innerHTML = out;

};

function getThreeEntries() {
    let formData = new FormData();
    formData.append("action", 'getThreeEntries');

    fetch('/cats/addPostCat',
        {method: "POST", body: formData},
    )
        .then(response => {
            if (response.status === 200) {
                return response.text();
            } else {
                alert('Some trouble with server or network - try to connect again')
            }
        })
        .then(data => {
            data = JSON.parse(data);
            tableCatsHTML(data, 3);
        })
};

checkIdEdit();

function checkIdEdit() {
    let id = localStorage.getItem('idEdit');
    if (id) {
        document.querySelector('#createEditPost').innerHTML = `Edit POST ID=${id}`;
        document.querySelector('#editPost').classList.remove("d-none");
        document.querySelector('#addPost').classList.add("d-none");

        let formData = new FormData();
        formData.append("action", 'getArticleById');
        formData.append("id", id);

        fetch('/cats/addPostCat',
            {method: "POST", body: formData},
        )
            .then(response => {
                if (response.status === 200) {
                    return response.text();
                } else {
                    alert('Some trouble with server or network - try to connect again')
                }
            })
            .then(data => {
                data = JSON.parse(data);
                document.querySelector('#title').value = data[0]['title'];
                document.querySelector('#summary').value = data[0]['summary'];
                document.querySelector('#article').value = data[0]['article'];
                document.querySelector('#cat').value = data[0]['categoryid'];
                let outTeg = '';
                data[0]['tag'].forEach(item => outTeg += item + ', ');
                document.querySelector('#tag').value = outTeg.trim();
            })
    }
};
