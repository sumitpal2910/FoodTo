/**
 * Get website address
 */
function url(link) {
    return `${window.location.origin}/${link}`;
}

/**
 * csrf token
 */
const csrfToken = $('meta[name="csrf-token"]').attr("content");

/**
 * Ajax Configration
 */
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

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
$(".select2").select2({
    width: "100%",
});

$(".select2Modal").select2({
    width: "100%",
    dropdownParent: $(".select2ModalParent"),
});
