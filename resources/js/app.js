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

    OnCampgroundsLoaded: function () {
        // virtual callback function for after {Stoney.GetCampgrounds} usage
    }
}

jQuery(function () {
    const cg = {
        // container for all campsites
        campsites: document.querySelector('#cg-campsite-list'),
        // used as a form input when selecting from #cg-campsite-list
        input: document.querySelector('#cg-campsite-value'),
    };
    if (!cg.campsites) return;

    let previous; // the previously selected element
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
        if (cg.input) {
            // elements are contained in a form and needs to update an input field (cg-campsite-value)
            cg.input.value = `${section}-${number}`;
        }

        // update description of campsite if present
        jQuery.ajax(`/api/cg/get/${section}/${number}`, {
            method: 'POST',
            dataType: 'json',
            error: (r, status, error) => console.log(r, status, error),
            success: (data, status, r) => {
                if (r.status == 200 && r.readyState == 4) {
                    let campground = data[0];
                    document.querySelector('#cg-amenity-fire').classList[campground.has_fire ? 'remove' : 'add']('d-none');
                    document.querySelector('#cg-amenity-table').classList[campground.has_table ? 'remove' : 'add']('d-none');
                }
            }
        });
    };

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

                    let campsite = document.createElement('div');
                    campsite.id = `${camp.section}-${camp.number}`;
                    campsite.innerHTML = `Site ${camp.section}-${camp.number}`;
                    campsite.classList.add('list-group-item', 'overflow-auto');
                    campsite.setAttribute('role', 'button');
                    campsite.onclick = OnCampsiteClick;

                    if (cg.input) {
                        let status = document.createElement('span');
                        status.id = `${camp.section}-${camp.number}-status`;
                        status.innerHTML = 'Loading...';
                        status.classList.add('badge', 'float-md-end', 'bg-secondary', 'd-block', 'pe-none');
                        campsite.append(status);
                    }

                    cg.campsites.append(campsite);
                }

                if (Stoney.OnCampgroundsLoaded) {
                    Stoney.OnCampgroundsLoaded();
                }
            }
        }
    });
});