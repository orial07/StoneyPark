@extends('template')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-4">
            <img src="{{ asset('img/gallery/fire.jpg') }}" class="img-thumbnail" />
        </div>
        <div class="col-4">
            <img src="{{ asset('img/gallery/fire.jpg') }}" class="img-thumbnail" />
        </div>
        <div class="col-4">
            <img src="{{ asset('img/gallery/fire.jpg') }}" class="img-thumbnail" />
        </div>
    </div>
</div>
@endsection