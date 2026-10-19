<header class="sticky top-0 z-50 border-b border-[#e3dfd5] bg-[#faf9f5]/95 backdrop-blur-sm">
    <div class="mx-auto max-w-[1500px] px-5 sm:px-8">
        <div class="flex h-[90px] items-center justify-between">
            {{-- Logo --}}
            <a
                href="{{ route('home') }}"
                class="shrink-0 flex items-center absolute left-1/2 -translate-x-1/2 lg:static lg:translate-x-0"
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
                    href="{{ route('projectIndex') }}"
                    class="relative flex flex-col items-center py-3 text-sm transition
                    {{ request()->routeIs('projectIndex', 'projectInfo', 'projectTag')
                        ? 'text-[#b38c3f] after:absolute after:bottom-0 after:left-1/2 after:h-[2px] after:w-10 after:-translate-x-1/2 after:bg-[#c69b43]'
                        : 'text-[#17352a] hover:text-[#b38c3f]' }}"
                >
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.7">
                        <rect x="3" y="3" width="18" height="18" rx="3"/>
                        <circle cx="8.5" cy="8.5" r="1.5"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 15-5-5L5 21"/>
                    </svg>
                    <span>آثار</span>
                </a>
                <a
                    href="{{ route('memberIndex') }}"
                    class="relative flex flex-col items-center py-3 text-sm transition
                    {{ request()->routeIs('memberIndex', 'memberInfo')
                        ? 'text-[#b38c3f] after:absolute after:bottom-0 after:left-1/2 after:h-[2px] after:w-10 after:-translate-x-1/2 after:bg-[#c69b43]'
                        : 'text-[#17352a] hover:text-[#b38c3f]' }}"
                >
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.7">
                        <circle cx="9" cy="8" r="4"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2 21v-2a7 7 0 0 1 14 0v2M16 4.5a4 4 0 0 1 0 7.5M18 14a5 5 0 0 1 4 5v2"/>
                    </svg>
                    <span>هنرمندان</span>
                </a>
                <a
                    href="#about"
                    class="relative flex flex-col items-center py-3 text-sm transition hover:text-[#b38c3f]"
                >
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.7">
                        <circle cx="12" cy="12" r="9"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 11v5m0-8h.01"/>
                    </svg>
                    <span>گالری</span>
                </a>
                <a
                    href="#contact"
                    class="relative flex flex-col items-center py-3 text-sm transition hover:text-[#b38c3f]"
                >
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.7">
                        <circle cx="12" cy="12" r="9"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 11v5m0-8h.01"/>
                    </svg>
                    <span>درباره ما</span>
                </a>

            </nav>

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
                        class="hidden sm:flex flex-row items-center justify-center gap-2
                        rounded-full border border-[#c8a45b]
                        px-5 py-2.5 text-xs"
                    >
                        <svg
                            class="h-6 w-6 shrink-0"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <circle cx="12" cy="8" r="4"/>
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 21a8 8 0 0 1 16 0"
                            />
                        </svg>
                        <span class="whitespace-nowrap">ورود / ثبت‌نام</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
</header>
