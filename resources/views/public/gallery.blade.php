<x-app>
    @section('title', 'Gallery')

    <x-socials class="mb-5">
        <p class="lead p-5">Remember to find and tag us on social media! You can find much more behind the scenes and community content.</p>
    </x-socials>

    <x-pictures :pictures="$pictures" :names="false"></x-pictures>
</x-app>
