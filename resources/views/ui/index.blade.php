@extends('templates.ui')
@section('title', 'سمفونی رنگ (گالری تابلوهای ایران و جهان)')
@section('describe','siteDescribe')

@section('main-content')
@if ($message = Session::get('error'))
    <div class="text-center p-3 text-sm"> {{ $message }} </div>
@endif

{{-- ======================== Slider ========================= --}}
@include('ui.components.slider')

{{-- ======================= FILTERS ========================= --}}
@include('ui.components.filter')

{{-- ======================= GALLERY ========================= --}}
<main class="mx-auto max-w-[1500px] px-5 py-12 sm:px-8">
    <div class="mb-8 flex items-end justify-between">
        <div>
            <span
                class="text-[10px] tracking-[0.3em]
                text-[#ad873d]"
            >
            </span>
            <h2
                class="mt-2 text-2xl font-semibold
                text-[#17352a] sm:text-3xl"
            >
                مجموعه آثار
            </h2>
        </div>
        <div class="text-xs text-[#77746d]">
            {{ $allProjects }}
            اثر
        </div>
    </div>

    {{-- Cards --}}
    <div
        class="grid grid-cols-1 gap-6
        sm:grid-cols-2
        lg:grid-cols-3
        xl:grid-cols-4"
    >
        @forelse($projects as $project)
            @include('ui.components.project-info')
        @empty
            <div
                class="col-span-full rounded-2xl
                border border-dashed border-[#d7d0c2]
                py-24 text-center"
            >
                <p class="text-lg text-[#777]">
                    اثری برای نمایش پیدا نشد.
                </p>
                <a
                    href="{{ route('projectIndex') }}"
                    class="mt-5 inline-block text-sm
                    text-[#aa8139] hover:underline"
                >
                    نمایش همه آثار
                </a>
            </div>
        @endforelse
    </div>
    <!-- Pagination -->
    <div class="mt-12">
        {{ $projects->links() }}
    </div>
</main>

{{-- ===================== STATISTICS ========================= --}}
<section class="mx-auto max-w-[1500px] px-5 pb-12 sm:px-8">
    <div
        class="grid grid-cols-2 overflow-hidden rounded-2xl
        border border-[#e2ddd4] bg-white
        md:grid-cols-4"
    >
        <div
            class="flex items-center gap-4 border-b
            border-[#ebe7df] p-6 md:border-b-0
            md:border-l"
        >
            <div
                class="flex h-12 w-12 shrink-0 items-center
                justify-center rounded-full bg-[#f7f1e3]
                text-[#b58b3d]"
            >
                <svg
                    class="h-6 w-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-width="1.5"
                        d="M7 3v4M17 3v4M4 9h16M5 5h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z"
                    />
                </svg>
            </div>
            <div>
                <div class="text-xl font-semibold">
                    ۱۴۰۵
                </div>
                <div class="mt-1 text-xs text-[#888]">
                    سال تأسیس گالری
                </div>
            </div>
        </div>

        <div
            class="flex items-center gap-4 border-b
            border-[#ebe7df] p-6
            md:border-b-0 md:border-l"
        >
            <div
                class="flex h-12 w-12 shrink-0 items-center
                justify-center rounded-full bg-[#f7f1e3]
                text-[#b58b3d]"
            >
                <svg
                    class="h-6 w-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-width="1.5"
                        d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm7-1a4 4 0 1 0 0-8m4 19v-2a4 4 0 0 0-3-3.87"
                    />
                </svg>
            </div>
            <div>
                <div class="text-xl font-semibold">
                    {{ $allUsers}}
                </div>
                <div class="mt-1 text-xs text-[#888]">
                    هنرمند
                </div>
            </div>
        </div>


        <div
            class="flex items-center gap-4 border-l
            border-[#ebe7df] p-6"
        >
            <div
                class="flex h-12 w-12 shrink-0 items-center
                justify-center rounded-full bg-[#f7f1e3]
                text-[#b58b3d]"
            >
                <svg
                    class="h-6 w-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-width="1.5"
                        d="M4 5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5Zm4 3h8M8 12h8M8 16h5"
                    />
                </svg>
            </div>
            <div>
                <div class="text-xl font-semibold">
                    {{ $allProjects }}+
                </div>
                <div class="mt-1 text-xs text-[#888]">
                    اثر هنری
                </div>
            </div>
        </div>


        <div
            class="flex items-center gap-4 p-6"
        >
            <div
                class="flex h-12 w-12 shrink-0 items-center
                justify-center rounded-full bg-[#f7f1e3]
                text-[#b58b3d]"
            >
                <svg
                    class="h-6 w-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <circle
                        cx="12"
                        cy="12"
                        r="9"
                        stroke-width="1.5"
                    />
                    <path
                        stroke-linecap="round"
                        stroke-width="1.5"
                        d="M3 12h18M12 3c2.5 2.5 3.5 5.5 3.5 9s-1 6.5-3.5 9c-2.5-2.5-3.5-6.5-3.5-9S9.5 5.5 12 3Z"
                    />
                </svg>
            </div>
            <div>
                <div class="text-base font-semibold">
                    سراسر جهان
                </div>
                <div class="mt-1 text-xs text-[#888]">
                    ارسال آثار
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('page-js')
<script>
    
</script>
@endsection