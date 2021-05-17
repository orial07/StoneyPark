jQuery(function () {
    let eMODAL = document.getElementById("img-modal");

    // "lazy" load any img elements with the lazysrc attribute
    let images = document.getElementsByTagName('img');
    for (let i = 0; i < images.length; i++) {
        // lazy load image
        let image = images[i];
        if (!image.attributes.lazysrc) continue;
        image.src = image.attributes.lazysrc.value;
        image.removeAttribute('lazysrc');
        if (eMODAL) {
            image.setAttribute('role', 'button');
        }
    }

    if (!eMODAL) return;
    const MODAL = new bootstrap.Modal(eMODAL);
    const MODAL_IMG = document.querySelector('#img-modal-img');

    for (let i = 0; i < images.length; i++) {
        let image = images[i];

        image.addEventListener('click', function () {
            MODAL_IMG.src = image.src.replace('thumbnail/', '');
            MODAL.show();
        });
    }
});