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
        @if($project->thumbnail)
            <img
                src="{{ asset('storage/' . $project->thumbnail) }}"
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
        <h3 class="text-lg font-semibold text-[#24352d]">
            {{ $project->name_fa }}

            @if($project->member)
                <span class="text-sm text-gold">
                    ({{ $project->member->name_fa }})
                </span>
            @endif

            <span class="text-sm">
                - {{ $project->year }}
            </span>
        </h3>

        <div class="mt-3 flex flex-wrap items-center gap-2 text-xs text-[#85827a]">

            @if($project->technique)
                <a
                    href="{{ route('projectTag', [
                        'tag' => 'technique',
                        'id' => $project->technique->id
                    ]) }}"
                    title="تکنیک {{ $project->technique->name_fa }}"
                >
                    {{ $project->technique->name_fa }}
                </a>
            @endif

            @if($project->style)
                <span class="text-[#c5bba9]">|</span>

                <a
                    href="{{ route('projectTag', [
                        'tag' => 'style',
                        'id' => $project->style->id
                    ]) }}"
                    title="سبک {{ $project->style->name_fa }}"
                >
                    {{ $project->style->name_fa }}
                </a>
            @endif

            @if($project->subject)
                <span class="text-[#c5bba9]">|</span>

                <a
                    href="{{ route('projectTag', [
                        'tag' => 'subject',
                        'id' => $project->subject->id
                    ]) }}"
                    title="موضوع {{ $project->subject->name_fa }}"
                >
                    {{ $project->subject->name_fa }}
                </a>
            @endif

        </div>
    </div>
</article>