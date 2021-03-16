<x-dashboard.app>
    @section('head')
        <link rel="stylesheet" href="{{ asset('css/leaflet.css') }}" />
        <link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endsection

    <div class="container-md container-sm-fluid mt-4">
        <x-dashboard.navbar />

        <!-- Modal -->
        <div class="modal fade" id="propsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="properties" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Name</span>
                            <input type="text" id="popup-name" class="form-control" />
                        </div>

                        <div class="input-group">
                            <span class="input-group-text">Description</span>
                            <textarea class="form-control" aria-label="With textarea" id="popup-description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="toast position-fixed bottom-0 end-0 p-3 z-index-modal">
            <div class="d-flex">
                <div class="toast-body">
                    Save successful!
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>

        <div class="row">
            <div class="col-2">
                <div class="list-group" id="controls">
                </div>
            </div>
            <div class="col-10">
                <div id="map" style="height: 50vh"></div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>
        <script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>

        <script src="{{ asset('js/map.edit.js') }}"></script>
        <script>
            const controls = document.getElementById('controls');

            (function(j) {
                if (!j) return;
                L.geoJSON(JSON.parse(j), {
                    onEachFeature: onEachFeature
                }).addTo(map);
            })('{!! $geomap !!}');

            function onEachFeature(feature, layer) {
                console.log(feature);

                if (!feature.properties) return;

                controls.innerHTML +=
                    `<button class="list-group-item list-group-item-action">${feature.properties.name}</button>`;

                if (feature.properties.popupContent) layer.bindPopup(getPopupTemplate({
                    "name": feature.properties.name,
                    "popupContent": feature.properties.popupContent,
                }));
            }

        </script>
    @endsection
</x-dashboard.app>
