<x-app>
    <x-container class="mt-5">
        <div class="row">
            <div class="col-2">
                <x-admin.navbar></x-admin.navbar>
            </div>
            <div class="col">
                {{ $slot }}
            </div>
    </x-container>
</x-app>
