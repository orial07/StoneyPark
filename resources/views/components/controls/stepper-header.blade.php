@props(['step'])

<div {{ $attributes->merge(['class' => 'step']) }} data-target="#step-trigger-{!! $step !!}">
    <button type="button" class="step-trigger" role="tab" id="step-{!! $step !!}" aria-controls="step-trigger-{!! $step !!}"
        aria-selected="true">
        <span class="bs-stepper-circle"><span aria-hidden="true">{!! $step !!}</span></span>
        <span class="bs-stepper-label">{{ $slot }}</span>
    </button>
</div>