const DAY_MILLIS = 86400000;
const TIME_FORMAT = "MM/DD/YYYY";

var nights = 1;
jQuery(function () {
    $('#date_display').removeClass('d-none');

    // intialize stepper
    let stepperEl = $('.bs-stepper')[0];
    let stepper = window.stepper = new Stepper(stepperEl, {
        linear: true,
        animation: false,
        selectors: {
            steps: '.step',
            trigger: '.step-trigger',
            stepper: '.bs-stepper'
        }
    });
    stepper.reset();

    // initialize date-range-picker
    let now = moment().set({ hour: 0, minute: 0, second: 0, millisecond: 0 }),
        later = moment(now).add(1, 'day');
    $('input[name="dates"]').daterangepicker({
        startDate: now.format(TIME_FORMAT),
        endDate: later.format(TIME_FORMAT),
        minDate: now.format(TIME_FORMAT),
    }, function (start, end, label) {
        onDateChanged(start, end);
    });
    onDateChanged(now, later); // initialize number of nights

    let form = $('#reserve-form')[0];
    onCampersChanged($('#campers_count')[0]); // initialize fields for number of campers
    form.addEventListener('change', function (e) {
        if (e.target.name == "campers_count") onCampersChanged(e.target);
        update();
    });
});

// gets the selected camping type
function getCampingType() {
    // by looping through all radio buttons
    let es = document.getElementsByName('camping_type');
    for (let i = 0; i < es.length; i++) {
        // return the first input that's checked
        if (es[i].checked) return i;
    }
    return undefined;
}

// updates number of nights based on arrival and departure reservation dates
function onDateChanged(start, end) {
    start = start.startOf('day');
    end = end.startOf('day');

    let days = moment.duration(end.diff(start)).asDays();

    if (days < 1) {
        $('#nights').html(`<span class="text-danger fw-bold">The reservation must be at least 1 night.</span>`);
        return;
    }

    nights = Math.round(days);
    update();
}

// updates form control inputs for number of campers
function onCampersChanged(e) {
    let count = Math.max(1, Math.min(6, e.value));
    let campers = $('#campers')[0];
    campers.innerHTML = ""; // reset
    for (let i = 0; i < count - 1; i++) {
        // add inputs
        campers.innerHTML += `\
<div class="input-group mb-3">\
    <div class="input-group-prepend">\
        <span class="input-group-text" id="">Name</span>\
    </div>\
    <input type="text" class="form-control" placeholder="First Name" name="camper${i}_first_name" autofocus required />\
    <input type="text" class="form-control" placeholder="Last Name" name="camper${i}_last_name" required />\
</div>`;
    }
}

// updates page contents
function update() {
    $('#nights').html(`This reservation will be for <span class="text-primary">${nights} night${nights == 1 ? '' : 's'}</span>`);

    let campingType = CAMPING_TYPES[getCampingType()];

    let cost = campingType.price * nights; // recurring charges (price per night)

    // update review step contents
    $('#r_camping_name').text(campingType.name);
    $('#r_camping_qty').text(campingType.quantity);
    $('#r_camping_cost').text(campingType.price2.asMoney());
    $('#r_nights_qty').text(nights);
    $('#r_nights_cost').text(cost.asMoney());

    cost += campingType.price2; // one-time fee

    for (let i = 0; i < CAMPING_TYPES.length; i++) {
        let ct = CAMPING_TYPES[i];
        $(`#ct_cost_${i + 1}`).text(`$${((ct.price * nights) + ct.price2).toFixed(2)}`);
    }

    $('#r_customer_name').text(`${$('input[name="first_name"]').val()} ${$('input[name="last_name"]').val()}`);
    $('#r_customer_email').text(`${$('input[name="email"]').val()}`);
    $('#r_customer_phone').text(`${$('input[name="phone"]').val()}`);

    let picker = $('input[name="dates"]').data('daterangepicker');
    let arrive = picker.startDate.format("LL"),
        depart = picker.endDate.format("LL");

    $('#r_arrive').text(arrive);
    $('#r_depart').text(depart);
    $('#date_arrive').text(arrive);
    $('#date_depart').text(depart);

    // calculate GST
    $('#r_gst').text((cost * 0.05).asMoney());
    cost *= 1.05; // add GST
    $('#r_total').text(cost.asMoney());
}

Number.prototype.asMoney = function () {
    return `$${this.toFixed(2)}`;
}