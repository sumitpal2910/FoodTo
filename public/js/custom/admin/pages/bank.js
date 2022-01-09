/**
 * bank datatable
 */
function bankDataTable(data = {}) {
    //destroy datatable
    $("#bankTable").DataTable().destroy();

    //create data table
    $("#bankTable").DataTable({
        responsive: true,
        paging: true,
        ordering: true,
        info: true,
        autoWidth: false,
        ajax: {
            url: url("admin/bank/data"),
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
bankDataTable();

/**
 * Add new data using ajax
 */
$("#bankAdd").on("submit", function (e) {
    e.preventDefault();

    // get form
    let form = this;

    // Submit form data
    let response = sendFormData(form, "POST");

    // request done
    response.done(function (res) {
        //Success
        if (res.status === "success") {
            // refresh bank datatable
            bankDataTable();

            //hide modal
            $("#modalkAdd").modal("hide");

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
$("#bankTable").on("click", ".edit", function () {
    // get bank id
    let id = $(this).attr("data");

    // get form
    let form = document.getElementById("bankEdit");

    //call getDatUsingAjax function to get data from config/config.js
    let response = ajaxRequest(`admin/bank/data/${id}`);

    response.done(function (res) {
        let data = res.data;
        //reset form
        form.reset();

        //assign value
        form.elements["name"].value = data.name;

        form.action = url(`admin/bank/${data.id}`);
    });
});

/**
 * Update Edit from data
 */

$("#bankEdit").on("submit", function (e) {
    e.preventDefault();
    let form = this;

    // call sendFormData function to submit data
    let response = sendFormData(form, "PUT");

    response.done(function (res) {
        //Success
        if (res.status === "success") {
            // refresh dataTable
            bankDataTable();

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
    return;
});

/**
 * Delete Data
 */
$("#bankTable").on("click", ".delete", function () {
    // get bank id
    let id = $(this).attr("data");

    // call delete method
    sweetAlertDelete(`admin/bank/${id}`, bankDataTable);
});

/**
 * Restore deleted data
 */
$("#bankTable").on("click", ".restore", function () {
    // get bank id
    let id = $(this).attr("data");

    // send ajax request
    let response = ajaxRequest(`admin/bank/restore/${id}`, "PUT");

    response.done(function (res) {
        if (res.status === "success") {
            // refresh dataTable
            bankDataTable();

            // show toastr notification
            toastr.success(res.message);
        }
    });
});
