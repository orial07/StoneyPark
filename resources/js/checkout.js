const DAY_MILLIS = 86400000;
const form = document.reserve_form;
const total = document.getElementById('total');

var nights = 1;

$(document).ready(function () {
    update();

    let now = new Date();
    $('input[name="dates"]').daterangepicker({
        minDate: now,
        startDate: now,
        endDate: new Date(now.getTime() + DAY_MILLIS),
    }, function(start, end, label) {
        onDateChanged(start, end);
    });

    form.addEventListener('change', function (e) {
        if (e.target.name == "campers") onCampersChanged(e.target);
        update();
    });
});

function getCampingType() {
    let es = document.getElementsByName('camping_type');
    for (let i = 0; i < es.length; i++) {
        if (es[i].checked) return i;
    }
    return undefined;
}

function onDateChanged(start, end) {
    let diff = end - start;
    let days = diff / 1000 / 60 / 60 / 24;

    nights = Math.round(days);
    update();
}

function onCampersChanged(e) {
    let count = Math.max(1, Math.min(6, e.value));
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

    document.getElementById('day_count').innerHTML = `This reservation will be for <strong>${nights} night${nights > 1 ? 's' : ''}</strong>`;

    let campingType = getCampingType();
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
