/**
 * district datatable
 */
function districtDataTable(data = {}) {
    if (!Object.keys(data).length) {
        data["status"] = 0;
    }
    //destroy datatable
    $("#districtTable").DataTable().destroy();

    //create data table
    $("#districtTable").DataTable({
        responsive: true,
        paging: true,
        ordering: true,
        info: true,
        autoWidth: false,
        ajax: {
            url: url("admin/service/district/data"),
            type: "GET",
            data: data,
        },
        columns: [
            { data: "#" },
            { data: "name" },
            { data: "state" },
            { data: "status" },
            { data: "action" },
        ],
    });
}
districtDataTable();

/**
 * Add new data using ajax
 */
$("#districtAdd").on("submit", function (e) {
    e.preventDefault();

    // get form
    let form = document.getElementById("districtAdd");

    // Submit form data
    let response = sendFormData(form, "POST");

    // request done
    response.done(function (res) {
        //Success
        if (res.status === "success") {
            // refresh state datatable
            districtDataTable();

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
$("#districtTable").on("click", ".edit", function () {
    // get state id
    let id = $(this).attr("district");

    // get form
    let form = document.getElementById("districtEdit");

    //call getDatUsingAjax function to get data from config/config.js
    let response = ajaxRequest(`admin/service/district/data/${id}`);

    response.done(function (res) {
        let data = res.data;
        //reset form
        form.reset();

        //assign name
        form.elements["name"].value = data.name;

        // assign state
        for (let i = 0; i < form.elements["state_id"].length; i++) {
            let el = form.elements["state_id"][i];
            if (el.value == data.state_id) {
                el.selected = true;
            }
        }

        // set form action route
        form.action = url(`admin/service/district/${data.id}`);
    });
});

/**
 * Update Edit from data
 */

$("#districtEdit").on("submit", function (e) {
    e.preventDefault();
    let form = this;

    // call sendFormData function to submit data
    let response = sendFormData(form, "PUT");

    response.done(function (res) {
        //Success
        if (res.status === "success") {
            // refresh dataTable
            districtDataTable();

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
            let errorDiv = $(form)
                .children()
                .children()
                .children(".errorDiv")
                .children()
                .empty();
            errorDiv.html(error);
        }
    });
    return;
});

/**
 * Delete Data
 */
$("#districtTable").on("click", ".delete", function () {
    // get state id
    let id = $(this).attr("district");

    // call delete method
    sweetAlertDelete(`admin/service/district/${id}`, districtDataTable);
});

/**
 * Restore deleted data
 */
$("#districtTable").on("click", ".restore", function () {
    // get state id
    let id = $(this).attr("district");

    // send ajax request
    let response = ajaxRequest(`admin/service/district/restore/${id}`, "PUT");

    response.done(function (res) {
        if (res.status === "success") {
            // refresh dataTable
            districtDataTable();

            // show toastr notification
            toastr.success(res.message);
        }
    });
});

/**
 * Search
 */
$("#districtSearchForm").on("submit", function (e) {
    e.preventDefault();

    // get form data
    let data = getFormData(this);

    // call datatable
    districtDataTable(data);

    showCount("admin/service/district/data", data);
});

/**
 * Update status
 */
$("#districtTable").on("click", ".status", function () {
    // get state id
    let id = $(this).attr("district");

    // send ajax request
    let response = ajaxRequest(`admin/service/district/status/${id}`, "PUT");

    response.done(function (res) {
        if (res.status === "success") {
            // refresh dataTable
            districtDataTable();

            // show toastr notification
            toastr.info(res.message);
        }
    });
});
