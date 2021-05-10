<x-admin.app>
    <div class="row">
        <div class="col">
            <div class="carousel slide" id="cg-carousel" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active"><img src="https://dummyimage.com/1"></div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#cg-carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#cg-carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-xs-12 col-lg-6">
            <dl class="row">
                <dt class="col-4">Amenities</dt>
                <dd class="col-8">
                    <x-svg-icon :icon="'fire'">Firepit</x-svg-icon>
                    <x-svg-icon :icon="'table'">Picnic Table</x-svg-icon>
                </dd>
            </dl>
        </div>
        <div class="col-3 user-select-none d-flex position-relative">
            <ul id="cg-campsite-list" class="position-absolute w-100 h-100 overflow-auto">
            </ul>
        </div>
    </div>
</x-admin.app>
