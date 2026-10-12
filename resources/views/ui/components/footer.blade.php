
{{-- Mobile Bottom Navigation --}}
@php
    $user = auth()->guard('web')->user();
@endphp

<nav
    dir="rtl"
    aria-label="ناوبری موبایل"
    class="fixed inset-x-0 bottom-0 z-50 border-t border-[#e3dfd5]
           bg-[#faf9f5]/95 text-[#17352a] backdrop-blur-md
           pb-[env(safe-area-inset-bottom)] lg:hidden"
>
    <div class="mx-auto grid max-w-lg grid-cols-5">
        <a href="{{ route('home') }}"
           class="flex flex-col items-center gap-1 py-2.5
           {{ request()->routeIs('home') ? 'text-[#b38c3f]' : '' }}">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.7">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1V10Z"/>
            </svg>
            <span class="text-[10px]">خانه</span>
        </a>

        <a href="{{ route('projectIndex') }}"
           class="flex flex-col items-center gap-1 py-2.5
           {{ request()->routeIs('projectIndex', 'projectInfo', 'projectTag') ? 'text-[#b38c3f]' : '' }}">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.7">
                <rect x="3" y="3" width="18" height="18" rx="3"/>
                <circle cx="8.5" cy="8.5" r="1.5"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="m21 15-5-5L5 21"/>
            </svg>
            <span class="text-[10px]">آثار</span>
        </a>

        <a href="{{ route('memberIndex') }}"
           class="flex flex-col items-center gap-1 py-2.5
           {{ request()->routeIs('memberIndex', 'memberInfo') ? 'text-[#b38c3f]' : '' }}">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.7">
                <circle cx="9" cy="8" r="4"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2 21v-2a7 7 0 0 1 14 0v2M16 4.5a4 4 0 0 1 0 7.5M18 14a5 5 0 0 1 4 5v2"/>
            </svg>
            <span class="text-[10px]">هنرمندان</span>
        </a>

        <a href="{{ route('home') }}#about"
           class="flex flex-col items-center gap-1 py-2.5">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.7">
                <circle cx="12" cy="12" r="9"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 11v5m0-8h.01"/>
            </svg>
            <span class="text-[10px]">درباره ما</span>
        </a>

        <a href="/dmy"
           class="flex flex-col items-center gap-1 py-2.5">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.7">
                <circle cx="12" cy="8" r="4"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M4 21a8 8 0 0 1 16 0"/>
            </svg>
            <span class="text-[10px]">{{ $user ? 'حساب من' : 'ورود' }}</span>
        </a>
    </div>
</nav>


<footer
    class="border-t border-[#e2ddd4]
    bg-[#17352a] text-white"
>
    <div
        class="mx-auto flex max-w-[1500px]
        flex-col justify-between gap-5 px-5 py-2
        sm:flex-row sm:px-8"
    >
        <a
            href="{{ route('home') }}"
            class="shrink-0 flex items-center"
        >
            @php
            use App\Models\Setting;
            $site_logo = Setting::where('name', 'logo')->first()->file_path ?? '/images/logo.png';
            @endphp
            <img src="/storage/{{ $site_logo }}" class="w-12 h-12" />
            <span class="text-lg font-bold tracking-[0.08em] mr-1">
                @php
                $site_title = Setting::where('name', 'site-title')->first()->value ?? 'سمفونی رنگ';
                echo $site_title;
                @endphp
            </span>
        </a>
        <div class="text-xs text-white/50 flex items-center">
            © {{ date('Y') }} تمام حقوق مادی و معنوی وب سایت محفوظ است.
        </div>
    </div>

</footer>