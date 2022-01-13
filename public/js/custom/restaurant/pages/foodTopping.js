// get food id
let foodId = $("#toppingTable").attr("foodId");

/**
 * datatable
 */
function toppingDataTable(id = null, data = {}) {
    if (!id) id = foodId;

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
            url: url(`restaurant/food/${id}/topping/data`),
            type: "GET",
            data: data,
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
 * add input div
 */
$("#addTopping").on("click", function () {
    // get input div
    let div = $(".addToppingDiv");
    let id = parseInt($(this).attr("radio"));

    let input = `
                <div class="row" id="${id}">
                    <div class="col-12 border-top mb-3 mt-3"></div>
                    <!--Name-->
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="">Topping Name <span class="text-danger">*</span></label>
                            <input type="text" name="topping_name[]" class="form-control"
                                placeholder="Topping Name">
                        </div>
                    </div>

                    <!--Price-->
                    <div class="col-lg-2 col-md-6 col-sm-12 ">
                        <div class="form-group">
                            <label for="">Price <span class="text-danger">*</span></label>
                            <input min="0" type="number" name="topping_price[]" class="form-control"
                                placeholder="Price" >
                        </div>
                    </div>

                    <!--Quantity-->
                    <div class="col-lg-2 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for=""> Quantity </label>
                            <input min="0" type="number" name="topping_qty[]" class="form-control"
                                placeholder="Quantity" >
                        </div>
                    </div>

                    <!--Veg / Non Veg-->
                    <div class="col-lg-3 col-md-5 col-sm-12 ">
                        <label for="">Veg / Non Veg </label>
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline mr-5">
                                <input type="radio" id="radio${id}1" name="topping_type[${id}]" value="0"
                                    checked>
                                <label for="radio${id}1">Veg </label>
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="radio${id}2" name="topping_type[${id}]" value="1">
                                <label for="radio${id}2">Non Veg </label>
                            </div>
                        </div>
                    </div>

                    <!--Remove Button-->
                    <div class="col-md-1 col-sm-12">
                        <div class="form-group">
                            <label for="">Remove</label>
                            <button onclick="removeTopping(${id})"  type="button" class="btn text-danger removeTopping"><i
                                    class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>`;

    // append to div
    $(div).append(input);

    $(this).attr("radio", parseInt(id) + 1);
});

/**
 * remove input row
 */
function removeTopping(id) {
    // get row
    let row = $(`#${id}`);

    //remove
    row.remove();
    return;
}

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
    let response = ajaxRequest(`restaurant/food/${foodId}/topping/${id}`);

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

        form.setAttribute(
            "action",
            `/restaurant/food/${foodId}/topping/${res.data.id}`
        );
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
    sweetAlertDelete(
        `restaurant/food/${foodId}/topping/${id}`,
        toppingDataTable
    );
});

/**
 * restore
 */
$("#toppingTable").on("click", ".restore", function () {
    // get state id
    let id = $(this).attr("data");

    // send ajax request
    let response = ajaxRequest(
        prefix(`food/${foodId}/topping/${id}/restore`),
        "PUT"
    );

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
    let response = ajaxRequest(
        prefix(`food/${foodId}/topping/${id}/update-status`),
        "PUT"
    );

    response.done(function (res) {
        if (res.status === "success") {
            // refresh dataTable
            toppingDataTable();

            // show toastr notification
            toastr.info(res.message);
        }
    });
});

foodId = undefined;
