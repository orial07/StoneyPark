
const DoRefreshCampgroundsStatus = function () {
    let btn = document.querySelector('#cg-campsite-refresh');
    btn.innerHTML = `\
<div class="spinner-border" role="status">
  <span class="visually-hidden">Loading...</span>
</div>`;

    let picker = $('input[name="dates"]').data('daterangepicker');
    let date_in = picker.startDate.format(TIME_FORMAT), date_out = picker.endDate.format(TIME_FORMAT);

    (function () {
        let campsites = document.querySelectorAll('#cg-campsite-list > div');
        // loop thru all campsites
        for (let a = 0; a < campsites.length; a++) {
            let campsite = campsites[a]; // DOM element
            let status = document.querySelector(`#${campsite.id}-status`); // DOM element
            status.innerHTML = "Checking...";
            status.classList.remove('bg-danger', 'bg-success', 'bg-warning', 'text-dark');
        }
    })();

    // check campsite status based on selected reservation dates
    // any campsites returned in ${data} is meant to be unavailable
    Stoney.GetCampgroundsStatus(`${date_in} - ${date_out}`, (data, status, r) => {
        let campsites = document.querySelectorAll('#cg-campsite-list > div');
        // loop thru all campsites
        for (let a = 0; a < campsites.length; a++) {
            let campsite = campsites[a]; // DOM element
            let status = document.querySelector(`#${campsite.id}-status`); // DOM element

            let available = true;
            for (let b = 0; b < data.length; b++) {
                let row = data[b]; // check if campsite was found in the returned ${data}
                if (campsite.id != row.campground_id) continue;

                switch (row.status) {
                    case 'paid': {
                        status.classList.add('bg-danger');
                        status.innerHTML = "Reserved";
                        available = false;
                        break;
                    }
                    case 'pending': {
                        let diff = moment.duration(moment().diff(moment(row.updated_at)));
                        if (diff.asMinutes() >= 5) break; // sufficient time has passed; the campsite is available
                        status.classList.add('bg-warning', 'text-dark');
                        status.innerHTML = "Pending";
                        available = false;
                        break;
                    }
                }
            }

            status.classList.add('bg-success');
            if (available) status.innerHTML = "Available";
        }
        btn.innerHTML = "Refresh";
    });
};

// updates number of nights based on arrival and departure reservation dates
const OnDateChanged = function (start, end) {
    start = start.startOf('day');
    end = end.startOf('day');
    nights = moment.duration(end.diff(start)).asDays();
    if (nights < 1) {
        $('#nights').html(`<span class="text-danger">The reservation must be at least 1 night long.</span>`);
        return;
    }
    DoUpdateDOM();
    DoRefreshCampgroundsStatus();
};


// updates form control inputs for number of campers
const OnCampersCountChanged = function () {
    let container = document.querySelector('#campers-container');
    let count = document.querySelector('#campers-count').value;

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
};

// updates page contents
const DoUpdateDOM = function () {
    $('#nights').html(`This reservation will be for <span class="fw-bold">${nights} night${nights == 1 ? '' : 's'}</span>`);

    let ctIndex = document.querySelector('input[name=camp-type]:checked').value;
    let keys = Object.keys(Stoney.Camps);
    let cg = Stoney.Camps[keys[ctIndex]];

    let cost = cg.price * nights; // recurring charges (price per night)

    // set max amount of campers
    document.querySelector('#campers-count').setAttribute('max', cg.campers);

    // update review step contents
    $('#invoice-camp-type').text(cg.name);
    $('#invoice-camp-price').text(cg.price2.asMoney());
    $('#invoice-nights-qty').text(nights);
    $('#invoice-nights-price').text(cost.asMoney());

    cost += cg.price2; // one-time fee

    $('#invoice-tax-gst').text((cost * 0.05).asMoney());
    $('#invoice-total').text((cost *= 1.05).asMoney());

    for (let i = 0; i < keys.length; i++) {
        let ct = Stoney.Camps[keys[i]];
        let total = ((ct.price * nights) + ct.price2);
        $(`#camp-type-price-${i}`).text(total.asMoney());
    }

    let picker = $('input[name="dates"]').data('daterangepicker');
    let date_in = picker.startDate.format("LL"), date_out = picker.endDate.format("LL");
    $('#date-in').text(date_in);
    $('#date-out').text(date_out);
}

// when campgrounds are loaded, create and add elements to the campgrounds list
Stoney.OnCampgroundLoaded = function (campsites, cg) {
    let previous; // the previously selected element

    // when a campsite is clicked, visually show that it's clicked and update the input field
    const OnCampsiteClick = function (event) {
        event.preventDefault();

        let e = event.target;
        if (previous == e) return; // same element; ignore interaction

        // add classes to visualize selection of the element
        e.classList.add('bg-primary', 'text-white');
        if (previous) previous.classList.remove('bg-primary', 'text-white');
        previous = e;

        let sp = e.id.split('-');
        let section = sp[0];
        let number = parseInt(sp[1]);

        // elements are contained in a form and needs to update an input field (cg-campsite-value)
        document.querySelector('#cg-campsite-value').value = `${section}-${number}`;
    };

    // create the campsite element
    let campsite = document.createElement('div');
    campsite.id = `${cg.section}-${cg.number}`;
    campsite.innerHTML = `Site ${cg.section}-${cg.number}`;
    campsite.classList.add('list-group-item', 'overflow-auto');
    campsite.setAttribute('role', 'button'); // add pointer cursor
    campsite.onclick = OnCampsiteClick;

    // add a badge to each campsite element
    let status = document.createElement('span');
    status.id = `${cg.section}-${cg.number}-status`;
    status.innerHTML = 'Loading...';
    status.classList.add('badge', 'float-md-end', 'bg-secondary', 'd-block', 'pe-none');
    campsite.append(status);

    campsites.append(campsite);
};

// when all campgrounds loaded, update date range picker which then updates all campgrounds status
Stoney.OnCampgroundsLoaded = function () {
    let picker = $('input[name="dates"]').data('daterangepicker');
    OnDateChanged(picker.startDate, picker.endDate); // initialize number of nights
};

const TIME_FORMAT = "MM/DD/YYYY";
Number.prototype.asMoney = function () {
    return `$ ${this.toFixed(2)}`;
}

// on page load handler
jQuery(function () {
    // initialize date-range-picker
    let min = moment('2021-05-21');
    let max = moment('2021-10-18');
    let start = min.isAfter(moment()) ? min : moment();
    start.set({ hour: 0, minute: 0, second: 0, millisecond: 0 });
    let end = moment(start).add(1, 'day');

    $('input[name="dates"]').daterangepicker({
        startDate: start.format(TIME_FORMAT),
        endDate: end.format(TIME_FORMAT),
        minDate: min.format(TIME_FORMAT),
        maxDate: max.format(TIME_FORMAT),
    }, function (start, end, label) {
        OnDateChanged(start, end);
    });

    OnCampersCountChanged(); // initialize fields for number of campers
    document.querySelector('#campers-count').onchange = (e) => OnCampersCountChanged();
    document.querySelector('#reserve-form').onchange = (e) => DoUpdateDOM();
    document.querySelector('#cg-campsite-refresh').onclick = () => DoRefreshCampgroundsStatus();
});