<x-admin.app>
    <div class="row">
        <div id="campground-body" class="col">
            <div class="row justify-content-around fs-5">
                <div class="col">
                    <x-amenity :type="'fire'">Fire Pit</x-amenity>
                </div>
                <div class="col">
                    <x-amenity :type="'table'">Picnic Table</x-amenity>
                </div>
            </div>

            <div id="campground-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://via.placeholder.com/1" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#campground-carousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#campground-carousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-3">
            <ul id="campground-sections" class="d-flex list-group overflow-auto">
                @foreach (ReservationUtil::getCampgrounds() as $item)
                    <li class="list-group-item" id="{{ $item->section }}-{{ $item->number }}">
                        <a href="#" class="stretched-link text-decoration-none">Site
                            {{ $item->section }}-{{ $item->number }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-admin.app>
