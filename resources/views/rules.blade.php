@extends('template')

@section('content')
<div class="container mt-4">
    <p class="lead">
        We love our park, so we want the best for it.<br />
        Please read the following Yes and No rules and abide by them when on campgrounds.
    </p>

    <div class="list-group">
        <div class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">Yes</h5>
            </div>
            <p class="mb-1">Do that. Yes, that.</p>
            <small>Not the other thing.</small>
        </div>

        <div class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">No</h5>
            </div>
            <p class="mb-1">That's bad.</p>
            <small class="text-muted">Maybe take a picture of it... from afar</small>
        </div>

        <div class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">Maybe</h5>
            </div>
            <p class="mb-1">Be a STAR.</p>
            <small class="text-muted">That means Stop Think Act Review.</small>
        </div>
    </div> <!-- list-group end -->
</div>
@endsection