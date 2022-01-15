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

$(".select2").select2({
    width: "100%",
    tags: true,
    debug: true,
    placeholder: "Select Option",
    sorter: function (data) {
        return data.sort(function (a, b) {
            return a.text < b.text ? -1 : a.text > b.text ? 1 : 0;
        });
    },
});

$(".select2Modal").select2({
    width: "100%",
    dropdownParent: $(".select2ModalParent"),
});

/**
 * custom file input inialize
 */
$(function () {
    bsCustomFileInput.init();
});

////Tags input
//$("input[data-role=tagsinput]").tagsinput({
//    tagClass: "badge bagde-info",
//});
