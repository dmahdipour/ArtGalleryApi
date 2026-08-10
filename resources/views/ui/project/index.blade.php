@extends('templates.ui')
@section('title', 'پروژه ی')
@section('describe','siteDescribe')

@section('main-content')
@if ($message = Session::get('error'))
    <div class="text-center p-3 text-sm"> {{ $message }} </div>
@endif
{{-- ========================================================= --}}
{{-- HERO --}}
{{-- ========================================================= --}}
<section class="mx-auto max-w-[1500px] px-5 pt-5 sm:px-8">
    <div
        class="relative min-h-[480px] overflow-hidden rounded-[20px]
        bg-[#e9e2d5]"
    >
        {{-- Background Image --}}
        <img
            src="{{ asset('images/gallery-hero.jpg') }}"
            alt="DMY Art Gallery"
            class="absolute inset-0 h-full w-full object-cover"
        >
        {{-- Overlay --}}
        <div
            class="absolute inset-0
            bg-gradient-to-l
            from-[#e7dfd1]/20
            via-[#eee8dd]/60
            to-[#f3eee5]"
        ></div>
        {{-- Hero Content --}}
        <div
            class="relative z-10 flex min-h-[480px]
            max-w-[650px] flex-col justify-center
            px-8 py-16 sm:px-14 lg:px-20"
        >
            <span
                class="mb-6 text-xs tracking-[0.3em] text-[#aa8339]"
            >
                DMY ART GALLERY
            </span>
            <h1
                class="text-4xl font-semibold leading-[1.7]
                text-[#17352a] sm:text-5xl lg:text-6xl"
            >
                هنر،
                <br>
                روایت نگاه است
            </h1>
            <p
                class="mt-6 max-w-[480px]
                text-sm leading-8 text-[#595b56] sm:text-base"
            >

                مجموعه‌ای از آثار هنری معاصر و کلاسیک،
                جایی برای کشف رنگ، فرم و احساس.
            </p>
            <div class="mt-8">
                <a
                    href="#gallery"
                    class="inline-flex items-center gap-3
                    rounded-xl bg-[#c49a4b]
                    px-7 py-3.5 text-sm text-white
                    shadow-lg shadow-[#c49a4b]/20
                    transition hover:-translate-y-0.5
                    hover:bg-[#b58a3e]"
                >
                    مشاهده آثار
                    <svg
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M5 12h14m-6-6 6 6-6 6"
                        />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>


{{-- ========================================================= --}}
{{-- FILTERS --}}
{{-- ========================================================= --}}
<section
    id="gallery"
    class="sticky top-0 z-30 mt-5 border-y
    border-[#e1ddd4] bg-[#f7f5ef]/95 backdrop-blur-md"
>
    <div class="mx-auto max-w-[1500px] px-5 sm:px-8">
        <form
            method="GET"
            action="{{ route('projectIndex') }}"
            class="flex gap-3 overflow-x-auto py-4"
        >
            {{-- All --}}
            <a
                href="{{ route('projectIndex') }}"
                class="flex shrink-0 items-center gap-2
                rounded-xl border px-6 py-3 text-xs
                transition

                {{ !request()->hasAny(['technique','style','subject'])
                    ? 'border-[#d1b16d] bg-white text-[#9b7535]'
                    : 'border-[#e2ddd3] bg-white hover:border-[#c6a15a]' }}"
            >
                همه آثار
                <svg
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-width="1.5"
                        d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h6v6h-6z"
                    />
                </svg>
            </a>

            {{-- Technique --}}
            <div class="relative shrink-0">
                <select
                    name="technique"
                    onchange="this.form.submit()"
                    class="appearance-none rounded-xl border
                    border-[#e2ddd3] bg-white
                    py-3 pr-5 pl-12 text-xs
                    outline-none transition
                    hover:border-[#c6a15a]"
                >
                    <option value="">
                        تکنیک
                    </option>
                    @foreach($techniques as $technique)
                        <option
                            value="{{ $technique->id }}"
                            @selected(request('technique') == $technique->id)
                        >
                            {{ $technique->name }}
                        </option>
                    @endforeach
                </select>
                <svg
                    class="pointer-events-none absolute left-4 top-1/2
                    h-4 w-4 -translate-y-1/2 text-[#8f897c]"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="m6 9 6 6 6-6"
                    />
                </svg>

            </div>
            {{-- Style --}}
            <div class="relative shrink-0">
                <select
                    name="style"
                    onchange="this.form.submit()"
                    class="appearance-none rounded-xl border
                    border-[#e2ddd3] bg-white
                    py-3 pr-5 pl-12 text-xs
                    outline-none transition
                    hover:border-[#c6a15a]"
                >
                    <option value="">
                        سبک
                    </option>
                    @foreach($styles as $style)
                        <option
                            value="{{ $style->id }}"
                            @selected(request('style') == $style->id)
                        >
                            {{ $style->name }}
                        </option>
                    @endforeach
                </select>
                <svg
                    class="pointer-events-none absolute left-4 top-1/2
                    h-4 w-4 -translate-y-1/2 text-[#8f897c]"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="m6 9 6 6 6-6"
                    />
                </svg>
            </div>
            {{-- Subject --}}
            <div class="relative shrink-0">
                <select
                    name="subject"
                    onchange="this.form.submit()"
                    class="appearance-none rounded-xl border
                    border-[#e2ddd3] bg-white
                    py-3 pr-5 pl-12 text-xs
                    outline-none transition
                    hover:border-[#c6a15a]"
                >
                    <option value="">
                        موضوع
                    </option>
                    @foreach($subjects as $subject)
                        <option
                            value="{{ $subject->id }}"
                            @selected(request('subject') == $subject->id)
                        >
                            {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
                <svg
                    class="pointer-events-none absolute left-4 top-1/2
                    h-4 w-4 -translate-y-1/2 text-[#8f897c]"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="m6 9 6 6 6-6"
                    />
                </svg>
            </div>
            {{-- Sort --}}
            <div class="relative mr-auto shrink-0">
                <select
                    name="sort"
                    onchange="this.form.submit()"
                    class="appearance-none rounded-xl border
                    border-[#e2ddd3] bg-white
                    py-3 pr-5 pl-12 text-xs
                    outline-none"
                >
                    <option value="latest">
                        جدیدترین
                    </option>
                    <option
                        value="oldest"
                        @selected(request('sort') === 'oldest')
                    >
                        قدیمی‌ترین
                    </option>
                </select>
                <svg
                    class="pointer-events-none absolute left-4 top-1/2
                    h-4 w-4 -translate-y-1/2 text-[#8f897c]"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-width="1.5"
                        d="M8 7h8M8 12h8M8 17h5"
                    />
                </svg>
            </div>
        </form>
    </div>
</section>


{{-- ========================================================= --}}
{{-- GALLERY --}}
{{-- ========================================================= --}}
<main class="mx-auto max-w-[1500px] px-5 py-12 sm:px-8">
    <div class="mb-8 flex items-end justify-between">
        <div>
            <span
                class="text-[10px] tracking-[0.3em]
                text-[#ad873d]"
            >
                COLLECTION
            </span>
            <h2
                class="mt-2 text-2xl font-semibold
                text-[#17352a] sm:text-3xl"
            >
                مجموعه آثار
            </h2>
        </div>
        <div class="text-xs text-[#77746d]">
            {{ $projects->total() }}
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
            <article
                class="group overflow-hidden rounded-2xl
                border border-[#e7e1d6] bg-white
                shadow-sm transition duration-500
                hover:-translate-y-1 hover:shadow-xl"
            >
                {{-- Image --}}
                <a
                    href="{{ route('projectInfo', $project->uuid) }}"
                    class="relative block overflow-hidden"
                >
                    @if($project->image)
                        <img
                            src="{{ asset('storage/' . $project->image) }}"
                            alt="{{ $project->name_fa }}"
                            loading="lazy"
                            class="aspect-[4/5] w-full
                            object-cover transition duration-700
                            group-hover:scale-105"
                        >
                    @else
                        <div
                            class="flex aspect-[4/5] items-center
                            justify-center bg-[#e9e5dc]"
                        >
                            <span class="text-sm text-[#999]">
                                بدون تصویر
                            </span>
                        </div>
                    @endif

                    {{-- Favorite --}}
                    <button
                        type="button"
                        onclick="event.preventDefault()"
                        class="absolute right-4 top-4 flex h-10 w-10
                        items-center justify-center rounded-full
                        border border-white/50 bg-black/20
                        text-white backdrop-blur-sm
                        transition hover:bg-white hover:text-[#9d7838]"
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
                                d="M20.84 8.61a5.5 5.5 0 0 0-7.78 0L12 9.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 0 0 0-7.78Z"
                            />
                        </svg>
                    </button>
                    {{-- Hover --}}
                    <div
                        class="absolute inset-x-0 bottom-0
                        translate-y-full bg-gradient-to-t
                        from-black/70 to-transparent p-5 pt-16
                        text-white transition duration-500
                        group-hover:translate-y-0"
                    >
                        <span class="text-xs text-[#e1c37e]">
                            مشاهده اثر
                        </span>
                    </div>
                </a>

                {{-- Card Info --}}
                <div class="p-5">
                    <h3
                        class="text-lg font-semibold
                        text-[#24352d]"
                    >
                        {{ $project->name_fa }}
                    </h3>
                    <div
                        class="mt-3 flex flex-wrap items-center
                        gap-2 text-xs text-[#85827a]"
                    >
                        @if($project->technique)
                            <span>
                                {{ $project->technique->name }}
                            </span>
                        @endif
                        @if($project->style)
                            <span class="text-[#c5bba9]">
                                |
                            </span>
                            <span>
                                {{ $project->style->name }}
                            </span>
                        @endif
                        @if($project->subject)
                            <span class="text-[#c5bba9]">
                                |
                            </span>
                            <span>
                                {{ $project->subject->name }}
                            </span>
                        @endif
                    </div>
                </div>
            </article>
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

    {{-- Pagination --}}
    @if($projects->hasPages())
        <div class="mt-12">
            {{ $projects->onEachSide(1)->links() }}
        </div>
    @endif
</main>

{{-- ========================================================= --}}
{{-- STATISTICS --}}
{{-- ========================================================= --}}
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
                    {{ \App\Models\Member::count() }}
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
                    {{ $projects->total() }}+
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