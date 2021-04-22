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

const MODAL = new bootstrap.Modal(document.getElementById('maps-modal'));

window.initMap = function () {
    let e = document.getElementById("map");
    if (!e) return;
    const MAP = new google.maps.Map(e, {
        center: { lat: 51.05563894221939, lng: -114.07027244567871 },
        zoom: 15,
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
        url: '/api/map',
    });
    window.MAP = MAP;
}

function CreateControl(map, data) {
    const overlay = new Overlay();

    overlay.info.name = data.name;
    overlay.info.description = data.description;

    switch (data.overlay.type) {
        case 'circle':
            break;
        case 'marker':
            overlay.e = new google.maps.Marker({
                map,
                position: data.overlay.geometry,
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
                map,
                path: data.overlay.geometry.Nb,
            });
            break;
        case 'polygon':
            overlay.e = new google.maps.Polygon({
                map,
                paths: data.overlay.geometry.Nb[0].Nb,
            });
            break;
    }
    overlay.e.addListener('click', () => {
        ShowControl(overlay);
    });
}

function ShowControl(overlay) {
    $('#modal-name').text(overlay.info.name);
    $('#modal-description').text(overlay.info.description);
    MODAL.show();
}