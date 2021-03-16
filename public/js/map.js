const map = L.map('map').setView([51.05088910990064, -114.05994928703979], 13);

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiaXphcm9vbmkiLCJhIjoiY2ttYmNhMzlxMWUwczJ4bnV0NDRnYmJsdyJ9.b-ymheEfwSpTryT2ASe21w', {
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
}).addTo(map);
