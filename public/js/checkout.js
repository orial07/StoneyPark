/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/checkout.js ***!
  \**********************************/
var DAY_MILLIS = 86400000;
var TIME_FORMAT = "MM/DD/YYYY";
var nights = 1;
jQuery(function () {
  $('#date_display').removeClass('d-none'); // intialize stepper

  var stepperEl = $('.bs-stepper')[0];
  var stepper = window.stepper = new Stepper(stepperEl, {
    linear: true,
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
  }),
      later = moment(now).add(1, 'day');
  $('input[name="dates"]').daterangepicker({
    startDate: now.format(TIME_FORMAT),
    endDate: later.format(TIME_FORMAT),
    minDate: now.format(TIME_FORMAT)
  }, function (start, end, label) {
    onDateChanged(start, end);
  });
  onDateChanged(now, later); // initialize number of nights

  var form = $('#reserve-form')[0];
  onCampersChanged($('#campers_count')[0]); // initialize fields for number of campers

  form.addEventListener('change', function (e) {
    if (e.target.name == "campers_count") onCampersChanged(e.target);
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

  if (days < 1) {
    $('#nights').html("<span class=\"text-danger fw-bold\">The reservation must be at least 1 night.</span>");
    return;
  }

  nights = Math.round(days);
  update();
} // updates form control inputs for number of campers


function onCampersChanged(e) {
  var count = Math.max(1, Math.min(6, e.value));
  var campers = $('#campers')[0];
  campers.innerHTML = ""; // reset

  for (var i = 0; i < count - 1; i++) {
    // add inputs
    campers.innerHTML += "<div class=\"input-group mb-3\">    <div class=\"input-group-prepend\">        <span class=\"input-group-text\" id=\"\">Name</span>    </div>    <input type=\"text\" class=\"form-control\" placeholder=\"First Name\" name=\"camper".concat(i, "_first_name\" autofocus required />    <input type=\"text\" class=\"form-control\" placeholder=\"Last Name\" name=\"camper").concat(i, "_last_name\" required /></div>");
  }
} // updates page contents


function update() {
  $('#nights').html("This reservation will be for <span class=\"text-primary\">".concat(nights, " night").concat(nights == 1 ? '' : 's', "</span>"));
  var campingType = CAMPING_TYPES[getCampingType()];
  var cost = campingType.price * nights; // recurring charges (price per night)
  // update review step contents

  $('#r_camping_name').text(campingType.name);
  $('#r_camping_qty').text(campingType.quantity);
  $('#r_camping_cost').text(campingType.price2.asMoney());
  $('#r_nights_qty').text(nights);
  $('#r_nights_cost').text(cost.asMoney());
  cost += campingType.price2; // one-time fee

  for (var i = 0; i < CAMPING_TYPES.length; i++) {
    var ct = CAMPING_TYPES[i];
    var total = ct.price * nights + ct.price2;
    $("#ct_cost_".concat(i)).text(total.asMoney());
  }

  $('#r_customer_name').text("".concat($('input[name="first_name"]').val(), " ").concat($('input[name="last_name"]').val()));
  $('#r_customer_email').text("".concat($('input[name="email"]').val()));
  $('#r_customer_phone').text("".concat($('input[name="phone"]').val()));
  var picker = $('input[name="dates"]').data('daterangepicker');
  var arrive = picker.startDate.format("LL"),
      depart = picker.endDate.format("LL");
  $('#r_arrive').text(arrive);
  $('#r_depart').text(depart);
  $('#date_arrive').text(arrive);
  $('#date_depart').text(depart); // calculate GST

  $('#r_gst').text((cost * 0.05).asMoney());
  cost *= 1.05; // add GST

  $('#r_total').text(cost.asMoney());
}

Number.prototype.asMoney = function () {
  return "$".concat(this.toFixed(2));
};
/******/ })()
;