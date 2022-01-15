/**
 * datatable
 */
function menuDataTable(data = {}) {
    if (!Object.keys(data).length) {
        data.status = 0;
    }
    //destroy datatable
    $("#menuTable").DataTable().destroy();

    //create data table
    $("#menuTable").DataTable({
        responsive: true,
        paging: true,
        ordering: true,
        info: true,
        autoWidth: false,
        ajax: {
            url: url(prefix("menus/data")),
            type: "GET",
            data: data,
        },
        columns: [
            { data: "#" },
            { data: "name" },
            { data: "summary" },
            { data: "foods" },
            { data: "status" },
            { data: "action" },
        ],
    });
}
menuDataTable();

/**
 * Delete
 */
$("#menuTable").on("click", ".delete", function () {
    let id = $(this).attr("data");

    // call sweetAlertDelete function
    sweetAlertDelete(prefix(`menus/${id}`), menuDataTable);
});

/**
 * restore
 */
$("#menuTable").on("click", ".restore", function () {
    // get state id
    let id = $(this).attr("data");

    // send ajax request
    let response = ajaxRequest(prefix(`menus/${id}/restore`), "PUT");

    response.done(function (res) {
        if (res.status === "success") {
            // refresh dataTable
            menuDataTable();

            // show toastr notification
            toastr.success(res.message);
        }
    });
});

/**
 * Update status
 */
$("#menuTable").on("click", ".status", function () {
    // get state id
    let id = $(this).attr("data");

    // send ajax request
    let response = ajaxRequest(prefix(`menus/${id}/update-status`), "PUT");

    response.done(function (res) {
        if (res.status === "success") {
            // refresh dataTable
            menuDataTable();

            // show toastr notification
            toastr.info(res.message);
        }
    });
});

/**
 * show food
 */
$("#menuTable").on("click", ".showFood", function () {
    let id = $(this).attr("data");

    // send request
    let response = ajaxRequest(prefix(`menus/${id}/data/foods`));

    response.done(function (res) {
        console.log(res);
        // set food name
        $("#menuName").text(res.data.title);
        let foods = "";

        // loop over timing
        res.data.foods.forEach((element, key) => {
            let name, status, link;

            // veg nonveg
            if (element.type == 0) {
                name = "<i class='veg-indian-vegetarian'></i> ";
            } else {
                name = "<i class='fas fa-caret-up non-veg-icon'></i> ";
            }

            // name
            if (element.deleted_at) {
                name += `<del class='text-muted'>${element.name} (Deleted)</del> `;
            } else {
                name += element.name;
            }

            // status
            if (element.status == 1) {
                status = `<span class='badge badge-pill badge-success'>Active</span>`;
            } else if (element.status == 0) {
                status = `<span class='badge badge-pill badge-warning'>Inactive</span>`;
            } else if (element.deleted_at) {
                status = `<span class='badge badge-pill badge-danger'>Deleted</span>`;
            }

            link = url(prefix(`food/${element.id}/edit`));
            foods += `<tr>
                       <td>${key + 1}</td>
                       <td>${name}</td>
                       <td>${element.qty}</td>
                       <td>${element.price}</td>
                       <td>${status}</td>
                       <td>
                            <a href="${link}" class="fas fa-pencil-alt" title="Edit"></a>
                       </td>
                    </tr>`;
        });

        $("#menuFoodTable").empty().append(foods);
    });
});
