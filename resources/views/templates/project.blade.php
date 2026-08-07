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