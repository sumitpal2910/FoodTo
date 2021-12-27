/**
 * state datatable
 */
function stateDataTable(data = {}) {
    if (!Object.keys(data).length) {
        data.status = 0;
    }
    //destroy datatable
    $("#stateTable").DataTable().destroy();

    //create data table
    $("#stateTable").DataTable({
        responsive: true,
        paging: true,
        ordering: true,
        info: true,
        autoWidth: false,
        ajax: {
            url: url("admin/service/state/data"),
            type: "GET",
            data: { status: status },
        },
        columns: [
            { data: "#" },
            { data: "name" },
            { data: "code" },
            { data: "status" },
            { data: "action" },
        ],
    });
}
stateDataTable();

/**
 * Add new data using ajax
 */
$("#stateAdd").on("submit", function (e) {
    e.preventDefault();

    // get form
    let form = document.getElementById("stateAdd");

    // Submit form data
    let response = sendFormData(form, "POST");

    // request done
    response.done(function (res) {
        //Success
        if (res.status === "success") {
            // refresh state datatable
            stateDataTable();

            //hide modal
            $("#modalStateAdd").modal("hide");

            // reset form
            form.reset();

            // show toastr notification
            toastr.success(res.message);
        }

        // Error
        if (res.status === "error") {
            let error = "";

            // loop over data that has error message
            for (let i = 0; i < res.data.length; i++) {
                error += `<li> ${res.data[i]}</li>`;
            }

            // assign to error div
            let errorDiv = $(form).find(".errorList").empty();
            errorDiv.html(error);
        }
    });
    return;
});

/**
 * show form data in edit modal
 */
$("#stateTable").on("click", ".edit", function () {
    // get state id
    let id = $(this).attr("state");

    // get form
    let form = document.getElementById("stateEdit");

    //call getDatUsingAjax function to get data from config/config.js
    let response = ajaxRequest(`admin/service/state/data/${id}`);

    response.done(function (res) {
        let data = res.data;
        //reset form
        form.reset();

        //assign value
        form.elements["name"].value = data.name;
        form.elements["code"].value = data.code;

        form.action = url(`admin/service/state/${data.id}`);
    });
});

/**
 * Update Edit from data
 */

$("#stateEdit").on("submit", function (e) {
    e.preventDefault();
    let form = this;

    // call sendFormData function to submit data
    let response = sendFormData(form, "PUT");

    response.done(function (res) {
        //Success
        if (res.status === "success") {
            // refresh dataTable
            stateDataTable();

            //hide modal
            $("#modalStateEdit").modal("hide");

            // reset form
            form.reset();

            // show toastr notification
            toastr.info(res.message);
        }

        //Error
        if (res.status === "error") {
            let error = "";

            // loop over data that has error message
            for (let i = 0; i < res.data.length; i++) {
                error += `<li> ${res.data[i]}</li>`;
            }

            // assign to error div
            let errorDiv = $(form).find(".errorList").empty();
            errorDiv.html(error);
        }
    });
    return;
});

/**
 * Delete Data
 */
$("#stateTable").on("click", ".delete", function () {
    // get state id
    let id = $(this).attr("state");

    // call delete method
    sweetAlertDelete(`admin/service/state/${id}`, stateDataTable);
});

/**
 * Restore deleted data
 */
$("#stateTable").on("click", ".restore", function () {
    // get state id
    let id = $(this).attr("state");

    // send ajax request
    let response = ajaxRequest(`admin/service/state/restore/${id}`, "PUT");

    response.done(function (res) {
        if (res.status === "success") {
            // refresh dataTable
            stateDataTable();

            // show toastr notification
            toastr.success(res.message);
        }
    });
});

/**
 * Show data on status dropdown change
 */
$("#stateStatus").on("change", function () {
    let status = this.value;

    // refresh dataTable
    stateDataTable({ status: status });

    // change status count
    showCount("admin/service/state/data", { status: status });
});

/**
 * Update status
 */
$("#stateTable").on("click", ".status", function () {
    // get state id
    let id = $(this).attr("state");

    // send ajax request
    let response = ajaxRequest(`admin/service/state/status/${id}`, "PUT");

    response.done(function (res) {
        if (res.status === "success") {
            // refresh dataTable
            stateDataTable();

            // show toastr notification
            toastr.info(res.message);
        }
    });
});
