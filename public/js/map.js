mapboxgl.accessToken =
    "pk.eyJ1Ijoic3VtaXRwYWwyODEwIiwiYSI6ImNreWlsMDl1cTB5b2Yyb25zanJlNHZlMjYifQ.aj9qT3Ot-64sXLAbUz0PnQ";

const coordinates = document.getElementById("coordinates");
const map = new mapboxgl.Map({
    container: "map", // container ID
    style: "mapbox://styles/mapbox/streets-v11", // style URL
    center: [88.3653, 22.5655], // starting position [lng, lat]
    zoom: 16, // starting zoom
});

// Set marker options.
const marker = new mapboxgl.Marker({
    draggable: true,
})
    .setLngLat([88.3653, 22.5655])
    .addTo(map);

function onDragEnd() {
    const lngLat = marker.getLngLat();
    console.log(lngLat);
    coordinates.style.display = "block";
    coordinates.innerHTML = `Longitude: ${lngLat.lng}<br />Latitude: ${lngLat.lat}`;
}

marker.on("dragend", onDragEnd);
