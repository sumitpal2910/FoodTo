
    /**
     * send request when stop writing
     */
    function debounce(callback, wait = 500) {
        let timeout;
        return (...agrs) => {
            clearTimeout(timeout);
            timeout = setTimeout(function () {
                callback.apply(this, args);
            }, wait);
        };
    }

    /**
     * Send Form data using ajax
     */
    function sendFormData(form, method = "POST") {
        // get form data by calling 'formdData' function
        let data = getFormData(form);

        //reset form
        form.reset();

        // send request
        return $.ajax({
            url: form.action,
            type: method,
            data: data,
            dataType: "json",
        });
    }

    /**
     * get data
     */
    function ajaxRequest(link, method = "GET", data = {}) {
        return $.ajax({
            url: url(link),
            method: method,
            data: data,
            dataType: "JSON",
        });
    }

    /**
     * get count and show to 'count' id
     */
    function showCount(link, data = {}, id = "count") {
        if (!Object.keys(data).length) {
            data.status = 0;
        }
        // send request
        let response = ajaxRequest(link, "GET", data);

        //assign to #count
        response.done(function (res) {
            $(`#${id}`).text(res.data.length);
        });
    }

    //const ajaxRequest = async (link = 'admin/service/state/data') => {
    //    let resp = await axios.get(url(link))
    //        .then((res) => {
    //            console.log("Success: ", res);
    //            return res;
    //        }).catch(err => {
    //            console.log("Error: ", err);
    //        });
    //
    //    console.log(resp.data);
    //}

