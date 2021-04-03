<x-dashboard.app>
    @section('head')
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endsection

    <div class="container-md container-sm-fluid mt-4">
        <x-dashboard.navbar />

        <div class="mb-4">
            <p>Click any marker on the interactive map below to enable editing of them at your discretion. When
                completed, click the save button to
                permanent apply changes.</p>
            <p>All changes <span class="text-muted">(information, deletion and additions)</span> are immediately
                applied for public viewing via <a href="{{ route('reserve') }}">reservation</a>
                page.</p>
            <div class="d-grid gap-1">
                <button class="btn btn-primary" onclick="SaveOverlays()">Save Changes</button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div id="map" style="height: 80vh"></div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="propsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="properties" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Name</span>
                            <input type="text" id="modal-name" class="form-control" required />
                            <small class="w-100 text-muted" id="modal-name-error"></small>
                        </div>

                        <div class="input-group">
                            <span class="input-group-text">Description</span>
                            <textarea class="form-control" aria-label="With textarea" id="modal-description"
                                required></textarea>
                            <small class="w-100 text-muted" id="modal-description-error"></small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="DeleteControl()">Delete</button>
                        <button type="button" class="btn btn-primary" onclick="SaveControl()">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- Modal end -->

    <div class="toast position-fixed bottom-0 end-0 p-3 z-index-modal">
        <div class="d-flex">
            <div class="toast-body"></div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>

    @section('scripts')
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRE6SEIjNbmklk--s8yVx3XbyRmzC3yNM&callback=initMap&libraries=drawing&v=weekly"
            async></script>

        <script src="{{ asset('js/map.edit.js') }}"></script>
    @endsection
</x-dashboard.app>
