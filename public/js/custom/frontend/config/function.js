/**
 * get form all field data
 */
 function getFormData(form) {
    // get form elements
    let inputs = form.elements;
    let data = {};

    // loop over and assign to data
    for (let i = 0; i < inputs.length; i++) {
        // get input
        let input = inputs[i];
        // get name of input
        let name = input.getAttribute("name");

        if (
            input.getAttribute("type") !== "submit" &&
            input.getAttribute("type") !== "button"
        ) {
            // if input name is an array
            data[name] = input.value;
        }
    }

    // return data object
    return data;
}
/**
 * show upload image
 */
function loadFile(event) {
    let render = new FileReader();
    render.onload = function () {
        let output = $(event.target).parent().parent().find(".preview");
        $(output).attr("src", render.result);
        $(output).addClass("img-thumbnail");
    };
    render.readAsDataURL(event.target.files[0]);
}

/**
 * get district dropdown on state change
 */
function getDistrict(event) {
    let id = event.target.value;

    //get district select
    let district = $(event.target)
        .parent()
        .parent()
        .parent()
        .find("select.district")
        .empty();
    // send request
    let response = ajaxRequest(`endpoint/state/${id}/district`);

    // response
    response.done(function (res) {
        //loop over district
        $(district).append(
            `<option value=null disabled selected>--Select District--</option>`
        );
        for (let i = 0; i < res.data.district.length; i++) {
            let dist = res.data.district[i];
            $(district).append(
                `<option value="${dist.id}">${dist.name}</option>`
            );
        }
    });
}

/**
 * get district dropdown on state change
 */
function getCity(event) {
    let id = event.target.value;

    //get city select
    let district = $(event.target)
        .parent()
        .parent()
        .parent()
        .find("select.city")
        .empty();
    // send request
    let response = ajaxRequest(`endpoint/district/${id}/city`);

    // response
    response.done(function (res) {
        $(district).append(
            `<option value=null disabled selected>--Select City--</option>`
        );

        //loop over district
        for (let i = 0; i < res.data.city.length; i++) {
            let city = res.data.city[i];
            $(district).append(
                `<option value="${city.id}">${city.name}</option>`
            );
        }
    });
}
