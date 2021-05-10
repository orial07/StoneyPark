jQuery(function () {

    const cg = {
        campsites: document.querySelector('#cg-campsite-list'),
        input: document.querySelector('#cg-campsite-value'),
    };
    let previous; // the previously selected element
    const OnCampsiteClick = function (event) {
        event.preventDefault();

        let e = event.target;
        if (previous == e) return; // same element; ignore interaction

        e.classList.add('bg-primary', 'text-white');
        if (previous) previous.classList.remove('bg-primary', 'text-white');
        previous = e;

        let sp = e.id.split('-');
        let section = sp[0];
        let number = parseInt(sp[1]);
        cg.input.value = `${section}-${number}`;

        // jQuery.ajax(`/api/cg/get/${section}/${number}`, {
        //     method: 'POST',
        //     dataType: 'json',
        //     error: (r, status, error) => console.log(r, status, error),
        //     success: (data, status, r) => {
        //         if (r.status == 200 && r.readyState == 4) {
        //             let campground = data[0];
        //         }
        //     }
        // });
    };

    GetCampgrounds((data, status, r) => {
        for (let i = 0; i < data.length; i++) {
            let camp = data[i];

            let campsite = document.createElement('div');
            campsite.id = `${camp.section}-${camp.number}`;
            campsite.innerHTML = `Site ${camp.section}-${camp.number}`;
            campsite.classList.add('list-group-item');
            campsite.setAttribute('role', 'button');
            campsite.onclick = OnCampsiteClick;

            let status = document.createElement('span');
            status.id = `${camp.section}-${camp.number}-status`;
            status.classList.add('badge', 'float-end', 'bg-secondary');
            campsite.append(status);

            cg.campsites.append(campsite);
        }
    });
});