@extends('templates.ui')
@section('title', 'گالری تابلوهای ایران و جهان')
@section('describe','siteDescribe')

@section('main-content')
@if ($message = Session::get('error'))
    <div class="text-center p-3 text-sm"> {{ $message }} </div>
@endif

{{-- ======================= FILTERS ========================= --}}
<section
    id="gallery"
    class="sticky top-0 z-30 mt-5 border-y
    border-[#e1ddd4] bg-[#f7f5ef]/95 backdrop-blur-md">
    <div class="mx-auto max-w-[1500px] px-5 sm:px-8">
        <form
            method="GET"
            action="{{ route('projectIndex') }}"
            class="flex gap-3 overflow-x-auto py-4"
        >
            @if(request()->filled('member'))
                <input
                    type="hidden"
                    name="member"
                    value="{{ request('member') }}"
                >
            @endif
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
                            {{ $technique->name_fa }}
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
                            {{ $style->name_fa }}
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
                            {{ $subject->name_fa }}
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

{{-- ======================= GALLERY ========================= --}}
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
                            <a href="{{ route('projectTag', ['tag' => 'technique', 'id' => $project->technique->id]) }}" title="تکنیک {{ $project->technique->name_fa }}">
                                {{ $project->technique->name_fa }}
                            </a>
                        @endif
                        @if($project->style)
                            <span class="text-[#c5bba9]">
                                |
                            </span>
                            <a href="{{ route('projectTag', ['tag' => 'style', 'id' => $project->style->id]) }}" title="سبک {{ $project->style->name_fa }}">
                                {{ $project->style->name_fa }}
                            </a>
                        @endif
                        @if($project->subject)
                            <span class="text-[#c5bba9]">
                                |
                            </span>
                            <a href="{{ route('projectTag', ['tag' => 'subject', 'id' => $project->subject->id]) }}" title="موضوع {{ $project->subject->name_fa }}">
                                {{ $project->subject->name_fa }}
                            </a>
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
@endsection

@section('page-js')
<script>
</script>
@endsection