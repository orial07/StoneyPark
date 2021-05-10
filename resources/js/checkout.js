Number.prototype.asMoney = function () {
    return `$ ${this.toFixed(2)}`;
}

const DAY_MILLIS = 86400000;
const TIME_FORMAT = "MM/DD/YYYY";

jQuery(function () {
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
    onCampersChanged(); // initialize fields for number of campers
    document.querySelector('#campers-count').onchange = (e) => onCampersChanged();
    document.querySelector('#reserve-form').onchange = (e) => update();
});

// updates number of nights based on arrival and departure reservation dates
function onDateChanged(start, end) {
    start = start.startOf('day');
    end = end.startOf('day');
    nights = moment.duration(end.diff(start)).asDays();
    if (nights < 1) {
        $('#nights').html(`<span class="text-danger">The reservation must be at least 1 night long.</span>`);
        return;
    }
    update();

    // check campsite status based on selected reservation dates
    // any campsites returned in ${data} is meant to be unavailable
    GetReservationsStatus(`${start.format(TIME_FORMAT)} - ${end.format(TIME_FORMAT)}`, (data, status, r) => {
        let campsites = document.querySelectorAll('#cg-campsite-list > div');
        // loop thru all campsites
        for (let a = 0; a < campsites.length; a++) {
            let campsite = campsites[a]; // DOM element
            let status = document.querySelector(`#${campsite.id}-status`); // DOM element
            status.innerHTML = "Checking...";
            status.classList.remove('bg-danger', 'bg-success');

            let available = true;
            for (let b = 0; b < data.length; b++) {
                // campsite was found in the returned ${data}
                if (campsite.id == data[b].campground_id) {
                    status.classList.add('bg-danger');
                    status.innerHTML = "Unavaialble";
                    available = false;
                    break;
                }
            }

            status.classList.add('bg-success');
            if (available) status.innerHTML = "Available";
        }
    });
}

// updates form control inputs for number of campers
function onCampersChanged() {
    let container = document.querySelector('#campers-container');
    let count = Math.max(1, Math.min(6, document.querySelector('#campers-count').value));

    container.innerHTML = ""; // reset contents, then add inputs
    for (let i = 0; i < count - 1; i++) {
        container.innerHTML += `\
<div class="row">\
    <div class="col">\
        <div class="mb-3">\
            <label class="form-label w-100" for="camper-name-first-${i}">First Name</label>\
            <input class="form-control" id="camper-name-first-${i}" name="camper-name-first-${i}" type="text" autocomplete="on" required="true" placeholder="First Name">\
        </div>\
    </div>\
    <div class="col">\
        <div class="mb-3">\
            <label class="form-label w-100" for="camper-name-last-${i}">Last Name</label>\
            <input class="form-control" id="camper-name-last-${i}" name="camper-name-last-${i}" type="text" autocomplete="on" required="true" placeholder="Last Name">\
        </div>\
    </div>\
</div>`;
    }
}

// updates page contents
function update() {
    $('#nights').html(`This reservation will be for <span class="text-primary">${nights} night${nights == 1 ? '' : 's'}</span>`);

    let ct = CAMPING_TYPES[document.querySelector('input[name=camp-type]:checked').value];
    let cost = ct.price * nights; // recurring charges (price per night)

    // update review step contents
    $('#invoice-camp-type').text(ct.name);
    $('#invoice-camp-price').text(ct.price2.asMoney());
    $('#invoice-nights-qty').text(nights);
    $('#invoice-nights-price').text(cost.asMoney());

    cost += ct.price2; // one-time fee

    $('#invoice-tax-gst').text((cost * 0.05).asMoney());
    $('#invoice-total').text((cost *= 1.05).asMoney());

    for (let i = 0; i < CAMPING_TYPES.length; i++) {
        let ct = CAMPING_TYPES[i];
        let total = ((ct.price * nights) + ct.price2);
        $(`#camp-type-price-${i}`).text(total.asMoney());
    }

    let picker = $('input[name="dates"]').data('daterangepicker');
    let date_in = picker.startDate.format("LL"), date_out = picker.endDate.format("LL");
    $('#date-in').text(date_in);
    $('#date-out').text(date_out);
}