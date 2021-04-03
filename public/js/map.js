function Overlay(e) {
    this.e = e;
    this.info = {
        name: undefined,
        description: undefined,
    };
}

const CONTROLS = document.getElementById('controls');
const MODAL = new bootstrap.Modal(document.getElementById('propsModal'));

function initMap() {
    const MAP = new google.maps.Map(document.getElementById("map"), {
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
        url: '/map/load',
    });
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
    const info = new google.maps.InfoWindow({
        content: `\
<div>
    <p><strong>${data.name}</strong></p>
    <p>${data.description}</p>
</div>`
    });
    overlay.e.addListener('click', () => {
        info.open(map, overlay.e);
        ShowControl(overlay);
    });
}

function ShowControl(overlay) {
    $('#modal-name').text(overlay.info.name);
    $('#modal-description').text(overlay.info.description);
    MODAL.show();
}