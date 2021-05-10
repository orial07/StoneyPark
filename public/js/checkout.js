/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/checkout.js ***!
  \**********************************/
Number.prototype.asMoney = function () {
  return "$ ".concat(this.toFixed(2));
};

var DAY_MILLIS = 86400000;
var TIME_FORMAT = "MM/DD/YYYY";
jQuery(function () {
  // initialize date-range-picker
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

  onCampersChanged(); // initialize fields for number of campers

  document.querySelector('#campers-count').onchange = function (e) {
    return onCampersChanged();
  };

  document.querySelector('#reserve-form').onchange = function (e) {
    return update();
  };
}); // updates number of nights based on arrival and departure reservation dates

function onDateChanged(start, end) {
  start = start.startOf('day');
  end = end.startOf('day');
  nights = moment.duration(end.diff(start)).asDays();

  if (nights < 1) {
    $('#nights').html("<span class=\"text-danger\">The reservation must be at least 1 night long.</span>");
    return;
  }

  update();
} // updates form control inputs for number of campers


function onCampersChanged() {
  var container = document.querySelector('#campers-container');
  var count = Math.max(1, Math.min(6, document.querySelector('#campers-count').value));
  container.innerHTML = ""; // reset contents, then add inputs

  for (var i = 0; i < count - 1; i++) {
    container.innerHTML += "<div class=\"row\">    <div class=\"col\">        <div class=\"mb-3\">            <label class=\"form-label w-100\" for=\"camper-name-first-".concat(i, "\">First Name</label>            <input class=\"form-control\" id=\"camper-name-first-").concat(i, "\" name=\"camper-name-first-").concat(i, "\" type=\"text\" autocomplete=\"on\" required=\"true\" placeholder=\"First Name\">        </div>    </div>    <div class=\"col\">        <div class=\"mb-3\">            <label class=\"form-label w-100\" for=\"camper-name-last-").concat(i, "\">Last Name</label>            <input class=\"form-control\" id=\"camper-name-last-").concat(i, "\" name=\"camper-name-last-").concat(i, "\" type=\"text\" autocomplete=\"on\" required=\"true\" placeholder=\"Last Name\">        </div>    </div></div>");
  }
} // updates page contents


function update() {
  $('#nights').html("This reservation will be for <span class=\"text-primary\">".concat(nights, " night").concat(nights == 1 ? '' : 's', "</span>"));
  var ct = CAMPING_TYPES[document.querySelector('input[name=camp-type]:checked').value];
  var cost = ct.price * nights; // recurring charges (price per night)
  // update review step contents

  $('#invoice-camp-type').text(ct.name);
  $('#invoice-camp-price').text(ct.price2.asMoney());
  $('#invoice-nights-qty').text(nights);
  $('#invoice-nights-price').text(cost.asMoney());
  cost += ct.price2; // one-time fee

  $('#invoice-tax-gst').text((cost * 0.05).asMoney());
  $('#invoice-total').text((cost *= 1.05).asMoney());

  for (var i = 0; i < CAMPING_TYPES.length; i++) {
    var _ct = CAMPING_TYPES[i];
    var total = _ct.price * nights + _ct.price2;
    $("#camp-type-price-".concat(i)).text(total.asMoney());
  }

  var picker = $('input[name="dates"]').data('daterangepicker');
  var date_in = picker.startDate.format("LL"),
      date_out = picker.endDate.format("LL");
  $('#date-in').text(date_in);
  $('#date-out').text(date_out); // check campsite status based on selected reservation dates
  // any campsites returned in ${data} is meant to be unavailable

  GetReservationsStatus(picker.element[0].value, function (data, status, r) {
    var campsites = document.querySelectorAll('#cg-campsite-list > div'); // loop thru all campsites

    for (var a = 0; a < campsites.length; a++) {
      var campsite = campsites[a];

      var _status = document.querySelector("#".concat(campsite.id, "-status"));

      _status.classList.remove('bg-danger', 'bg-success', 'bg-secondary');

      var available = true;

      for (var b = 0; b < data.length; b++) {
        // campsite was found in the returned ${data}
        if (campsite.id == data[b].campground_id) {
          _status.classList.add('bg-danger');

          _status.innerHTML = "Unavaialble";
          available = false;
          break;
        }
      }

      _status.classList.add('bg-success');

      if (available) _status.innerHTML = "Available";
    }
  });
}
/******/ })()
;