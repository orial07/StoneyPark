<x-app>
    @section('head')
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endsection

    <div class="container-md container-sm-fluid mt-4">
        <x-dashboard.navbar></x-dashboard.navbar>

        <div class="m-5 lead">
            <p>All changes made can immediately affect the <a href="{{ route('reserve') }}">Reservation</a> page. Any
                modifications cannot be un-done.</p>
        </div>
        <div class="mb-4">
            <p>Click any marker on the interactive map below to enable editing of them at your discretion. Changes are
                local until clicking Save Changes.<br />
                After clicking Save Changes, any modifications <small>(ie. additions, deletions and information
                    changes)</small> are immediately and permanently applied for public viewing.</p>
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
    </div>

    <!-- toast notification -->
    <div class="toast position-fixed m-3 top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Saved!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Your changes have been saved successfully.
        </div>
    </div>


    @section('scripts')
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRE6SEIjNbmklk--s8yVx3XbyRmzC3yNM&callback=initMap&libraries=drawing&v=weekly"
            async></script>

        <script src="{{ asset('js/admin.map.js') }}"></script>
    @endsection
</x-app>
