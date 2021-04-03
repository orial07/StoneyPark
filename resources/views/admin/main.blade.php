<x-app>
    <div class="container-md container-sm-fluid mt-4">
        <x-dashboard.navbar></x-dashboard.navbar>

        <p class="lead">Hey {!! auth()->user()->name !!}, welcome to the Admin Control Panel!</p>
        <p>Please don't touch anything if you don't know what you're doing. All tools and interfaces here are subject to
            change without notice.<br />
            If you are unsure about how something works, ask the monkey that made it! Things can always be improved or
            changed and your input would be greatly appreciated.
        </p>
    </div>
</x-app>
