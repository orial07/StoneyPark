@if ($errors->any())
    @if ($errors->first() == 'success')
        <div class="alert alert-success">{{ $errors->success }}</div>
    @else
        <div class="alert alert-danger">
            <ul class="m-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endif
