/**
 * Toggle Between Map tab and Address Tab
 */
function showTab() {
    // side address div
    let addressBox = document.querySelector("#address-box");
    addressBox.classList.toggle("d-none");

    let mapBox = document.querySelector("#mapbox");
    mapBox.classList.toggle("d-none");
}

/**
 * Locate Me
 */
function locateMe() {
    navigator.geolocation.getCurrentPosition(
        function (res) {
            let { latitude, longitude } = res.coords;

            // check if user is authencated
            let userLoggedIn = $.ajax({
                url: "account/logged-in",
                method: "get",
                dataType: "json",
            });

            // if user is logged in, show map
            // if not then close modal and set address to header
            userLoggedIn.done(function (data) {
                if (data.login) {
                    moveMarker([longitude, latitude]);
                } else {
                    closeModal();
                    let response = reverseGeoCoding(longitude, latitude);
                    response.then((res) => {
                        let data = new FormData();
                        let address = "";

                        // loop over addresses to get full address
                        for (let i = 0; i < res.data.features.length - 1; i++) {
                            const element = res.data.features[i];
                            if (element.place_type[0] == "poi") {
                                address += element.properties.address;
                            } else if (element.place_type[0] == "locality") {
                                data.append("type", element.text);
                                address += `, ${element.text}`;
                            } else {
                                address += `, ${element.text}`;
                            }
                        }

                        // append address to form data
                        data.append("full_address", address);
                        data.append(
                            "longitude",
                            res.data.features[0].center[0]
                        );
                        data.append("latitude", res.data.features[0].center[1]);
                        data.append("other_type", "");
                        data.append("house_no", "");

                        // send data to store in session
                        let addressRes = sendAddressData(data);
                        console.log(addressRes);

                        addressRes.then(function (add) {
                            // toggle tab
                            showTab();

                            window.location.href = "restaurants";
                        });
                    });
                }
            });
        },

        function (err) {
            console.warn(err);
        },
        { enableHighAccuracy: true, timeout: 5000, maximumAge: 0 }
    );
}

/**
 * show Other input
 */
function showInput(event) {
    let input = document.querySelector("#otherInput");

    if (event.target.checked && event.target.value == "other") {
        input.classList.remove("d-none");
    } else {
        input.classList.add("d-none");
    }
}

/**
 * Set address to address input after map changer
 */
function setAddress(data) {
    let form = document.getElementById("addressForm");
    let elements = form.elements;
    form.reset();
    let address = "";
    for (let i = 0; i < data.length - 1; i++) {
        const place = data[i];

        if (place.place_type[0] == "poi") {
            address += `${place.properties.address.toUpperCase() ?? ""}`;
        } else {
            address += `, ${place.text ? place.text : ""}`;
        }
    }
    elements["address"].value = address;
    elements["longitude"].value = data[0].center[0];
    elements["latitude"].value = data[0].center[1];
}

/**
 * Show Address details
 */
function addressDetail(event) {
    // hide button
    event.target.classList.add("d-none");

    // show address details inputs
    let address = document.getElementById("addressDetails");
    address.classList.remove("d-none");
}

/**
 * Save Address
 */
let form = document.getElementById("addressForm");
form.addEventListener("submit", function (e) {
    e.preventDefault();

    // get form data
    let data = new FormData(this);

    // send form data
    let response = sendAddressData(data);

    response.then(function (res) {
        // close modal
        closeModal();

        // toggle tab
        showTab();

        if (window.location.pathname == "/") {
            window.location.href = "restaurants";
        }

        setAddressToHeader(res.data);
    });
});

/**
 * Close map modal
 */
function closeModal() {
    $("#mapModal").modal("hide");
}

/**
 * Set address to header address box
 */
function setAddressToHeader(data) {
    let headerAddress = document.getElementById("header-full-address");
    let address;

    if (data.type) {
        address = `<b>${data.type} </b>${data.house_no},  ${
            data.landmark
        }, ${data.full_address.substr(0, 30)}`;
    } else {
        address = `${data.full_address.substr(0, 40)}`;
    }

    headerAddress.innerHTML = address;
}

/**
 * Send Address
 */
async function sendAddressData(data) {
    return await $.ajax({
        url: url("address"),
        method: "POST",
        data: data,
        contentType: false,
        processData: false,
    });
}
