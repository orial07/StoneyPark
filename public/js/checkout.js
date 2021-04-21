/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/checkout.js ***!
  \**********************************/
var DAY_MILLIS = 86400000;
var TIME_FORMAT = "MM/DD/YYYY";
var CAMPING_TYPES = [// per-night cost, title, qty, total
[39, 0, 'Medium Tent', '1', 'ct_total_single'], [39, 30, 'Extra Medium Tent', '2', 'ct_total_double'], [69, 0, 'Recreational Vehicle', '1', 'ct_total_rv']];
var form = document.reserve_form;
var nights = 1;
$(document).ready(function () {
  // intialize stepper
  var stepper = window.stepper = new Stepper($('.bs-stepper')[0], {
    linear: false,
    animation: false,
    selectors: {
      steps: '.step',
      trigger: '.step-trigger',
      stepper: '.bs-stepper'
    }
  });
  stepper.reset(); // initialize date-range-picker

  var now = moment().set({
    hour: 0,
    minute: 0,
    second: 0,
    millisecond: 0
  });
  $('input[name="dates"]').daterangepicker({
    startDate: now.format(TIME_FORMAT),
    endDate: now.format(TIME_FORMAT),
    minDate: now.format(TIME_FORMAT),
    autoApply: true
  }, function (start, end, label) {
    onDateChanged(start, end);
  });
  onDateChanged(now, now); // initialize number of nights

  onCampersChanged(form.campers); // initialize fields for number of campers

  form.addEventListener('change', function (e) {
    if (e.target.name == "campers") onCampersChanged(e.target);
    update();
  });
}); // gets the selected camping type

function getCampingType() {
  // by looping through all radio buttons
  var es = document.getElementsByName('camping_type');

  for (var i = 0; i < es.length; i++) {
    // return the first input that's checked
    if (es[i].checked) return i;
  }

  return undefined;
} // updates number of nights based on arrival and departure reservation dates


function onDateChanged(start, end) {
  start = start.startOf('day');
  end = end.startOf('day');
  var days = moment.duration(end.diff(start)).asDays();
  nights = Math.round(days) + 1;
  update();
} // updates form control inputs for number of campers


function onCampersChanged(e) {
  var count = Math.max(1, Math.min(6, e.value));
  var campers = document.getElementById('campers');
  campers.innerHTML = ""; // reset

  for (var i = 0; i < count - 1; i++) {
    // add inputs
    campers.innerHTML += "<div class=\"input-group mb-3\">    <div class=\"input-group-prepend\">        <span class=\"input-group-text\" id=\"\">Name</span>    </div>    <input type=\"text\" class=\"form-control\" placeholder=\"First Name\" name=\"camper".concat(i, "_first_name\" autofocus required />    <input type=\"text\" class=\"form-control\" placeholder=\"Last Name\" name=\"camper").concat(i, "_last_name\" required /></div>");
  }
} // updates page contents


function update() {
  $('#nights').text("".concat(nights, " night").concat(nights == 1 ? '' : 's'));
  var campingType = getCampingType(); // update review step contents

  var type = CAMPING_TYPES[campingType];
  var cost = type[0] * nights;
  $('#r_camping_type_cost').text(type[1]);
  $('#r_camping_type').text(type[2]);
  $('#r_camping_type_qty').text(type[3]);
  $('#r_nights_qty').text(nights);
  $('#r_nights_cost').text(cost);

  for (var i = 0; i < CAMPING_TYPES.length; i++) {
    var ct = CAMPING_TYPES[i];
    $("#".concat(ct[ct.length - 1])).text(ct[1] + ct[0] * nights);
  }

  $('#r_customer_name').text("".concat($('input[name="first_name"]').val(), " ").concat($('input[name="last_name"]').val()));
  $('#r_customer_email').text("".concat($('input[name="email"]').val()));
  $('#r_customer_phone').text("".concat($('input[name="phone"]').val()));
  var picker = $('input[name="dates"]').data('daterangepicker');
  var arrive = picker.startDate.format("LL"),
      depart = moment(picker.endDate).add(1, 'day').format("LL");
  $('#r_arrive').text(arrive);
  $('#r_depart').text(depart);
  $('#date_arrive').text(arrive);
  $('#date_depart').text(depart);
  if (campingType == 1) cost += 30; // one-time fee

  $('#total').text("$" + cost);
}
/******/ })()
;