<section class="mx-auto max-w-[1500px] px-5 pt-5 sm:px-8">
    <div
        class="heroSwiper swiper relative min-h-[480px] overflow-hidden rounded-[20px] bg-[#e9e2d5]"
    >
        <div class="swiper-wrapper">
            @foreach($sliders as $slider)
                <div class="swiper-slide relative min-h-[480px]">
                    {{-- Image --}}
                    <img
                        src="{{ asset('storage/' . $slider->thumbnail) }}"
                        alt="{{ $slider->name }}"
                        class="absolute inset-0 h-full w-full object-cover"
                    >
                    {{-- Overlay --}}
                    <div
                        class="absolute inset-0"
                    ></div>
                    {{-- Content --}}
                    <div
                        class="relative z-10 flex min-h-[480px]
                        flex-col justify-center
                        px-8 py-16 sm:px-14 lg:px-20"
                    >
                        <div
                            class="text-4xl font-semibold leading-[1.7]
                            sm:text-5xl lg:text-6xl [-webkit-text-stroke:0.3px_#b58a3e]"
                        >
                            {!! $slider->description !!}
                        </div>
                        <div
                            class="mt-6 text-lg leading-8 sm:text-md [-webkit-text-stroke:0.1px_#b58a3e]"
                        >
                            {!! $slider->text !!}
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        {{-- Next --}}
        <button
            type="button"
            class="hero-next absolute right-5 top-1/2 z-30
            flex h-11 w-11 -translate-y-1/2
            items-center justify-center rounded-full
            border border-white/60 bg-white/70
            text-[#17352a] backdrop-blur-md
            transition hover:bg-white"
            aria-label="اسلاید بعدی"
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
                    d="M9 18l6-6-6-6"
                />
            </svg>
        </button>
        {{-- Previous --}}
        <button
            type="button"
            class="hero-prev absolute left-5 top-1/2 z-30
            flex h-11 w-11 -translate-y-1/2
            items-center justify-center rounded-full
            border border-white/60 bg-white/70
            text-[#17352a] backdrop-blur-md
            transition hover:bg-white"
            aria-label="اسلاید قبلی"
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
                    d="M15 18l-6-6 6-6"
                />
            </svg>
        </button>
        {{-- Pagination --}}
        <div
            class="hero-pagination swiper-pagination !bottom-6"
        ></div>
    </div>
</section>