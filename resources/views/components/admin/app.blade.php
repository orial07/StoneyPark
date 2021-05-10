<x-app>
    <x-container class="mt-5">
        <div class="row gap-0">
            <div class="col-md-3 col-lg-2 col-sm-3">
                <x-admin.navbar></x-admin.navbar>
            </div>
            <div class="col">
                {{ $slot }}
            </div>
        </div>
    </x-container>
</x-app>
