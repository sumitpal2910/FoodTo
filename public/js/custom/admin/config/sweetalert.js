/**
 * Sweetalert Delete Alert
 */
function sweetAlertDelete(link, dataTableCallback = "", title = "") {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then(result => {
        if (result.isConfirmed) {
            // send request
            $.ajax({
                url: url(link),
                type: 'DELETE',
                dataType: "json",
                success: function (res) {
                    //refresh datatale
                    dataTableCallback();

                    Swal.fire("Deleted!", "Your file has been deleted", "success");
                }
            });
        }
    });
}

/**
 * Sweetalert toaster
 */
function sweetAlertToaster(data, message = "") {
    let Toast = Swal.mixin({
        toast: true,
        position: "top-right",
        showConfirmButton: false,
        timer: 15000
    });

    Toast.fire({
        icon: data.status,
        title: data.message
    });
}


/**
 * Sweet alert for delete button of all
 */
$(document).on("click", "#delete", function (event) {
    event.preventDefault();

    let form = $(this).parent().children("#deleteForm");

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then(result => {
        if (result.isConfirmed) {
            form.submit();
            Swal.fire("Deleted!", "Your file has been deleted.", "success");
        }
    });
});
