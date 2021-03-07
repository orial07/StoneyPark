@extends('template')

@section('content')
<div class="container mt-4">
    <div class="row">
        @for($i = 0; $i < sizeof($gallery); $i++)
        <div class="col-4">
            <img src="{{ asset($gallery[$i]->image) }}" class="img-thumbnail img-thumbnail-grow m-2" />
        </div>
        @endfor
    </div>
</div>
@endsection