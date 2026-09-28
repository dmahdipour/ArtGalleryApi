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