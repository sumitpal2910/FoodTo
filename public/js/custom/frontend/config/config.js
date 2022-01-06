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
    $.ajaxSetup();

    $(".select2").select2({
        width: "100%",
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

    // BS-Stepper Init
