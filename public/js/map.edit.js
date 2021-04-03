const OVERLAYS = [];
const CONTROLS = document.getElementById('controls');
const MODAL = new bootstrap.Modal(document.getElementById('propsModal'));

function Overlay(e) {
    this.e = e;
    this.info = {
        name: undefined,
        description: undefined,
    };
}
Overlay.prototype.toString = function () {
    let overlay = { type: this.e.type };
    let shape = this.e.overlay || this.e;
    switch (this.e.type) {
        default: throw new Error("unknown overlay type:", this.e.type);
        case 'circle':
            overlay.radius = shape.getRadius();
            overlay.geometry = shape.getCenter();
            break;
        case 'marker':
            overlay.geometry = shape.getPosition();
            break;
        case 'rectangle':
            overlay.geometry = shape.getBounds();
            break;
        case 'polyline':
            overlay.geometry = shape.getPath();
            break;
        case 'polygon':
            overlay.geometry = shape.getPaths();
            break;
    }

    let json = {
        name: this.info.name,
        description: this.info.description,
        overlay: overlay
    };
    return JSON.stringify(json);
}

function GetModalData(values) {
    let ret = {
        name: document.getElementById('modal-name'),
        description: document.getElementById('modal-description'),
    };
    if (values) {
        for (var o in ret) {
            ret[o] = ret[o].value;
        }
    }

    return ret;
}

function EditControl(overlay) {
    MODAL.tag = overlay;

    // fill input fields and set values to overlay info
    let data = GetModalData(false);
    data.name.value = overlay.info.name;
    data.description.value = overlay.info.description;

    MODAL.show();
}

function SaveControl() {
    let overlay = MODAL.tag;
    if (!overlay) return;

    let data = GetModalData(true);
    overlay.info = {
        name: data.name,
        description: data.description,
    };
    google.maps.event.addListener(overlay.e.overlay, 'click', () => EditControl(overlay));

    console.log('SAVED', overlay)
    MODAL.tag = null;
    MODAL.hide();
}

function DeleteControl() {
    let overlay = MODAL.tag;
    if (!overlay) return;

    let i = OVERLAYS.indexOf(overlay);
    if (i < 0) return;

    let control = overlay.e.overlay || overlay.e;
    control.setMap(null);
    OVERLAYS.splice(i, 1);

    MODAL.tag = null;
    MODAL.hide();
}

function CreateControl(map, data) {
    let overlay = new Overlay();
    overlay.info.name = data.name;
    overlay.info.description = data.description;
    switch (data.overlay.type) {
        case 'circle':
            break;
        case 'marker':
            overlay.e = new google.maps.Marker({
                position: data.overlay.geometry,
                map,
                title: data.name,
            });
            break;
        case 'rectangle':
            overlay.e = new google.maps.Rectangle({
                map,
                bounds: data.overlay.geometry,
            });
            break;
        case 'polyline':
            overlay.e = new google.maps.Polyline({
                path: data.overlay.geometry.Nb,
                map,
            });
            break;
        case 'polygon':
            overlay.e = new google.maps.Polygon({
                paths: data.overlay.geometry.Nb[0].Nb,
                map,
            });
            break;
    }
    overlay.e.type = data.overlay.type;
    google.maps.event.addListener(overlay.e, 'click', () => EditControl(overlay));
    OVERLAYS.push(overlay);
}


function initMap() {
    const MAP = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 51.05563894221939, lng: -114.07027244567871 },
        zoom: 15,
    });
    MAP.addListener('click', function (e) {
        let pos = e.latLng;
        console.log(pos.lat(), pos.lng());
    });

    $.ajax({
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        success: (data, status, xhr) => {
            for (let i = 0; i < data.length; i++) {
                CreateControl(MAP, data[i]);
            }
        },
        error: (xhr, status, error) => {
            console.log(error);
        },
        processData: false,
        url: '/map/load',
    });

    const DRAWING = new google.maps.drawing.DrawingManager({
        drawingControl: true,
        drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: [
                google.maps.drawing.OverlayType.MARKER,
                // google.maps.drawing.OverlayType.CIRCLE,
                google.maps.drawing.OverlayType.POLYGON,
                google.maps.drawing.OverlayType.POLYLINE,
                google.maps.drawing.OverlayType.RECTANGLE,
            ],
        },
        markerOptions: {
            icon: "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png",
        },
        circleOptions: {
            fillColor: "#ffff00",
            fillOpacity: 1,
            strokeWeight: 5,
            clickable: false,
            editable: true,
            zIndex: 1,
        },
    });
    google.maps.event.addListener(DRAWING, 'overlaycomplete', function (drawing) {
        // Switch back to non-drawing mode after drawing a shape.
        DRAWING.setDrawingMode(null);

        let overlay = new Overlay(drawing);
        console.log('CREATE', overlay);

        MODAL.tag = overlay;
        OVERLAYS.push(overlay);
        MODAL.show();
    });
    DRAWING.setMap(MAP);
}

function SaveOverlays() {
    $.ajax({
        data: OVERLAYS.toString(),
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        success: (data, status, xhr) => {
            $('.toast .toast-body').text('Changes have been saved.')
            $('.toast').toast('show');
        },
        processData: false,
        url: '/dashboard/map/save',
    });
}