foodId = $("#foodTimingTable").attr("foodId");
/**
 * datatable
 */
function foodTimingDataTable(id = null, data = {}) {
    if (!id) id = foodId;

    //destroy datatable
    $("#foodTimingTable").DataTable().destroy();

    //create data table
    $("#foodTimingTable").DataTable({
        responsive: true,
        paging: true,
        ordering: true,
        info: true,
        autoWidth: false,
        ajax: {
            url: url(prefix(`food/${id}/timing/data`)),
            type: "GET",
            data: data,
        },

        columns: [
            { data: "#" },
            { data: "day" },
            { data: "open" },
            { data: "close" },
            { data: "status" },
            { data: "action" },
        ],
    });
}
foodTimingDataTable();

/**
 * insert new data
 */
$("#addFoodTiming").on("submit", function (e) {
    e.preventDefault();

    let form = this;
    //get form data
    let formData = getFormData(this);

    // send form data
    let response = $.ajax({
        url: form.action,
        data: formData,
        method: "POST",
        dataType: "json",
    });

    // reposne
    response.done(function (res) {
        //hide modal
        $("#addTimingModal").modal("hide");

        // reset form
        form.reset();

        // refrsh table
        foodTimingDataTable();

        // show toastr notification
        toastr.info(res.message);
    });
});
/**
 * Get one data on click edit button
 */
$("#foodTimingTable").on("click", ".edit", function () {
    // get timing id
    let id = $(this).attr("data");

    // get form
    let form = document.getElementById("editFoodTiming");

    form.reset();

    // send request
    let response = ajaxRequest(`restaurant/food/${foodId}/timing/${id}`);

    response.done(function (res) {
        // set value
        form.elements["open"].value = res.data.open;
        form.elements["close"].value = res.data.close;

        // set day
        for (let i = 0; i < form.elements["day"].length; i++) {
            let element = form.elements["day"][i];
            if (element.value == res.data.day) {
                element.selected = true;
                break;
            }
        }

        form.setAttribute(
            "action",
            url(prefix(`food/${foodId}/timing/${res.data.id}`))
        );
    });
});

/**
 * update timing
 */
$("#editFoodTiming").on("submit", function (e) {
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
        $("#editTimingModal").modal("hide");

        // reset form
        form.reset();

        // refrsh table
        foodTimingDataTable();

        // show toastr notification
        toastr.info(res.message);
    });
});

/**
 * Delete timing
 */
$("#foodTimingTable").on("click", ".delete", function () {
    let id = $(this).attr("data");

    // call sweetAlertDelete function
    sweetAlertDelete(
        prefix(`food/${foodId}/timing/${id}`),
        foodTimingDataTable
    );
});

/**
 * restore
 */
$("#foodTimingTable").on("click", ".restore", function () {
    // get state id
    let id = $(this).attr("data");

    // send ajax request
    let response = ajaxRequest(
        prefix(`food/${foodId}/timing/${id}/restore`),
        "PUT"
    );

    response.done(function (res) {
        if (res.status === "success") {
            // refresh dataTable
            foodTimingDataTable();

            // show toastr notification
            toastr.success(res.message);
        }
    });
});

/**
 * Update status
 */
$("#foodTimingTable").on("click", ".status", function () {
    // get state id
    let id = $(this).attr("data");

    // send ajax request
    let response = ajaxRequest(
        prefix(`food/${foodId}/timing/${id}/update-status`),
        "PUT"
    );

    response.done(function (res) {
        if (res.status === "success") {
            // refresh dataTable
            foodTimingDataTable();

            // show toastr notification
            toastr.info(res.message);
        }
    });
});
