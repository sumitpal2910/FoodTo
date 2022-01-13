/**
 * datatable
 */
function foodDataTable(data = {}) {
    if (!Object.keys(data).length) {
        data.status = 0;
    }
    //destroy datatable
    $("#foodTable").DataTable().destroy();

    //create data table
    $("#foodTable").DataTable({
        responsive: true,
        paging: true,
        ordering: true,
        info: true,
        autoWidth: false,
        ajax: {
            url: url("restaurant/food/data"),
            type: "GET",
            data: data,
        },
        columns: [
            { data: "#" },
            { data: "image" },
            { data: "name" },
            { data: "toppings" },
            { data: "available" },
            { data: "quantity" },
            { data: "price" },
            { data: "status" },
            { data: "action" },
        ],
    });
}
foodDataTable();

/**
 * Delete
 */
$("#foodTable").on("click", ".delete", function () {
    let id = $(this).attr("data");

    // call sweetAlertDelete function
    sweetAlertDelete(prefix(`food/${id}`), foodDataTable);
});

/**
 * restore
 */
$("#foodTable").on("click", ".restore", function () {
    // get state id
    let id = $(this).attr("data");

    // send ajax request
    let response = ajaxRequest(prefix(`food/${id}/restore`), "PUT");

    response.done(function (res) {
        if (res.status === "success") {
            // refresh dataTable
            foodDataTable();

            // show toastr notification
            toastr.success(res.message);
        }
    });
});

/**
 * Update status
 */
$("#foodTable").on("click", ".status", function () {
    // get state id
    let id = $(this).attr("data");

    // send ajax request
    let response = ajaxRequest(prefix(`food/${id}/update-status`), "PUT");

    response.done(function (res) {
        if (res.status === "success") {
            // refresh dataTable
            foodDataTable();

            // show toastr notification
            toastr.info(res.message);
        }
    });
});

/**
 * show all toppings on modal
 */
$("#foodTable").on("click", ".showTopping", function () {
    // get food id
    let id = $(this).attr("data");

    // clear all field
    $("#foodName").text("");
    //$("toppingName").html('');

    // send request
    let response = ajaxRequest(prefix(`food/${id}/topping/data/json`));

    // response
    response.done(function (res) {
        console.log(res);
        // set food name
        $("#foodName").text(res.data.name);
        let toppings = "";

        // loop over toppings
        res.data.toppings.forEach((element, key) => {
            let name = element.deleted_at
                ? `<del class='text-muted'>${element.name} (Deleted)</del> `
                : element.name;
            // type veg/ non veg
            let type =
                element.type == 0
                    ? "<i class='veg-indian-vegetarian'></i> "
                    : "<i class='fas fa-caret-up non-veg-icon'></i> ";

            // status
            let status = "";
            if (element.status == 1) {
                status = `<span class='badge badge-pill badge-success'>Active</span>`;
            } else if (element.status == 0) {
                status = `<span class='badge badge-pill badge-warning'>Inactive</span>`;
            } else if (element.deleted_at) {
                status = `<span class='badge badge-pill badge-danger'>Deleted</span>`;
            }

            toppings += `<tr>
                            <td>${key + 1}</td>
                            <td>${type} ${name}</td>
                            <td>&#8377; ${element.price} </td>
                            <td>${element.qty} </td>
                            <td>${status} </td>
                    </tr>`;
        });

        // append to parent
        $("#toppingName").empty().append(toppings);
        $("#editButton").attr("href", url(prefix(`food/${res.data.id}/edit`)));
    });
});

/**
 * show all toppings on modal
 */
$("#foodTable").on("click", ".showTiming", function () {
    // get food id
    let id = $(this).attr("data");

    // clear all field
    $("#timingFoodName").text("");
    //$("toppingName").html('');

    // send request
    let response = ajaxRequest(prefix(`food/${id}/timing/data/json`));

    // response
    response.done(function (res) {
        // set food name
        $("#timingFoodName").text(res.data.name);
        let timing = "";

        // loop over timing
        res.data.timing.forEach((element, key) => {
            let day = element.deleted_at
                ? `<del class='text-muted'>${element.day} (Deleted)</del> `
                : element.day;

            // status
            let status = "";
            if (element.status == 1) {
                status = `<span class='badge badge-pill badge-success'>Active</span>`;
            } else if (element.status == 0) {
                status = `<span class='badge badge-pill badge-warning'>Inactive</span>`;
            } else if (element.deleted_at) {
                status = `<span class='badge badge-pill badge-danger'>Deleted</span>`;
            }

            timing += `<tr>
                            <td>${key + 1}</td>
                            <td>${day}</td>
                            <td>${element.open} </td>
                            <td>${element.close} </td>
                            <td>${status} </td>
                    </tr>`;
        });

        // append to parent
        if (res.data.timing) {
            $("#timingName").empty().append(timing);
        } else {
            $("#timingName").html(
                `<tr>
                        <td colspan='2'><center><h1>No Timing Available</h1></center></td>
                    </tr>`
            );
        }

        $("#editTimingButton").attr(
            "href",
            url(prefix(`food/${res.data.id}/edit`))
        );
    });
});

/**
 * Show data on status dropdown change
 */
$("#foodStatus").on("change", function () {
    let status = this.value;

    // refresh dataTable
    foodDataTable({ status: status });

    // change status count
    showCount(prefix(`food/data`), { status: status });
});
