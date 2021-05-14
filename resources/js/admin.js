const TIME_FORMAT = "MM/DD/YYYY";

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