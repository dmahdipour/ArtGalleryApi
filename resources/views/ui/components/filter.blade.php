<section
    id="gallery"
    class="sticky top-[90px] z-40 mt-5 border-y
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