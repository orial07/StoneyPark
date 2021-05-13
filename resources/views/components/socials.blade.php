<div {{ $attributes->merge(['class' => 'container']) }}>
    {{ $slot }}

    <div class="row g-0 justify-content-center">
        <div class="col-2 col-lg-1 mx-4 position-relative">
            <a class="stretched-link" href="https://facebook.com" target="_blank" title="Facebook">
                <x-svg-icon class="mx-auto display-1" :icon="'facebook'"></x-svg-icon>
            </a>
        </div>
        <div class="col-2 col-lg-1 mx-4 position-relative">
            <a class="stretched-link" href="https://www.instagram.com/stoneyparkcampgrounds" target="_blank" title="Instagram">
                <x-svg-icon class="mx-auto display-1" :icon="'instagram'"></x-svg-icon>
            </a>
        </div>
        <div class="col-2 col-lg-1 mx-4 position-relative">
            <a class="stretched-link" href="https://tiktok.com" target="_blank" title="TikTok">
                <x-svg-icon class="mx-auto display-1" :icon="'tiktok'"></x-svg-icon>
            </a>
        </div>
        <small class="text-muted text-center"><span class="text-primary">&num;stoneyparkcampgrounds</span> on all platforms</small>
    </div>
</div>