const DAY_MILLIS = 86400000;
const TIME_FORMAT = "MM/DD/YYYY";
const form = document.reserve_form;

var nights = 1;

$(document).ready(function () {
    let stepper = window.stepper = new Stepper($('.bs-stepper')[0], {
        linear: false,
        animation: false,
        selectors: {
            steps: '.step',
            trigger: '.step-trigger',
            stepper: '.bs-stepper'
        }
    });
    stepper.reset();

    let now = moment(),
        later = moment().add(1, 'day');
    $('input[name="dates"]').daterangepicker({
        startDate: now.format(TIME_FORMAT),
        endDate: later.format(TIME_FORMAT),
        minDate: now.format(TIME_FORMAT),
        autoApply: true,
    }, function (start, end, label) {
        onDateChanged(start, end);
    });
    $('input[name="dates"]').on('apply.daterangepicker', function (ev, picker) {
        let start = picker.startDate, end = picker.endDate;
        if (start.format("MM/DD/YYYY") >= end.format("MM/DD/YYYY")) {
            end = moment(start).add(1, 'day');
            $(this).val(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
            onDateChanged(start, end);
        }
    });

    onDateChanged(now, later); // initialize number of nights
    onCampersChanged(form.campers); // initialize fields for number of campers
    form.addEventListener('change', function (e) {
        if (e.target.name == "campers") onCampersChanged(e.target);
        update();
    });
    update();
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
    let days = moment.duration(end.diff(start)).days();
    nights = Math.round(days) + 1;
    update();
}

// updates form control inputs for number of campers
function onCampersChanged(e) {
    let count = Math.max(1, Math.min(6, e.value));
    let campers = document.getElementById('campers');
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
    $('#nights').text(`${nights} night${nights == 1 ? '' : 's'}`);

    let campingType = getCampingType();
    // update review step contents
    let selection = [
        // per-night cost, title, qty, total
        [39, 'Medium Tent', '1', 0],
        [39, 'Extra Medium Tent', '2', 30],
        [69, 'Recreational Vehicle', '1', 0],
    ][campingType];
    let cost = selection[0];
    $('#r_camping_type').text(selection[1]);
    $('#r_camping_type_qty').text(selection[2]);
    $('#r_camping_type_cost').text(selection[3]);

    $('#r_nights_qty').text(nights);
    $('#r_nights_cost').text(cost *= nights);

    $('#r_customer_name').text(`${$('input[name="first_name"]').val()} ${$('input[name="last_name"]').val()}`);
    $('#r_customer_email').text(`${$('input[name="email"]').val()}`);
    $('#r_customer_phone').text(`${$('input[name="phone"]').val()}`);

    let picker = $('input[name="dates"]').data('daterangepicker');
    let arrive = picker.startDate.format("LL"),
        depart = moment(picker.endDate).add(1, 'day').format("LL");
    $('#r_arrive').text(arrive);
    $('#r_depart').text(depart);
    $('#date_arrive').text(arrive);
    $('#date_depart').text(depart);

    if (campingType == 1) cost += 30; // one-time fee

    $('#total').text("$" + cost);
}
