<header class="sticky top-0 z-50 border-b border-[#e3dfd5] bg-[#faf9f5]/95 backdrop-blur-sm">
    <div class="mx-auto max-w-[1500px] px-5 sm:px-8">
        <div class="flex h-[90px] items-center justify-between">
            {{-- Logo --}}
            <a
                href="{{ route('home') }}"
                class="shrink-0 flex items-center"
            >
                @php
                use App\Models\Setting;
                $site_logo = Setting::where('name', 'logo')->first()->file_path ?? '/images/logo.png';
                @endphp
                <img src="/storage/{{ $site_logo }}" class="w-16 h-16" />
                <span class="text-lg font-bold tracking-[0.08em] text-[#17352a] mr-1">
                    @php
                    $site_title = Setting::where('name', 'site-title')->first()->value ?? 'سمفونی رنگ';
                    echo $site_title;
                    @endphp
                </span>
            </a>

            {{-- Desktop Navigation --}}
            <nav class="hidden items-center gap-10 lg:flex">
                <a
                    href="{{ route('home') }}"
                    class="relative py-3 text-sm transition
                    {{ request()->routeIs('home')
                        ? 'text-[#b38c3f] after:absolute after:bottom-0 after:left-1/2 after:h-[2px] after:w-10 after:-translate-x-1/2 after:bg-[#c69b43]'
                        : 'text-[#17352a] hover:text-[#b38c3f]' }}"
                >
                    خانه
                </a>
                <a
                    href="{{ route('projectIndex') }}"
                    class="relative py-3 text-sm transition
                    {{ request()->routeIs('projectIndex', 'projectInfo', 'projectTag')
                        ? 'text-[#b38c3f] after:absolute after:bottom-0 after:left-1/2 after:h-[2px] after:w-10 after:-translate-x-1/2 after:bg-[#c69b43]'
                        : 'text-[#17352a] hover:text-[#b38c3f]' }}"
                >
                    گالری آثار
                </a>
                <a
                    href="{{ route('memberIndex') }}"
                    class="relative py-3 text-sm transition
                    {{ request()->routeIs('memberIndex', 'memberInfo')
                        ? 'text-[#b38c3f] after:absolute after:bottom-0 after:left-1/2 after:h-[2px] after:w-10 after:-translate-x-1/2 after:bg-[#c69b43]'
                        : 'text-[#17352a] hover:text-[#b38c3f]' }}"
                >
                    هنرمندان
                </a>
                <a
                    href="#about"
                    class="relative py-3 text-sm transition hover:text-[#b38c3f]"
                >
                    درباره ما
                </a>
                <a
                    href="#contact"
                    class="relative py-3 text-sm transition hover:text-[#b38c3f]"
                >
                    تماس با ما
                </a>

            </nav>

            {{-- Mobile Navigation --}}
            <div id="mobileMenu"
                class="hidden border-b border-[#e3dfd5] bg-[#faf9f5] w-full absolute top-0 right-0 z-999 lg:hidden">
                <nav class="mx-auto max-w-[1500px] px-5 py-5 sm:px-8">
                    <div class="flex flex-col gap-1">
                        @php
                            $user = auth()->guard('web')->user();
                        @endphp

                        @if($user)
                            <div>
                                <p>
                                    <a href="{{ route('home') }}/dmy" class="text-blue-700">{{ $user->name }}</a>
                                    خوش آمدید!
                                </p>
                            </div>
                        @else
                        <a
                            href="{{ route('home') }}/dmy"
                            class="rounded-lg px-4 py-3 text-sm text-[#17352a]
                                transition hover:bg-[#f0ede5]"
                        >
                            ورود / ثبت نام
                        </a>
                        @endif

                        <a
                            href="{{ route('home') }}"
                            class="rounded-lg px-4 py-3 text-sm text-[#17352a]
                                transition hover:bg-[#f0ede5]"
                        >
                            خانه
                        </a>
                        <a
                            href="{{ route('projectIndex') }}"
                            class="rounded-lg px-4 py-3 text-sm text-[#17352a]
                                transition hover:bg-[#f0ede5]"
                        >
                            گالری آثار
                        </a>
                        <a
                            href="{{ route('memberIndex') }}"
                            class="rounded-lg px-4 py-3 text-sm text-[#17352a]
                                transition hover:bg-[#f0ede5]"
                        >
                            هنرمندان
                        </a>
                        <a
                            href="#about"
                            class="rounded-lg px-4 py-3 text-sm text-[#17352a]
                                transition hover:bg-[#f0ede5]"
                        >
                            درباره ما
                        </a>
                        <a
                            href="#contact"
                            class="rounded-lg px-4 py-3 text-sm text-[#17352a]
                                transition hover:bg-[#f0ede5]"
                        >
                            تماس با ما
                        </a>
                    </div>
                </nav>
            </div>

            {{-- Header Actions --}}
            <div class="flex items-center gap-3">
                {{-- Search --}}
                <!-- <button
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
                </button> -->


                {{-- Login --}}
                @php
                    $user = auth()->guard('web')->user();
                @endphp

                @if($user)
                    <div class="hidden sm:block">
                        <p>
                            <a href="{{ route('home') }}/dmy" class="text-blue-700">{{ $user->name }}</a>
                            خوش آمدید!
                        </p>
                    </div>
                @else
                    <a
                        href="/dmy"
                        class="hidden rounded-full border border-[#c8a45b]
                        px-5 py-2.5 text-xs sm:block"
                    >
                        ورود / ثبت‌نام
                    </a>
                @endif
                {{-- Mobile menu --}}
                <button
                    id="mobileMenuButton"
                    type="button"
                    class="flex h-10 w-10 items-center justify-center z-9999
                    rounded-full border border-[#ded8cb] bg-white lg:hidden"
                    aria-controls="mobileMenu"
                    aria-expanded="false"
                >
                    <svg
                        id="mobileMenuIcon"
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M4 7h16M4 12h16M4 17h16"
                        />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>
