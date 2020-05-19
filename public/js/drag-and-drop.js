let fullData = {
    'cash': [],
    'finance': [],
    'lease': [],
    'other': [],
};
//console.log(fullData);

// get all tasks from DB
$(document).ready(function () {
    let params = {
        'action': 'getAllTasks',
    };
    $.ajax({
        url: '/drag-and-drop/get-all-tasks',
        type: 'POST',
        data: params,
        success: function (res) {
            let data = JSON.parse(res);
            let dataId = [];
            data.forEach(element => {
                dataId.push(element);
            });

            fullData['other'] = dataId;

            setAllTasks();
            setMaxHeight();
            setOnDragOnDrop();
        },
        error: function () {
            alert('ERROR!');
        }
    });
});

//set tasks in the div AND set dataTransfer for all div.task
function setAllTasks() {

    Object.keys(fullData).map(key => {
        let data = fullData[key];
        if (JSON.stringify(data) != '[]') {
            let innerData = '';
            data.map(element => innerData += `<div id="task-${element.id}" class="alert-success p-2 mb-3 text-dark rounded task border border-dark" draggable="true">
                <b>${element.id}</b> - ${element.task}
                <br>
                <u>Name</u> - <b>${element.username}</b>
                </div>`);
            document.querySelector(`#${key}`).innerHTML = innerData;
            document.querySelectorAll('.task').forEach(element => {
                element.ondragstart = (event) => {
                    event.dataTransfer.setData('content', event.target.id);
                }
                element.onmouseup = mouseUp;
                element.style.fontSize = '14px';
                element.style.cursor = 'move';
            });
            if (document.querySelector("h3")) {
                document.querySelector("h3").style.fontSize = '16px';
            }
            if (document.querySelector("table")) {
                document.querySelector("table").style.width = 'auto';
            }

            document.querySelector(`#${key}-sort`).innerHTML = getSortHtml('', key);

        } else {
            document.querySelector(`#${key}`).innerHTML = '';
            document.querySelector(`#${key}-sort`).innerHTML = getSortHtml('disabled', '');
        }
    });
}

//get and set max height for all div.task-list
function setMaxHeight() {
    let currentHeight = [];
    let taskList = document.querySelectorAll('.task-list');
    taskList.forEach(element => {
        currentHeight.push(element.offsetHeight);
    });
    let maxHeight = Math.max.apply(Math, currentHeight) + 30;
    taskList.forEach(element => {
        element.style.minHeight = maxHeight + 'px';
    });
};

// set ondrag/ondrop
function setOnDragOnDrop() {
    document.querySelectorAll('.task-list').forEach(element => {
        element.ondragover = () => false;
        element.ondrop = (event) => {

            let id = event.dataTransfer.getData('content').slice(5);
            let newParent = event.target.id;
            let oldParent = document.querySelector(`#${event.dataTransfer.getData('content')}`).parentElement.id;


            Object.keys(fullData).map(key => {

                if (oldParent == key) {
                    fullData[key].forEach(element => {

                        if (element.id == id) {
                            fullData[oldParent] = fullData[oldParent].filter(item => item !== element);

                            let indexArr = mouseUp(event);

                            if (indexArr) {
                                let newParent = event.target.parentElement.id;

                                let indexElem = '';
                                fullData[newParent].map((element, index) => {
                                    if (element.id == indexArr) {
                                        indexElem = index;
                                    }
                                });

                                fullData[newParent].splice(indexElem, 0, element);

                            } else {
                                fullData[newParent].push(element);

                            }
                        }
                    })
                }
            });

            setAllTasks();
            document.querySelectorAll('.task-list').forEach(element => {
                element.style.minHeight = 'auto';
            });
            setMaxHeight();

        };
    });
}

function mouseUp(event) {

    if (event.target.id.slice(0, -2) == 'task') {
        return event.target.id.slice(5);
    }
    return false;
};

function getSortHtml(disabled, key) {
    return `<div class="btn-group " role="group" aria-label="Basic example">
                <button ${disabled == '' && "onclick = sort(" + key + "," + "'id'" + "," + "'asc'" + ")"}   type="button" class="btn btn-${disabled == '' ? 'dark' : 'secondary'} rounded-0 ${disabled}">
                    id<i class="fas fa-arrow-up"></i>
                </button>
                <button ${disabled == '' && "onclick = sort(" + key + "," + "'id'" + "," + "'desc'" + ")"} type="button" class="btn btn-${disabled == '' ? 'dark' : 'secondary'} ${disabled}">
                    id<i class="fas fa-arrow-down"></i>
                </button>
                <button ${disabled == '' && "onclick = sort(" + key + "," + "'username'" + "," + "'asc'" + ")"} type="button" class="btn btn-${disabled == '' ? 'dark' : 'secondary'} ${disabled}">
                    <i class="fas fa-user"></i><i class="fas fa-arrow-up"></i>
                </button>
                <button ${disabled == '' && "onclick = sort(" + key + "," + "'username'" + "," + "'desc'" + ")"} type="button" class="btn btn-${disabled == '' ? 'dark' : 'secondary'} rounded-0 ${disabled}">
                    <i class="fas fa-user"></i><i class="fas fa-arrow-down"></i>
                </button>
            </div>`;
};

function sort(key, param, DESC) {
    let keyArr = key.id;
    fullData[keyArr].sort(compareValues(param, order = DESC));
    setAllTasks();
}

//https://www.sitepoint.com/sort-an-array-of-objects-in-javascript/
compareValues = (key, order = 'asc') => {
    return function innerSort(a, b) {
        if (!a.hasOwnProperty(key) || !b.hasOwnProperty(key)) {
            // property doesn't exist on either object
            return 0;
        }

        const varA = (typeof a[key] === 'string')
            ? a[key].toUpperCase() : a[key];
        const varB = (typeof b[key] === 'string')
            ? b[key].toUpperCase() : b[key];

        let comparison = 0;
        if (varA > varB) {
            comparison = 1;
        } else if (varA < varB) {
            comparison = -1;
        }
        return (
            (order === 'desc') ? (comparison * -1) : comparison
        );
    };
}



