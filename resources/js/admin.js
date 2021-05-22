const TIME_FORMAT = "MM/DD/YYYY";

Stoney.OnCampgroundLoaded = function (campsites, cg) {
    let campground_id = `${cg.section}-${cg.number}`;
    let campsite = document.createElement('option');
    campsite.innerHTML = campground_id;

    if (campground_id == reservation.campground_id) {
        campsite.setAttribute('selected', '');
    }

    campsites.append(campsite);
};

jQuery(function () {
    // initialize date-range-picker
    let min = moment('2021-05-21');
    let max = moment('2021-10-18');

    let start = moment(reservation.date_in);
    let end = moment(reservation.date_out);

    $('input[name="dates"]').daterangepicker({
        startDate: start.format(TIME_FORMAT),
        endDate: end.format(TIME_FORMAT),
        minDate: min.format(TIME_FORMAT),
        maxDate: max.format(TIME_FORMAT),
    });
});