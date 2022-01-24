/**
 * datatable
 */
function toppingDataTable(data = {}) {
    //destroy datatable
    $("#toppingTable").DataTable().destroy();

    //create data table
    $("#toppingTable").DataTable({
        responsive: true,
        paging: true,
        ordering: true,
        info: true,
        autoWidth: false,
        ajax: {
            url: url(`restaurant/topping/data`),
            type: "GET",
        },
        columns: [
            { data: "#" },
            { data: "name" },
            { data: "price" },
            { data: "quantity" },
            { data: "status" },
            { data: "action" },
        ],
    });
}

toppingDataTable();

/**
 * Add New Topping
 *
 */
$("#addTopping").on("submit", function (e) {
    e.preventDefault();

    let form = this;
    // get form data
    let data = new FormData(this);

    // send form data
    $.ajax({
        url: form.action,
        method: "POST",
        data: data,
        contentType: false,
        processData: false,
        success: function (res) {
            $("#addModal").modal("hide");
            toastr.success(res.message);
            toppingDataTable();
        },
    });
});

/**
 * Get one data on click edit button
 */
$("#toppingTable").on("click", ".edit", function () {
    // get topping id
    let id = $(this).attr("data");

    // get form
    let form = document.getElementById("editTopping");
    form.reset();

    // send request
    let response = ajaxRequest(`restaurant/topping/${id}`);

    response.done(function (res) {
        // set value
        form.elements["name"].value = res.data.name;
        form.elements["price"].value = res.data.price;
        form.elements["qty"].value = res.data.qty;

        // veg / non veg
        if (res.data.type == 0) {
            form.elements["type"][0].checked = true;
        } else {
            form.elements["type"][1].checked = true;
        }

        form.setAttribute("action", `/restaurant/topping/${res.data.id}`);
    });
});

/**
 * update topping
 */
$("#editTopping").on("submit", function (e) {
    e.preventDefault();

    let form = this;
    // send form data
    let formData = getFormData(this);

    let response = $.ajax({
        url: form.action,
        data: formData,
        method: "PUT",
        dataType: "json",
    });

    // reposne
    response.done(function (res) {
        //hide modal
        $("#editModal").modal("hide");

        // reset form
        form.reset();

        // refrsh table
        toppingDataTable();

        // show toastr notification
        toastr.info(res.message);
    });
});

/**
 * Delete topping
 */
$("#toppingTable").on("click", ".delete", function () {
    let id = $(this).attr("data");

    // call sweetAlertDelete function
    sweetAlertDelete(prefix(`/topping/${id}`), toppingDataTable);
});

/**
 * restore
 */
$("#toppingTable").on("click", ".restore", function () {
    // get state id
    let id = $(this).attr("data");

    // send ajax request
    let response = ajaxRequest(prefix(`topping/${id}/restore`), "PUT");

    response.done(function (res) {
        if (res.status === "success") {
            // refresh dataTable
            toppingDataTable();

            // show toastr notification
            toastr.success(res.message);
        }
    });
});

/**
 * Update status
 */
$("#toppingTable").on("click", ".status", function () {
    // get state id
    let id = $(this).attr("data");

    // send ajax request
    let response = ajaxRequest(prefix(`topping/${id}/update-status`), "PUT");

    response.done(function (res) {
        if (res.status === "success") {
            // refresh dataTable
            toppingDataTable();

            // show toastr notification
            toastr.info(res.message);
        }
    });
});
