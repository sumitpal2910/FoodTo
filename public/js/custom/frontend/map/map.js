const token =
    "pk.eyJ1Ijoic3VtaXRwYWwyODEwIiwiYSI6ImNreWlsMDl1cTB5b2Yyb25zanJlNHZlMjYifQ.aj9qT3Ot-64sXLAbUz0PnQ";

mapboxgl.accessToken = token;

const coordinates = document.getElementById("address");
const map = new mapboxgl.Map({
    container: "map", // container ID
    style: "mapbox://styles/mapbox/streets-v11", // style URL
    center: [88.3653, 22.5655], // starting position [lng, lat]
    zoom: 16, // starting zoom
});

// Set marker options.
const marker = new mapboxgl.Marker({
    draggable: false,
})
    .setLngLat([-77.031952, 38.913184])
    .addTo(map);

// Add geolocate control to the map.
map.addControl(
    new mapboxgl.GeolocateControl({
        positionOptions: {
            enableHighAccuracy: true,
        },
        // When active the map will receive updates to the device's location as it changes.
        trackUserLocation: true,
        // Draw an arrow next to the location dot to indicate which direction the device is heading.
        showUserHeading: false,
    })
);

// move map but pointer not moving
map.on("move", function (e) {
    //console.log(`Current Map Center: ${map.getCenter()}`);
    marker.setLngLat(map.getCenter());
});

// get the
map.on("moveend", function (e) {
    let { lng, lat } = map.getCenter();

    // set marker
    marker.setLngLat([lng, lat]);

    // send reverse geo coding request
    let response = reverseGeoCoding(lng, lat);

    response.then((res) => {
        setAddress(res.data.features);
    });
});

map.addControl(new mapboxgl.NavigationControl());

/**
 * Call reverse geocoing api
 */
async function reverseGeoCoding(lng, lat) {
    return await axios
        .get(
            `https://api.mapbox.com/geocoding/v5/mapbox.places/${lng},${lat}.json?`,
            {
                params: {
                    access_token: token,
                    type: "poi",
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

function moveMarker(lnglat) {
    marker.setLngLat(lnglat);
    map.flyTo({
        center: lnglat,
        essential: true,
    });
}
