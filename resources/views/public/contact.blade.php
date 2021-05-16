<x-app>
    @section('title', 'Contact Us')
    @section('description', 'Send a message if you have any questions, suggestions, comments or concerns')

    @section('head')
    <!-- google recaptcha api -->
    <script src="https://www.google.com/recaptcha/enterprise.js?render={{ config('app.google_recaptcha') }}"></script>
    @endsection

    <div class="container-md container-sm-fluid mt-4">
        <h1 class="text-center">What can we help with?</h1>


        <form id="contact-form" action="{{ route('contact.send') }}" method="POST" class="card border shadow p-5">
            @csrf

            <x-errors></x-errors>

            <div class="form-group my-3">
                <label for="name">Name *</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group my-3">
                <label for="email">Email Address *</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" required>
                <small>This is needed so we can reply to you.</small>
            </div>
            <div class="form-group my-3">
                <label for="subject">Subject *</label>
                <input type="text" class="form-control" id="subject" name="subject" autocomplete="off" required>
            </div>
            <div class="form-group my-3">
                <label for="content">Message *</label>
                <textarea class="form-control" id="content" name="content" rows="3" autocomplete="off" required></textarea>
            </div>
            <button type="button" class="btn btn-primary mt-2 g-recaptcha" data-sitekey="{{ config('app.google_recaptcha') }}" data-callback='onSubmit' data-action='submit'>Send</button>
        </form>
    </div>

    @section('scripts')
    <script>
        function onSubmit(token) {
         document.getElementById("contact-form").submit();
       }
    </script>
    @endsection
</x-app>