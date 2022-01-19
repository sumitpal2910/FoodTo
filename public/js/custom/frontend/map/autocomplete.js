/**
 * Search Address
 */
async function searchAddress(searchTerm) {
    return await axios
        .get(
            `https://api.mapbox.com/geocoding/v5/mapbox.places/${searchTerm}.json`,
            {
                params: {
                    access_token: token,
                    country: "in",
                    limit: 6,
                },
            }
        )
        .then((res) => {
            return res;
        })
        .catch((err) => {
            console.error(err);
        });
}

/**
 * Search Location
 */
let searchBox = document.querySelector("#addressSearchBox");
searchBox.addEventListener(
    "input",
    debounce(function (event) {
        // show dropdown
        let dropdown = document.querySelector("#mapSearchDropdown");
        dropdown.classList.add("show");
        if (!event.target.value) {
            dropdown.classList.remove("show");
        }

        // search data
        if (event.target.value) {
            let response = searchAddress(event.target.value);

            response.then((res) => {
                console.log(res);
                // show result to drow down box
                dropdown.innerHTML = "";
                for (let i = 0; i < res.data.features.length; i++) {
                    let place = res.data.features[i];
                    // create new dropdown-item and assign text to it
                    const option = document.createElement("a");
                    option.setAttribute("href", "#");
                    option.classList.add("dropdown-item");
                    option.innerHTML = onComplete(place.place_name);
                    dropdown.appendChild(option);

                    // add event listener on every option to show location on map
                    option.addEventListener("click", function () {
                        dropdown.classList.remove("show");
                        showTab();
                        moveMarker(place.center);
                    });
                }
            });
        }
    }, 500)
);

function onComplete(place) {
    let icon = `<i class="icofont-location-pin"></i>`;
    return place.length > 50
        ? `${icon} &nbsp; ${place.substr(0, 40)}..`
        : `${icon} &nbsp; ${place}`;
}
