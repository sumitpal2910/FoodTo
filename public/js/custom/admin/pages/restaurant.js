/**
 *  datatable
 */
function restaurantDataTable(link = "", data = {}) {
    if (!Object.keys(data).length) {
        data.status = 0;
    }
    if (!link) {
        link = "admin/restaurant/data";
    }
    //destroy datatable
    $("#restaurantTable").DataTable().destroy();

    //create data table
    $("#restaurantTable").DataTable({
        responsive: true,
        paging: true,
        ordering: true,
        //scrollX: true,
        info: true,
        autoWidth: false,
        ajax: {
            url: url(link),
            type: "GET",
            data: data,
        },
        columns: [
            { data: "#" },
            { data: "image" },
            { data: "name" },
            { data: "phone" },
            { data: "address" },
            { data: "owner" },
            { data: "manager" },
            { data: "status" },
            { data: "action" },
        ],
    });
}
restaurantDataTable();

/**
 * show open close time input box
 */
function timingInput(event) {
    // get value
    let value = event.target.checked;

    // get input divs
    let divs = $(event.target)
        .parent()
        .parent()
        .parent()
        .parent()
        .parent()
        .find("div.timingInput");

    // show hide
    if (value) {
        divs.removeClass("invisible");
    } else {
        divs.addClass("invisible");
    }
}

/**
 * update status
 */
$("#restaurantTable").on("click", ".status", function () {
    //get data
    let id = $(this).attr("id");
    let value = $(this).attr("data");

    // send request
    let response = ajaxRequest(`admin/restaurant/status/${id}`, "PUT", {
        value,
    });

    //response
    response.done(function (res) {
        if (res.status == "success") {
            //refresh table
            restaurantDataTable();

            // show notification
            toastr.success(res.message);
        } else if (res.status === "error") {
            toastr.error(res.message);
        }
    });
});

/**
 * Delete Data
 */
$("#restaurantTable").on("click", ".delete", function () {
    // get state id
    let id = $(this).attr("id");

    // call delete method
    sweetAlertDelete(`admin/restaurant/${id}`, restaurantDataTable);
});

/**
 * Restore deleted data
 */
$("#restaurantTable").on("click", ".restore", function () {
    // get state id
    let id = $(this).attr("id");

    // send ajax request
    let response = ajaxRequest(`admin/restaurant/restore/${id}`, "PUT");

    response.done(function (res) {
        if (res.status === "success") {
            // refresh dataTable
            restaurantDataTable();

            // show toastr notification
            toastr.success(res.message);
        }
    });
});

/**
 * Search
 */

$("#searchForm").on("submit", function (e) {
    e.preventDefault();

    // get form data
    let data = getFormData(this);
    console.log(data);

    // send request
    //let response = ajaxRequest("admin/restaurant/search", "GET", data);
    restaurantDataTable("admin/restaurant/search", data);
});
