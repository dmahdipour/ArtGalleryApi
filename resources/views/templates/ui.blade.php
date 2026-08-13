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
</head>
<body dir="rtl" class="font-YekanBakh-Regular bg-slate-50">
    <!--Header-->
    <div class="min-h-screen bg-[#f7f5ef]">
        <header class="border-b border-[#e3dfd5] bg-[#faf9f5]">
            <div class="mx-auto max-w-[1500px] px-5 sm:px-8">
                <div class="flex h-[90px] items-center justify-between">
                    {{-- Logo --}}
                    <a
                        href="{{ route('home') }}"
                        class="shrink-0"
                    >
                        <div class="text-[32px] font-serif tracking-[0.08em] text-[#17352a]">
                            DMY
                        </div>
                        <div class="-mt-1 text-center text-[9px] tracking-[0.45em] text-[#756b59]">
                            GALLERY
                        </div>
                    </a>

                    {{-- Desktop Navigation --}}
                    <nav class="hidden items-center gap-10 lg:flex">

                        {{-- خانه --}}
                        <a
                            href="{{ route('home') }}"
                            class="relative py-3 text-sm transition
                            {{ request()->routeIs('home')
                                ? 'text-[#b38c3f] after:absolute after:bottom-0 after:left-1/2 after:h-[2px] after:w-10 after:-translate-x-1/2 after:bg-[#c69b43]'
                                : 'text-[#17352a] hover:text-[#b38c3f]' }}"
                        >
                            خانه
                        </a>

                        {{-- گالری آثار --}}
                        <a
                            href="{{ route('projectIndex') }}"
                            class="relative py-3 text-sm transition
                            {{ request()->routeIs('projectIndex', 'projectInfo', 'projectTag')
                                ? 'text-[#b38c3f] after:absolute after:bottom-0 after:left-1/2 after:h-[2px] after:w-10 after:-translate-x-1/2 after:bg-[#c69b43]'
                                : 'text-[#17352a] hover:text-[#b38c3f]' }}"
                        >
                            گالری آثار
                        </a>

                        {{-- هنرمندان --}}
                        <a
                            href="{{ route('memberIndex') }}"
                            class="relative py-3 text-sm transition
                            {{ request()->routeIs('memberIndex', 'memberInfo')
                                ? 'text-[#b38c3f] after:absolute after:bottom-0 after:left-1/2 after:h-[2px] after:w-10 after:-translate-x-1/2 after:bg-[#c69b43]'
                                : 'text-[#17352a] hover:text-[#b38c3f]' }}"
                        >
                            هنرمندان
                        </a>

                        {{-- درباره ما --}}
                        <a
                            href="#about"
                            class="relative py-3 text-sm transition hover:text-[#b38c3f]"
                        >
                            درباره ما
                        </a>

                        {{-- تماس با ما --}}
                        <a
                            href="#contact"
                            class="relative py-3 text-sm transition hover:text-[#b38c3f]"
                        >
                            تماس با ما
                        </a>

                    </nav>


                    {{-- Header Actions --}}
                    <div class="flex items-center gap-3">
                        {{-- Search --}}
                        <button
                            type="button"
                            class="hidden h-11 w-11 items-center justify-center rounded-full
                            border border-[#ded8cb] bg-white transition
                            hover:border-[#b99959] sm:flex"
                        >
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z"
                                />
                            </svg>
                        </button>


                        {{-- Login --}}
                        <a
                            href="#"
                            class="hidden rounded-full border border-[#c8a45b]
                            px-5 py-2.5 text-xs sm:block"
                        >
                            ورود / ثبت‌نام
                        </a>

                        {{-- Mobile menu --}}
                        <button
                            class="flex h-10 w-10 items-center justify-center
                            rounded-full border border-[#ded8cb] bg-white lg:hidden"
                        >
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-width="1.5"
                                    d="M4 7h16M4 12h16M4 17h16"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </header>
        @section('main-content')
            مطلبی برای نمایش وجود ندارد
        @show

    </div>

    <footer
        class="border-t border-[#e2ddd4]
        bg-[#17352a] text-white"
    >
        <div
            class="mx-auto flex max-w-[1500px]
            flex-col justify-between gap-5 px-5 py-8
            sm:flex-row sm:px-8"
        >
            <div>
                <div class="font-serif text-xl tracking-widest">
                    DMY
                </div>
                <div class="mt-1 text-[9px] tracking-[0.4em] text-[#c8a766]">
                    ART GALLERY
                </div>
            </div>
            <div class="text-xs text-white/50">
                © {{ date('Y') }} تمام حقوق مادی و معنوی وب سایت محفوظ است.
            </div>
        </div>

    </footer>

    @section('page-js')
    @show 
</body>
</html>