<x-app>
    @section('title', 'Gallery')

    <x-socials class="my-5"></x-socials>

    <x-gallery :pictures="$pictures" :admin="false"></x-gallery>
</x-app>
