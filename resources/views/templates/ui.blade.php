<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title')</title>
<!-- <link rel="stylesheet" href="{{url('fonts/font.css')}}">
    <link rel="stylesheet" href="{{url('css/style.css')}}">   -->
</head>
<body dir="rtl" class="font-YekanBakh-Regular bg-slate-50">
    <!--Header-->
    <div class="w-full">
        <div class="container flex flex-row mx-auto ">
            <div class="basis-9/12 p-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 text-gray-700 float-right ml-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m6.115 5.19.319 1.913A6 6 0 0 0 8.11 10.36L9.75 12l-.387.775c-.217.433-.132.956.21 1.298l1.348 1.348c.21.21.329.497.329.795v1.089c0 .426.24.815.622 1.006l.153.076c.433.217.956.132 1.298-.21l.723-.723a8.7 8.7 0 0 0 2.288-4.042 1.087 1.087 0 0 0-.358-1.099l-1.33-1.108c-.251-.21-.582-.299-.905-.245l-1.17.195a1.125 1.125 0 0 1-.98-.314l-.295-.295a1.125 1.125 0 0 1 0-1.591l.13-.132a1.125 1.125 0 0 1 1.3-.21l.603.302a.809.809 0 0 0 1.086-1.086L14.25 7.5l1.256-.837a4.5 4.5 0 0 0 1.528-1.732l.146-.292M6.115 5.19A9 9 0 1 0 17.18 4.64M6.115 5.19A8.965 8.965 0 0 1 12 3c1.929 0 3.716.607 5.18 1.64" />
                </svg>
                <h1 class="mt-1 text-gray-500 font-bold max-sm:text-sm">گالری هنری</h1>
            </div>
            <div class="basis-4/12 pt-3 text-indigo-600 hover:text-red-400">
                <a href="/dmy" class="ml-4">ورود کاربران</a>
            </div>
            <div class="basis-9/12 p-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6  text-gray-700 float-left ">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                </svg>
                <h2 class="float-left ml-4 text-gray-500" dir="ltr">+98 914 900 1840</h2>
            </div>
        </div>
    </div>

    @section('main-content')
        مطلبی برای نمایش وجود ندارد
    @show

    <!--Section 5-->
    <div class="w-full bg-gray-700 h-5">
        <div class="container mx-auto">
            <h6 class="text-center text-white text-sm">تمام حقوق مادی و معنوی وب سایت محفوظ است.</h6>
        </div>
    </div>

    @section('page-js')
    @show 
</body>
</html>