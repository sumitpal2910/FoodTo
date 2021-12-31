/**
 * cuisine datatable
 */
function cuisineDataTable(data = {}) {
    if (!Object.keys(data).length) {
        data.status = 0;
    }
    //destroy datatable
    $("#cuisineTable").DataTable().destroy();

    //create data table
    $("#cuisineTable").DataTable({
        responsive: true,
        paging: true,
        ordering: true,
        info: true,
        autoWidth: false,
        ajax: {
            url: url("admin/cuisine/data"),
            type: "GET",
            data: data,
        },
        columns: [
            { data: "#" },
            { data: "name" },
            { data: "status" },
            { data: "action" },
        ],
    });
}
cuisineDataTable();

/**
 * Add new data using ajax
 */
$("#cuisineAdd").on("submit", function (e) {
    e.preventDefault();

    // get form
    let form = document.getElementById("cuisineAdd");

    // Submit form data
    let response = sendFormData(form, "POST");

    // request done
    response.done(function (res) {
        //Success
        if (res.status === "success") {
            // refresh state datatable
            cuisineDataTable();

            //hide modal
            $("#modalAdd").modal("hide");

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
$("#cuisineTable").on("click", ".edit", function () {
    // get state id
    let id = $(this).attr("data");

    // get form
    let form = document.getElementById("cuisineEdit");

    //call getDatUsingAjax function to get data from ajax-request.js
    let response = ajaxRequest(`admin/cuisine/data/${id}`);

    response.done(function (res) {
        let data = res.data;
        //reset form
        form.reset();

        //assign value
        form.elements["name"].value = data.name;
        form.action = url(`admin/cuisine/${data.id}`);
    });
});

/**
 * Update data
 */
$("#cuisineEdit").on("submit", function (e) {
    e.preventDefault();

    let form = this;

    // send form
    let response = sendFormData(form, "PUT");

    // response
    response.done(function (res) {
        let data = res.data;

        if (res.status === "success") {
            cuisineDataTable();

            //hide modal
            $("#modalEdit").modal("hide");

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
});

/**
 * Delete data
 */
$("#cuisineTable").on("click", ".delete", function () {
    let id = $(this).attr("data");

    // call sweetalertDelete from sweetalert.js
    sweetAlertDelete(`admin/cuisine/${id}`, cuisineDataTable);
});

/**
 * Restore deleted data
 */
$("#cuisineTable").on("click", ".restore", function () {
    // get id
    let id = $(this).attr("data");

    // send ajax request
    let resopnse = ajaxRequest(`admin/cuisine/restore/${id}`, "PUT");

    // success
    resopnse.done(function (res) {
        if (res.status == "success") {
            // refresh table
            cuisineDataTable();

            // show toastr notification
            toastr.success(res.message);
        }
    });
});

/**
 * change status
 */
$("#cuisineTable").on("click", ".status", function () {
    // get id
    let id = $(this).attr("data");

    // send ajax request
    let response = ajaxRequest(`admin/cuisine/status/${id}`, "PUT");

    // response
    response.done(function (res) {
        if (res.status === "success") {
            // refresh table
            cuisineDataTable();

            // toastr
            toastr.info(res.message);
        }
    });
});

/**
 * Show data on status dropdown change
 */
$("#cuisineStatus").on("change", function () {
    let status = this.value;

    // refresh dataTable
    cuisineDataTable({ status: status });

    // change status count
    showCount("admin/cuisine/data", { status: status });
});
