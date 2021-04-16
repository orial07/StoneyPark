/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/checkout.js ***!
  \**********************************/
var DAY_MILLIS = 86400000;
var form = document.reserve_form;
var total = document.getElementById('total');
var nights = 1;
$(document).ready(function () {
  update();
  var now = new Date();
  $('input[name="dates"]').daterangepicker({
    minDate: now,
    startDate: now,
    endDate: new Date(now.getTime() + DAY_MILLIS),
  }, function (start, end, label) {
    onDateChanged(start, end);
  }); // initialize fields for number of campers

  onCampersChanged(form.campers);
  form.addEventListener('change', function (e) {
    if (e.target.name == "campers") onCampersChanged(e.target);
    update();
  });
});

function getCampingType() {
  var es = document.getElementsByName('camping_type');

  for (var i = 0; i < es.length; i++) {
    if (es[i].checked) return i;
  }

  return undefined;
}

function onDateChanged(start, end) {
  var diff = end - start;
  var days = diff / 1000 / 60 / 60 / 24;
  nights = Math.round(days);
  update();
}

function onCampersChanged(e) {
  var count = Math.max(1, Math.min(6, e.value));
  var campers = document.getElementById('campers');
  campers.innerHTML = "";

  for (var i = 0; i < count - 1; i++) {
    campers.innerHTML += "<div class=\"input-group mb-3\">    <div class=\"input-group-prepend\">        <span class=\"input-group-text\" id=\"\">Name</span>    </div>    <input type=\"text\" class=\"form-control\" placeholder=\"First Name\" name=\"camper".concat(i, "_first_name\" autofocus required />    <input type=\"text\" class=\"form-control\" placeholder=\"Last Name\" name=\"camper").concat(i, "_last_name\" required /></div>");
  }
}

function update() {
  var cost = 0;
  document.getElementById('day_count').innerHTML = "This reservation will be for <strong>".concat(nights, " night").concat(nights > 1 ? 's' : '', "</strong>");
  var campingType = getCampingType();

  switch (campingType) {
    case 0:
    case 1:
      cost = 39;
      break;

    case 2:
      cost = 69;
      break;
  }

  cost *= nights;
  if (campingType == 1) cost += 30; // flat fee

  total.innerText = "$" + cost;
}
/******/ })()
;