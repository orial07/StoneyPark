<div {{ $attributes->merge(['class' => 'container']) }}>
    {{ $slot }}

    <div class="row justify-content-center">
        <div class="col-2 col-lg-1 mx-4 position-relative">
            <a class="stretched-link" href="https://facebook.com" target="_blank" title="Facebook">
                <object class="mx-auto display-1" data="{{ asset('img/facebook.svg') }}"
                    type="image/svg+xml"></object>
            </a>
        </div>
        <div class="col-2 col-lg-1 mx-4 position-relative">
            <a class="stretched-link" href="https://www.instagram.com/stoneyparkcampgrounds" target="_blank"
                title="Instagram">
                <object class="mx-auto display-1" data="{{ asset('img/instagram.svg') }}"
                    type="image/svg+xml"></object>
            </a>
        </div>
        <div class="col-2 col-lg-1 mx-4 position-relative">
            <a class="stretched-link" href="https://tiktok.com" target="_blank" title="TikTok">
                <object class="mx-auto display-1" data="{{ asset('img/tiktok.svg') }}" type="image/svg+xml"></object>
            </a>
        </div>
        <small class="text-muted text-center"><span class="text-primary">&num;stoneyparkcampgrounds</span> on all
            platforms</small>
    </div>
</div>
