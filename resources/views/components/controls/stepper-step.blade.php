@props(['step'])

<div id="step-trigger-{{ $step }}" role="tabpanel"
    {{ $attributes->merge(['class' => 'bs-stepper-pane fade dstepper-block']) }}
    aria-labelledby="step-{{ $step }}">
    {{ $slot }}
</div>
