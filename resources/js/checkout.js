const Invoice = {
    'campingType': 0,
    'nightsReserved': 1,
    'campersCount': 0,
};

const form = document.reserve_form;
const total = document.getElementById('total');

$(document).ready(function () {
    // minimum 1 night of staying
    form.date_in.value = new Date().toISOString().substring(0, 10);
    form.date_out.value = new Date(Date.now() + 86400000).toISOString().substring(0, 10);
    update();

    form.addEventListener('change', function (e) {
        if (e.target.name == 'campingType') onCampingTypeChanged(e.target);
        else if (e.target.name.substring(0, 4) == 'date') onDateChanged(e.target);
        else if (e.target.name == "campers") onCampersChanged(e.target);
        update();
    });
});

function onCampingTypeChanged(e) {
    let type = parseInt(e.value);
    if (isNaN(type)) return;
    // clamp value
    Invoice.campingType = Math.max(0, Math.min(campingTypes.length, type));
}

function onDateChanged(e) {
    let cin = form.date_in.value || null,
        cout = form.date_out.value || null;
    if (cin == null || cout == null) return;

    let din = new Date(cin),
        dout = new Date(cout);

    if (dout <= din) {
        // check-out must be after the check-in date
        form.date_out.value = (dout = new Date(din.getTime() + 86400000)).toISOString().substring(0, 10);
    }

    let diff = dout - din;
    let days = diff / 1000 / 60 / 60 / 24;

    Invoice.nightsReserved = days;
}

function onCampersChanged(e) {
    let count = Invoice.campersCount = Math.max(1, Math.min(6, e.value));
    let campers = document.getElementById('campers');

    campers.innerHTML = ""
    for (let i = 0; i < count - 1; i++) {
        campers.innerHTML +=
            `<div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">Name</span>
                </div>
                <input type="text" class="form-control" placeholder="First Name" name="camper${i}_first_name" autofocus required />
                <input type="text" class="form-control" placeholder="Last Name" name="camper${i}_last_name" required />
            </div>`;
    }
}

function update() {
    let cost = 0;

    document.getElementById('day_count').innerHTML = `This reservation will be for ${Invoice.nightsReserved} night${Invoice.nightsReserved > 1 ? 's' : ''}.`;

    let campingType = Invoice.campingType;
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
