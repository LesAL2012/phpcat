//category - jQuery

$('#addCategory').click(function (event) {
    event.preventDefault();
    let category = document.querySelector('#category').value.trim();
    let description = document.querySelector('#description').value.trim();

    if (category == '' || description == '') {
        alert('Fields of CATEGORY FORM are REQUIRED!')
    } else {
        let params = {
            'action': 'addCategory',
            'category': category,
            'description': description
        };

        $.ajax({
            url: '/cats/addCategory',
            type: 'POST',
            data: params,
            success: function (res) {
                let data = JSON.parse(res);
                let message = `Category was added successfully`;

                tableCategoryHTML(data, message);

                document.querySelector('#category').value = '';
                document.querySelector('#description').value = '';
            },
            error: function () {
                alert('ERROR!');
            }
        });
    }
});

$('#editCategory').click(function (event) {
    event.preventDefault();
    let category = document.querySelector('#category').value.trim();
    let description = document.querySelector('#description').value.trim();

    if (category == '' || description == '') {
        alert('Fields of CATEGORY FORM are REQUIRED!')
    } else {
        let params = {
            'action': 'editCategory',
            'id': this.getAttribute('id-edit'),
            'category': category,
            'description': description
        };

        $.ajax({
            url: '/cats/addCategory',
            type: 'POST',
            data: params,
            success: function (res) {
                let data = JSON.parse(res);
                let message = `Category was edited successfully`;

                tableCategoryHTML(data, message);

                document.querySelector('#category').value = '';
                document.querySelector('#description').value = '';
                document.querySelector('#textEdit').innerHTML = '';

                document.querySelector('#addCategory').classList.remove("d-none");
                document.querySelector('#editCategory').classList.add("d-none");
            },
            error: function () {
                alert('ERROR!');
            }
        });
    }
});

function removeCategory(id) {
    if (confirm("Are you sure? REMOVE?")) {
        let idRemove = {
            'action': 'removeCategory',
            'id': id,
        };

        $.ajax({
            url: '/cats/removeCategory',
            type: 'POST',
            data: idRemove,
            success: function (res) {
                if (res.match(/foreign key/)) {
                    document.querySelector('#insert').innerHTML = '<div class="bg-dark rounded p-2 my-2 text-center">' +
                        '<h3 class="text-danger">There is the FOREIGN KEY in two tables: category and posts!</h3>' +
                        '<img src="/images/skull_48.png" alt="skull">'+
                        '<h1 class="text-danger">ERROR: FOREIGN KEY!</h1>'+
                        '</div>';
                } else {
                    let data = JSON.parse(res);
                    let message = 'Category <b>' + id + '</b> was deleted...';
                    tableCategoryHTML(data, message);
                }
            },
            error: function () {
                alert('REMOVE ERROR!');

                document.querySelector('#insert').innerHTML = '<div class="bg-dark rounded p-2 my-2 text-center">' +
                    '<h3 class="text-danger">There is the FOREIGN KEY in two tables: category and posts!</h3>' +
                    '<img src="/images/skull_48.png" alt="skull">'+
                    '<h1 class="text-danger">ERROR: FOREIGN KEY!</h1>'+
                    '</div>';
            }
        });
    }
};

function getEditCategory(id) {
    let idEdit = {
        'action': 'getEditCategory',
        'id': id,
    };

    $.ajax({
        url: '/cats/editCategory',
        type: 'POST',
        data: idEdit,
        success: function (res) {
            let data = JSON.parse(res);
            document.querySelector('#textEdit').innerHTML = `Edit category ID=${data.id}`;

            document.querySelector('#category').value = data.category;
            document.querySelector('#description').value = data.description;

            document.querySelector('#addCategory').classList.add("d-none");
            document.querySelector('#editCategory').classList.remove("d-none");
            document.querySelector('#editCategory').setAttribute('id-edit', data.id);

        },
        error: function () {
            alert('ERROR!');
        }
    });

};

function getAllCategory(getAllCategory) {
    let getAllCat = {
        'action': 'getAllCategory',
    };

    $.ajax({
        url: '/cats/editCategory',
        type: 'POST',
        data: getAllCat,
        success: function (res) {
            let data = JSON.parse(res);
            tableCategoryHTML(data, '');
        },
        error: function () {
            alert('ERROR!');
        }
    });
};
getAllCategory('getAllCategory');

function tableCategoryHTML(data, message) {
    let out = '<h4 class="text-primary text-center">' + message + '</h4>';
    out += '<div class="text-center"><img src="/public/images/jQuery_logo.png" alt="jQuery" class="w-128"><div>';
    out += '<table class="table table-dark">';
    out += '<thead>';
    out += '<tr>';
    out += '<th scope="col">ID</th>';
    out += '<th scope="col">Category</th>';
    out += '<th scope="col">Description</th>';
    out += '<th scope="col" class="text-center"><img src="/images/edit_icon.png" alt="edit" class="w-32"></th>';
    out += '<th scope="col" class="text-center"><img src="/images/delete_icon.png" alt="delete" class="w-32"></th>';
    out += '</tr>';
    out += '</thead>';
    out += '<tbody>';

    Object.keys(data).map(key => out += `<tr>
                        <th scope="row">${data[key]['id']}</th>
                        <td>${data[key]['category']}</td>
                        <td>${data[key]['description']}</td>
                        <td class="text-center">
                            <button onclick="getEditCategory(${data[key]['id']})" type="button" class="btn btn-warning border border-light">Edit</button>
                        </td>
                        <td class="text-center">
                            <button onclick="removeCategory(${data[key]['id']})" type="button"
                            class="btn btn-danger border border-light btn-r-category">Remove</button>
                        </td>
                        </tr>`);

    out += ' </tbody>';
    out += '</table>';
    document.querySelector('#insert').innerHTML = out;

    CategoryOptionsHTML(data);
};

function CategoryOptionsHTML(data) {
    let out = '';
    Object.keys(data).map(key => out += `<option value=${data[key]['id']}>
                        ${data[key]['category']}
                        </option>`);
    document.querySelector('#category-id').innerHTML = out;
};