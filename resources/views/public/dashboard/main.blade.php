<x-dashboard.app>
    <div class="container mt-4">
        <x-dashboard.navbar />

        <div class="text-center">
            <h1 class="display-4">Welcome back, {{ Auth::user()->name }}!</h1>
            <p>Welcome to the Administrator dashboard.</p>
        </div>
    </div>
</x-dashboard.app>
