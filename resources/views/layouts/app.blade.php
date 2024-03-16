<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seylon Aquatics</title>

     <!-- Styles -->
     @vite('resources/css/app.css')
    <!-- Scripts -->
    @vite('resources/js/app.js')

    <link rel="icon" type="image/png" href="{{ asset('images/logo-icon.png') }}" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorsigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="https://unpkg.com/flowbite@1.3.4/dist/flowbite.js"></script>
    <script type="module" src="./../../resources/js/alertDismiss.js"></script>

    @stack('styles')
</head>
<body class="bg-gray-300">
    <div class="flex flex-col md:flex-row min-h-screen">
        @include('partials.sidebar')

        <main class="flex-grow p-6">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>