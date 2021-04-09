<x-app>
    <x-container class="mt-5">
        <div class="row">
            <div class="col-md-2 col-sm-3">
                <x-admin.navbar></x-admin.navbar>
            </div>
            <div class="col">
                {{ $slot }}
            </div>
    </x-container>
</x-app>
