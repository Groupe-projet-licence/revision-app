<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'EasyLearning') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}" />

    <!-- Scripts -->
    @routes
    @viteReactRefresh
    @vite(['resources/js/app.jsx', "resources/js/Pages/{$page['component']}.jsx"])
    @inertiaHead
</head>
<body>
    <div id="preloader">
        <div class="d-flex justify-content-center align-items-center position-relative"
            style="background: #0d6efd; height: 100vh;">

            <span class="position-absolute">
                <img style="border-radius: 100%; width:12em; height:12em" src="/images/icon_app2.png"
                    alt="Application Logo" />
            </span>
            <div class='spinner-border  text-primary position-absolute' role='status'></div>
        </div>
    </div>

    @inertia

    <script>
        // Retirer le loader une fois que Inertia et React sont prêts
        document.addEventListener('DOMContentLoaded', () => {
            const preloader = document.getElementById('preloader');
            if (preloader) {
                preloader.style.display = 'none';
            }
        });
    </script>
</body>


</html>