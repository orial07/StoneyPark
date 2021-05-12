jQuery(function () {
    // "lazy" load any img elements with the lazysrc attribute
    let images = document.getElementsByTagName('img');
    for (let i = 0; i < images.length; i++) {
        // lazy load image
        let image = images[i];
        if (!image.attributes.lazysrc) continue;
        image.src = image.attributes.lazysrc.value;
        image.removeAttribute('lazysrc', );
    }

    let e = document.getElementById("gallery-modal");
    if (!e) return;

    const MODAL = new bootstrap.Modal(e);
    const MODAL_IMAGE = document.getElementById("gallery-modal-img");

    const IMAGES = document.getElementsByClassName('gallery-img');
    for (let i = 0; i < IMAGES.length; i++) {
        let image = IMAGES[i];

        image.addEventListener('click', function () {
            MODAL_IMAGE.src = image.src;
            MODAL.show();
        });
    }
});