const emodal = document.getElementById('propsModal');
const modal = new bootstrap.Modal(emodal);
emodal.addEventListener('hidden.bs.modal', e => updateControl(e));

const map = L.map('map').setView([51.05088910990064, -114.05994928703979], 15);
const items = new L.FeatureGroup();
map.addLayer(items);

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiaXphcm9vbmkiLCJhIjoiY2ttYmNhMzlxMWUwczJ4bnV0NDRnYmJsdyJ9.b-ymheEfwSpTryT2ASe21w', {
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
}).addTo(map);

map.pm.addControls({
    position: 'topleft',
    drawCircleMarker: false,
    drawCircle: false,
    editMode: false,
    dragMode: false,
    cutPolygon: false,
});

map.pm.Toolbar.createCustomControl({
    name: 'Save',
    block: 'custom',
    title: 'Save changes',
    className: 'save-icon',
    toggle: false,
    actions: ['cancel'],
    onClick: saveControls,
});

map.on('pm:create', e => {
    let type = e.shape;
    let layer = e.layer;

    modal.tag = layer;
    modal.show();
});

function updateControl(e) {
    let context = {
        "name": document.getElementById('popup-name').value,
        "popupContent": document.getElementById('popup-description').value,
    };

    let layer = modal.tag;
    layer.bindPopup(getPopupTemplate(context));

    let feature = layer.feature = layer.feature || {};
    feature.type = "Feature";
    feature.properties = feature.properties || context;

    layer.properties = context;
    console.log(layer);

    items.addLayer(layer);
    modal.tag = undefined;
}

function saveControls() {
    console.log("Requesting to save %d layers", items.getLayers().length);
    $.ajax({
        data: JSON.stringify(items.toGeoJSON()),
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        success: (data, status, j) => {
            $('.toast').toast('show');
        },
        processData: false,
        url: '/dashboard/map',
    });
}

function getPopupTemplate(context) {
    return `<b>${context.name}</b>
    <hr class="m-0"/>
    <br/>${context.popupContent || ''}`;
}