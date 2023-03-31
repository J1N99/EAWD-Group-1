let tableHideShow = () => {
    const table = document.getElementById("position-table");

    if (table.style.display === "block") {
        table.style.display = "none";
    } else {
        table.style.display = "block"
    }
}

let addNewCategory = () => {
    let table = document.getElementById('categoryTable');
    let categoryValue = document.getElementById('category').value;
    
    let row = table.insertRow(-1);
    const cell1 = row.insertCell(0);
    const cell2 = row.insertCell(1);
    
    cell1.outerHTML = `<td>${categoryValue}</td>`;

    cell2.outerHTML =   '<td>' +
                            '<button onclick="deleteCategory(this)"'+
                                'class="border-0 btn-transition btn btn-outline-danger">' +
                                '<i class="fa fa-trash"></i>' +
                            '</button>' +
                        '</td>';
}

let deleteCategory = (index) => {    
    console.log(index);
    const i = index.parentNode.parentNode.rowIndex;
    document.getElementById("categoryTable").deleteRow(i);    
}

