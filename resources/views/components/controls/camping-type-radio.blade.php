<div class="col-sm col-md-4 card">
    <input class="form-check-input" type="radio" name="camping_type" id="ct_{{ $i }}"
        value="{{ $i }}" @if ($i == 0) checked @endif>

    <p><span class="fs-1" id="ct_cost_{{ $i }}">{!! $ct->price + $ct->price2 !!}</span><small>+GST</small></p>

    <label role="button" class="stretched-link fs-4" for="ct_{{ $i }}">{!! $ct->name !!}</label>

    <small>${!! $ct->price !!}/night
        @if ($ct->price2)
            + ${!! $ct->price2 !!} initial fee
        @endif
    </small>

    <hr />

    <ul class="list-unstyled my-3 text-start">
        @foreach ($ct->description as $type => $description)
            <li>
                <x-amenity :type="$type">{!! $description !!}</x-amenity>
            </li>
        @endforeach
    </ul>
</div>
