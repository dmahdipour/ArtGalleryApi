<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{url('fonts/font.css')}}">
    <link rel="stylesheet" href="{{url('css/style.css')}}">  
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#17352a">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link rel="apple-touch-icon" href="{{ asset('images/icon-192.png') }}">
</head>
<body dir="rtl" class="bg-[#f7f6f1] pb-16 lg:pb-0">
    @section('main-content')
        مطلبی برای نمایش وجود ندارد
    @show

    {{-- ======================= FOOTER ========================= --}}
    @include('ui.components.footer')


    @section('page-js')
    @show 

    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .catch((error) => {
                        console.error(
                            'Service Worker registration failed:',
                            error
                        );
                    });
            });
        }
    </script>
</body>
</html>