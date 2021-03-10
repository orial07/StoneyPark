/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/checkout.js ***!
  \**********************************/
var Invoice = {
  'campingType': 0,
  'nightsReserved': 1,
  'campersCount': 0
};
var form = document.reserve_form;
var total = document.getElementById('total');
$(document).ready(function () {
  // minimum 1 night of staying
  form.date_in.value = new Date().toISOString().substring(0, 10);
  form.date_out.value = new Date(Date.now() + 86400000).toISOString().substring(0, 10);
  update();
  form.addEventListener('change', function (e) {
    if (e.target.name == 'campingType') onCampingTypeChanged(e.target);else if (e.target.name.substring(0, 4) == 'date') onDateChanged(e.target);else if (e.target.name == "campers") onCampersChanged(e.target);
    update();
  });
});

function onCampingTypeChanged(e) {
  var type = parseInt(e.value);
  if (isNaN(type)) return; // clamp value

  Invoice.campingType = Math.max(0, Math.min(campingTypes.length, type));
}

function onDateChanged(e) {
  var cin = form.date_in.value || null,
      cout = form.date_out.value || null;
  if (cin == null || cout == null) return;
  var din = new Date(cin),
      dout = new Date(cout);

  if (dout <= din) {
    // check-out must be after the check-in date
    form.date_out.value = (dout = new Date(din.getTime() + 86400000)).toISOString().substring(0, 10);
  }

  var diff = dout - din;
  var days = diff / 1000 / 60 / 60 / 24;
  Invoice.nightsReserved = days;
}

function onCampersChanged(e) {
  var count = Invoice.campersCount = Math.max(1, Math.min(6, e.value));
  var campers = document.getElementById('campers');
  campers.innerHTML = "";

  for (var i = 0; i < count - 1; i++) {
    campers.innerHTML += "<div class=\"input-group mb-3\">\n                <div class=\"input-group-prepend\">\n                    <span class=\"input-group-text\" id=\"\">Name</span>\n                </div>\n                <input type=\"text\" class=\"form-control\" placeholder=\"First Name\" name=\"camper".concat(i, "_first_name\" autofocus required />\n                <input type=\"text\" class=\"form-control\" placeholder=\"Last Name\" name=\"camper").concat(i, "_last_name\" required />\n            </div>");
  }
}

function update() {
  var cost = 0;
  document.getElementById('day_count').innerHTML = "This reservation will be for ".concat(Invoice.nightsReserved, " night").concat(Invoice.nightsReserved > 1 ? 's' : '', ".");
  var campingType = Invoice.campingType;

  switch (Invoice.campingType) {
    case 0:
    case 1:
      cost = 39;
      break;

    case 2:
      cost = 69;
      break;
  }

  cost *= Invoice.nightsReserved;
  if (campingType == 1) cost += 30; // flat fee

  total.innerText = "$" + cost;
}
/******/ })()
;