@if ($paginator->hasPages())
    <nav
        class="mt-12 flex items-center justify-center"
        aria-label="Pagination"
    >
        <div class="flex items-center gap-2">

            {{-- Previous Page --}}
            @if ($paginator->onFirstPage())

                <span
                    class="flex h-10 w-10 items-center justify-center
                    rounded-full border border-[#e3dfd5]
                    text-[#c9c4ba] cursor-not-allowed"
                >
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
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>
                </span>

            @else

                <a
                    href="{{ $paginator->previousPageUrl() }}"
                    rel="prev"
                    class="flex h-10 w-10 items-center justify-center
                    rounded-full border border-[#ded8cb]
                    bg-white text-[#17352a]
                    transition hover:border-[#b99959]
                    hover:text-[#b99959]"
                >
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
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>
                </a>

            @endif


            {{-- Pagination Elements --}}
            @foreach ($elements as $element)

                {{-- "Three Dots" Separator --}}
                @if (is_string($element))

                    <span
                        class="flex h-10 w-10 items-center justify-center
                        text-[#9b978f]"
                    >
                        {{ $element }}
                    </span>

                @endif


                {{-- Array Of Links --}}
                @if (is_array($element))

                    @foreach ($element as $page => $url)

                        @if ($page == $paginator->currentPage())

                            <span
                                aria-current="page"
                                class="flex h-10 min-w-10 items-center
                                justify-center rounded-full
                                bg-[#17352a] px-3
                                text-sm font-medium text-white"
                            >
                                {{ $page }}
                            </span>

                        @else

                            <a
                                href="{{ $url }}"
                                class="flex h-10 min-w-10 items-center
                                justify-center rounded-full
                                border border-[#ded8cb]
                                bg-white px-3
                                text-sm text-[#17352a]
                                transition
                                hover:border-[#b99959]
                                hover:text-[#b99959]"
                            >
                                {{ $page }}
                            </a>

                        @endif

                    @endforeach

                @endif

            @endforeach


            {{-- Next Page --}}
            @if ($paginator->hasMorePages())

                <a
                    href="{{ $paginator->nextPageUrl() }}"
                    rel="next"
                    class="flex h-10 w-10 items-center justify-center
                    rounded-full border border-[#ded8cb]
                    bg-white text-[#17352a]
                    transition hover:border-[#b99959]
                    hover:text-[#b99959]"
                >
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
                            d="M9 5l7 7-7 7"
                        />
                    </svg>
                </a>

            @else

                <span
                    class="flex h-10 w-10 items-center justify-center
                    rounded-full border border-[#e3dfd5]
                    text-[#c9c4ba] cursor-not-allowed"
                >
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
                            d="M9 5l7 7-7 7"
                        />
                    </svg>
                </span>

            @endif

        </div>
    </nav>
@endif