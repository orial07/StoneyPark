/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************!*\
  !*** ./resources/js/map.js ***!
  \*****************************/
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

var MODAL = new bootstrap.Modal(document.getElementById('maps-modal'));

window.initMap = function () {
  var e = document.getElementById("map");
  if (!e) return;
  var MAP = new google.maps.Map(e, {
    center: {
      lat: 51.05563894221939,
      lng: -114.07027244567871
    },
    zoom: 15
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
  window.MAP = MAP;
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
        map: map,
        position: data.overlay.geometry,
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
        map: map,
        path: data.overlay.geometry.Nb
      });
      break;

    case 'polygon':
      overlay.e = new google.maps.Polygon({
        map: map,
        paths: data.overlay.geometry.Nb[0].Nb
      });
      break;
  }

  overlay.e.addListener('click', function () {
    ShowControl(overlay);
  });
}

function ShowControl(overlay) {
  $('#modal-name').text(overlay.info.name);
  $('#modal-description').text(overlay.info.description);
  MODAL.show();
}
/******/ })()
;