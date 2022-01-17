/**
 * district datatable
 */
function riderDataTable(data = {}) {
    if (!Object.keys(data).length) {
        data["status"] = 0;
    }
    //destroy datatable
    $("#riderTable").DataTable().destroy();

    //create data table
    $("#riderTable").DataTable({
        responsive: true,
        paging: true,
        ordering: true,
        info: true,
        autoWidth: false,
        ajax: {
            url: url(prefix("rider/data")),
            type: "GET",
            data: data,
        },
        columns: [
            { data: "#" },
            { data: "image" },
            { data: "name" },
            { data: "phone" },
            { data: "city" },
            { data: "status" },
            { data: "last seen" },
            { data: "action" },
        ],
    });
}
riderDataTable();

/**
 * Delete Data
 */
$("#riderTable").on("click", ".delete", function () {
    // get state id
    let id = $(this).attr("data");

    // call delete method
    sweetAlertDelete(prefix(`rider/${id}`), riderDataTable);
});

/**
 * Restore deleted data
 */
$("#riderTable").on("click", ".restore", function () {
    // get state id
    let id = $(this).attr("data");

    // send ajax request
    let response = ajaxRequest(prefix(`rider/${id}/restore`), "PUT");

    response.done(function (res) {
        if (res.status === "success") {
            // refresh dataTable
            riderDataTable();

            // show toastr notification
            toastr.success(res.message);
        }
    });
});

/**
 * Update status
 */
$("#riderTable").on("click", ".status", function () {
    // get state id
    let id = $(this).attr("data");

    // send ajax request
    let response = ajaxRequest(prefix(`rider/${id}/status`), "PUT");

    response.done(function (res) {
        if (res.status === "success") {
            // refresh dataTable
            riderDataTable();

            // show toastr notification
            toastr.info(res.message);
        }
    });
});

/**
 * Search
 */
$("#riderSearchForm").on("submit", function (e) {
    e.preventDefault();

    // get form data
    let data = getFormData(this);

    // call datatable
    riderDataTable(data);

    showCount(prefix("rider/data"), data);
});
