/**
 * show open close time input box
 */
 function timingInput(event) {
    // get value
    let value = event.target.checked;

    // get input divs
    let divs = $(event.target)
        .parent()
        .parent()
        .parent()
        .parent()
        .parent()
        .find("div.timingInput");

    // show hide
    if (value) {
        divs.removeClass("invisible");
    } else {
        divs.addClass("invisible");
    }
}
