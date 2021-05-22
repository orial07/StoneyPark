window.Stepper = require('bs-stepper');
require('./bootstrap');
require('./gallery');

window.Stoney = {

    /**
     * Gets all campgrounds that are reserved during specified dates
     * 
     * @param {string} date date range (MM/DD/YYYY - MM/DD/YYYY)
     * @param {function} cb_success callback function for success
     * @param {fucntion} cb_error callback function for error
     */
    GetCampgroundsStatus: function (date, cb_success, cb_error) {
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
    },

    OnCampgroundLoaded: function (cg) {
        // virtual handler callback function for each loaded campgrounds
    },

    OnCampgroundsLoaded: function () {
        // virtual callback function for after {Stoney.GetCampgrounds} usage
    }
}

// load campsites on page load, if possible
jQuery(function () {
    let campsites = document.querySelector('#cg-campsite-list');
    if (!campsites) return;

    jQuery.ajax(`/api/cg/get`, {
        method: 'POST',
        dataType: 'json',
        error: (r, status, error) => {
            if (cb_error) cb_error(r, status, error);
        },
        success: (data, status, r) => {
            if (r.status == 200 && r.readyState == 4) {
                for (let i = 0; i < data.length; i++) {
                    let camp = data[i];
                    Stoney.OnCampgroundLoaded(campsites, camp);
                }
                Stoney.OnCampgroundsLoaded();
            }
        }
    });
});