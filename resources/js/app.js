window.Stepper = require('bs-stepper');
require('./bootstrap');
require('./gallery');

window.GetReservationsStatus = function(date, cb_success, cb_error) {
    jQuery.ajax(`/api/cg/status`, {
        method: 'POST',
        dataType: 'json',
        data: {
            dates: date
        },
        error: (r, status, error) => {
            if (cb_error) cb_error(r, status, error);
        },
        success: (data, status, r) => {
            if (r.status == 200 && r.readyState == 4) {
                if (cb_success) cb_success(data, status, r);
            }
        }
    });
}

window.ReservationAvailable = function (section, number, date, cb_success, cb_error) {
    jQuery.ajax(`/api/cg/reserved/${section}/${number}`, {
        method: 'POST',
        dataType: 'text',
        data: {
            dates: date
        },
        error: (r, status, error) => {
            if (cb_error) cb_error(r, status, error);
        },
        success: (data, status, r) => {
            if (r.status == 200 && r.readyState == 4) {
                if (cb_success) cb_success(data, status, r);
            }
        }
    });
}

window.GetCampgrounds = function (cb_success, cb_error) {
    jQuery.ajax(`/api/cg/get`, {
        method: 'POST',
        dataType: 'json',
        error: (r, status, error) => {
            if (cb_error) cb_error(r, status, error);
        },
        success: (data, status, r) => {
            if (r.status == 200 && r.readyState == 4) {
                if (cb_success) cb_success(data, status, r);
            }
        }
    });
}