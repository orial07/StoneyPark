/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./resources/js/admin.map.js ***!
  \***********************************/
var OVERLAYS = [];
var CONTROLS = document.getElementById('controls');
var MODAL = new bootstrap.Modal(document.getElementById('propsModal'));

function Overlay(e) {
  this.e = e;
  this.info = {
    name: undefined,
    description: undefined
  };
}

Overlay.prototype.toString = function () {
  var overlay = {
    type: this.e.type
  };
  var shape = this.e.overlay || this.e;

  switch (this.e.type) {
    default:
      throw new Error("unknown overlay type:", this.e.type);

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

  var json = {
    name: this.info.name,
    description: this.info.description,
    overlay: overlay
  };
  return JSON.stringify(json);
};

function GetModalData(values) {
  var ret = {
    name: document.getElementById('modal-name'),
    description: document.getElementById('modal-description')
  };

  if (values) {
    for (var o in ret) {
      ret[o] = ret[o].value;
    }
  }

  return ret;
}

function EditControl(overlay) {
  MODAL.tag = overlay; // fill input fields and set values to overlay info

  var data = GetModalData(false);
  data.name.value = overlay.info.name;
  data.description.value = overlay.info.description;
  MODAL.show();
}

window.SaveControl = function () {
  var overlay = MODAL.tag;
  if (!overlay) return;
  var data = GetModalData(true);
  overlay.info = {
    name: data.name,
    description: data.description
  };
  var control = overlay.e.overlay || overlay.e;
  control.addListener('click', function () {
    return EditControl(overlay);
  });
  MODAL.tag = null;
  MODAL.hide();
};

window.DeleteControl = function () {
  var overlay = MODAL.tag;
  if (!overlay) return;
  var i = OVERLAYS.indexOf(overlay);
  if (i < 0) return;
  var control = overlay.e.overlay || overlay.e;
  control.setMap(null);
  OVERLAYS.splice(i, 1);
  MODAL.tag = null;
  MODAL.hide();
};

function CreateControl(map, data) {
  var overlay = new Overlay();
  overlay.info.name = data.name;
  overlay.info.description = data.description;

  switch (data.overlay.type) {
    case 'circle':
      break;

    case 'marker':
      overlay.e = new google.maps.Marker({
        position: data.overlay.geometry,
        map: map,
        title: data.name
      });
      break;

    case 'rectangle':
      overlay.e = new google.maps.Rectangle({
        map: map,
        bounds: data.overlay.geometry
      });
      break;

    case 'polyline':
      overlay.e = new google.maps.Polyline({
        path: data.overlay.geometry.Nb,
        map: map
      });
      break;

    case 'polygon':
      overlay.e = new google.maps.Polygon({
        paths: data.overlay.geometry.Nb[0].Nb,
        map: map
      });
      break;
  }

  overlay.e.type = data.overlay.type;
  google.maps.event.addListener(overlay.e, 'click', function () {
    return EditControl(overlay);
  });
  OVERLAYS.push(overlay);
}

window.initMap = function () {
  var MAP = new google.maps.Map(document.getElementById('map'), {
    center: {
      lat: 51.05563894221939,
      lng: -114.07027244567871
    },
    zoom: 15
  });
  MAP.addListener('click', function (e) {
    var pos = e.latLng;
    console.log(pos.lat(), pos.lng());
  });
  $.ajax({
    dataType: 'json',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    method: 'POST',
    success: function success(data, status, xhr) {
      for (var i = 0; i < data.length; i++) {
        CreateControl(MAP, data[i]);
      }
    },
    error: function error(xhr, status, _error) {
      console.log(_error);
    },
    processData: false,
    url: '/api/map'
  });
  var DRAWING = new google.maps.drawing.DrawingManager({
    drawingControl: true,
    drawingControlOptions: {
      position: google.maps.ControlPosition.TOP_CENTER,
      drawingModes: [google.maps.drawing.OverlayType.MARKER, // google.maps.drawing.OverlayType.CIRCLE,
      google.maps.drawing.OverlayType.POLYGON, google.maps.drawing.OverlayType.POLYLINE, google.maps.drawing.OverlayType.RECTANGLE]
    },
    markerOptions: {
      icon: "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png"
    },
    circleOptions: {
      fillColor: "#ffff00",
      fillOpacity: 1,
      strokeWeight: 5,
      clickable: false,
      editable: true,
      zIndex: 1
    }
  });
  google.maps.event.addListener(DRAWING, 'overlaycomplete', function (drawing) {
    // Switch back to non-drawing mode after drawing a shape.
    DRAWING.setDrawingMode(null);
    var overlay = new Overlay(drawing);
    MODAL.tag = overlay;
    OVERLAYS.push(overlay);
    MODAL.show();
  });
  DRAWING.setMap(MAP);
};

window.SaveOverlays = function () {
  $.ajax({
    data: OVERLAYS.toString(),
    dataType: 'json',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    method: 'POST',
    success: function success(data, status, xhr) {
      $('.toast .toast-body').text('Changes have been saved.');
      $('.toast').toast('show');
    },
    error: function error(xhr, status, _error2) {
      console.log(_error2);
    },
    processData: false,
    url: '/admin/map/save'
  });
};
/******/ })()
;