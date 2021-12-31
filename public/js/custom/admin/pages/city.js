/**
 * district datatable
 */
function cityDataTable(data = {}) {
    if (!Object.keys(data).length) {
        data["status"] = 0;
    }
    //destroy datatable
    $("#cityTable").DataTable().destroy();

    //create data table
    $("#cityTable").DataTable({
        responsive: true,
        paging: true,
        ordering: true,
        info: true,
        autoWidth: false,
        ajax: {
            url: url("admin/city/data"),
            type: "GET",
            data: data,
        },
        columns: [
            { data: "#" },
            { data: "name" },
            { data: "district" },
            { data: "state" },
            { data: "status" },
            { data: "action" },
        ],
    });
}
cityDataTable();


/**
 * Submit form
 */
$("#cityAdd").on("submit", function (e) {
    e.preventDefault();

    // get form
    let form = document.getElementById("cityAdd");

    // Submit form data
    let response = sendFormData(form, "POST");

    // request done
    response.done(function (res) {
        //Success
        if (res.status === "success") {
            // refresh state datatable
            cityDataTable();

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
$("#cityTable").on("click", ".edit", function () {
    // get state id
    let id = $(this).attr("city");

    // get form
    let form = document.getElementById("cityEdit");

    //call getDatUsingAjax function to get data from config/config.js
    let response = ajaxRequest(`admin/city/data/${id}`);

    response.done(function (res) {
        let data = res.data;
        //reset form
        form.reset();

        //assign name
        form.elements["name"].value = data.name;
        form.elements[
            "district_id"
        ].innerHTML = `<option value=${data.district_id}>${data.district.name}</option>`;

        // assign state
        for (let i = 0; i < form.elements["state_id"].length; i++) {
            let el = form.elements["state_id"][i];
            if (el.value == data.state_id) {
                el.selected = true;
            }
        }

        // set form action route
        form.action = url(`admin/city/${data.id}`);
    });
});

/**
 * Update Edit from data
 */

$("#cityEdit").on("submit", function (e) {
    e.preventDefault();
    let form = this;

    // call sendFormData function to submit data
    let response = sendFormData(form, "PUT");

    response.done(function (res) {
        //Success
        if (res.status === "success") {
            // refresh dataTable
            cityDataTable();

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
$("#cityTable").on("click", ".delete", function () {
    // get state id
    let id = $(this).attr("city");

    // call delete method
    sweetAlertDelete(`admin/city/${id}`, cityDataTable);
});

/**
 * Restore deleted data
 */
$("#cityTable").on("click", ".restore", function () {
    // get state id
    let id = $(this).attr("city");

    // send ajax request
    let response = ajaxRequest(`admin/city/restore/${id}`, "PUT");

    response.done(function (res) {
        if (res.status === "success") {
            // refresh dataTable
            cityDataTable();

            // show toastr notification
            toastr.success(res.message);
        }
    });
});

/**
 * Update status
 */
$("#cityTable").on("click", ".status", function () {
    // get state id
    let id = $(this).attr("city");

    // send ajax request
    let response = ajaxRequest(`admin/city/status/${id}`, "PUT");

    response.done(function (res) {
        if (res.status === "success") {
            // refresh dataTable
            cityDataTable();

            // show toastr notification
            toastr.info(res.message);
        }
    });
});

/**
 * Search
 */
$("#citySearchForm").on("submit", function (e) {
    e.preventDefault();

    // get form data
    let data = getFormData(this);
    console.log(data);

    // call datatable
    cityDataTable(data);

    showCount("admin/city/data", data);
});
