
@if(($stories ?? collect())->isNotEmpty())
    @php
        $storyGroups = $stories->map(function ($memberStories) {
            $member = $memberStories->first()->member;
            $memberName = $member?->name_fa ?: $member?->name_en ?: 'هنرمند';

            return [
                'name' => $memberName,
                'avatar' => $member?->user?->avatar
                    ? \Illuminate\Support\Facades\Storage::disk('public')->url($member->user->avatar)
                    : null,
                'items' => $memberStories->map(fn ($story) => [
                    'src' => \Illuminate\Support\Facades\Storage::disk('public')->url($story->media_path),
                    'type' => $story->media_type,
                    'caption' => $story->caption,
                    'created_at' => $story->created_at?->format('Y/m/d H:i'),
                ])->values()->all(),
            ];
        })->values();
    @endphp

    <section
        class="stories-section mx-auto w-full max-w-7xl px-4 py-5"
        dir="rtl"
        aria-label="استوری هنرمندان"
    >
        <div class="mb-3 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-[#17352a]">
                    لحظه‌هایی از هنر
                </h2>
                <p class="mt-0.5 text-xs text-[#8d7650]">
                    تازه‌ترین روایت‌های هنرمندان
                </p>
            </div>
        </div>

        <div class="stories-strip flex gap-4 overflow-x-auto pb-3" role="list">
            @foreach($storyGroups as $groupIndex => $group)
                @php
                    $member = $stories->values()->get($groupIndex)?->first()?->member;
                    $memberName = $group['name'];
                    $avatar = $member?->user?->avatar;
                @endphp

                <button
                    type="button"
                    class="story-person group flex w-[76px] shrink-0 flex-col items-center gap-2 text-center"
                    role="listitem"
                    data-group-index="{{ $groupIndex }}"
                    aria-label="مشاهده استوری‌های {{ $memberName }}"
                >
                    <span class="story-ring flex h-[70px] w-[70px] items-center justify-center rounded-full p-[3px]">
                        <span class="flex h-full w-full items-center justify-center overflow-hidden rounded-full border-2 border-[#f7f5ef] bg-[#17352a] text-xl font-bold text-white">
                            @if($avatar)
                                <img
                                    src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($avatar) }}"
                                    alt="{{ $memberName }}"
                                    class="h-full w-full object-cover"
                                >
                            @else
                                {{ mb_substr($memberName, 0, 1) }}
                            @endif
                        </span>
                    </span>

                    <span class="w-full truncate text-xs text-[#17352a]">
                        {{ $memberName }}
                    </span>
                </button>
            @endforeach
        </div>
    </section>

    <script type="application/json" id="story-groups-data">@json($storyGroups)</script>

    <div
        id="story-viewer"
        class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/95"
        aria-hidden="true"
    >
        <div class="story-viewer-shell relative flex h-full w-full max-w-[520px] flex-col overflow-hidden bg-black sm:h-[min(92vh,900px)] sm:rounded-2xl">

            <div class="absolute left-0 right-0 top-0 z-20 p-3">
                <div id="story-progress" class="mb-3 flex gap-1"></div>

                <div class="flex items-center justify-between text-white">
                    <div class="flex min-w-0 items-center gap-2">
                        <div
                            id="story-viewer-avatar"
                            class="flex h-9 w-9 shrink-0 items-center justify-center overflow-hidden rounded-full bg-[#8d7650] font-bold"
                        ></div>

                        <div class="min-w-0">
                            <div id="story-viewer-name" class="truncate text-sm font-bold"></div>
                            <div id="story-viewer-date" class="text-[10px] text-white/70"></div>
                        </div>
                    </div>

                    <button
                        type="button"
                        id="story-close"
                        class="rounded-full bg-black/30 p-2 text-2xl leading-none"
                        aria-label="بستن"
                    >×</button>
                </div>
            </div>

            <div
                id="story-media-container"
                class="flex min-h-0 flex-1 items-center justify-center"
            >
                <img
                    id="story-image"
                    class="hidden max-h-full max-w-full object-contain"
                    alt="استوری"
                    draggable="false"
                >

                <video
                    id="story-video"
                    class="hidden max-h-full max-w-full"
                    playsinline
                    preload="auto"
                ></video>
            </div>

            <div
                id="story-caption"
                class="absolute bottom-5 left-4 right-4 z-20 text-center text-sm text-white drop-shadow"
            ></div>

            <button
                type="button"
                id="story-prev"
                class="absolute bottom-0 right-0 top-16 z-10 w-1/3"
                aria-label="استوری قبلی"
            ></button>

            <button
                type="button"
                id="story-next"
                class="absolute bottom-0 left-0 top-16 z-10 w-1/3"
                aria-label="استوری بعدی"
            ></button>
        </div>
    </div>

    <style>
        .stories-strip {
            scrollbar-width: thin;
            scrollbar-color: #cbb982 transparent;
        }

        .stories-strip::-webkit-scrollbar {
            height: 4px;
        }

        .stories-strip::-webkit-scrollbar-thumb {
            background: #cbb982;
            border-radius: 10px;
        }

        .story-ring {
            background: conic-gradient(
                #cbb982,
                #8d7650,
                #17352a,
                #cbb982
            );
        }

        .story-person:focus-visible {
            outline: 2px solid #8d7650;
            outline-offset: 4px;
            border-radius: 12px;
        }

        #story-progress > span {
            height: 3px;
            flex: 1;
            overflow: hidden;
            border-radius: 10px;
            background: rgb(255 255 255 / .35);
        }

        #story-progress > span > i {
            display: block;
            width: 0;
            height: 100%;
            background: white;
        }

        #story-viewer,
        #story-viewer * {
            -webkit-tap-highlight-color: transparent;
        }

        #story-media-container {
            touch-action: pan-y;
            user-select: none;
        }

        #story-image {
            pointer-events: none;
        }

        @media (min-width: 640px) {
            .story-viewer-shell {
                box-shadow: 0 20px 80px #0008;
            }
        }
    </style>

    <script>
    (() => {
        const viewer = document.getElementById('story-viewer');

        if (!viewer || viewer.dataset.initialized) {
            return;
        }

        viewer.dataset.initialized = '1';

        const groupsData = document.getElementById('story-groups-data');
        const image = document.getElementById('story-image');
        const video = document.getElementById('story-video');
        const progress = document.getElementById('story-progress');

        const nameEl = document.getElementById('story-viewer-name');
        const avatarEl = document.getElementById('story-viewer-avatar');
        const dateEl = document.getElementById('story-viewer-date');
        const captionEl = document.getElementById('story-caption');

        const closeButton = document.getElementById('story-close');
        const nextButton = document.getElementById('story-next');
        const prevButton = document.getElementById('story-prev');

        let groups = [];

        let groupIndex = 0;
        let storyIndex = 0;

        let raf = null;
        let timerStartedAt = 0;
        let elapsed = 0;

        let paused = false;
        let imageDuration = 5000;
        let activeFill = null;

        let pointerIsDown = false;

        const IMAGE_DURATION = 5000;

        try {
            groups = JSON.parse(groupsData?.textContent || '[]');
        } catch (error) {
            console.error('Unable to read story data', error);
        }

        const currentItem = () => {
            return groups[groupIndex]?.items?.[storyIndex] ?? null;
        };

        const isViewerOpen = () => {
            return !viewer.classList.contains('hidden');
        };

        const cancelProgressFrame = () => {
            if (raf !== null) {
                cancelAnimationFrame(raf);
            }

            raf = null;
        };

        const clearPlayback = () => {
            cancelProgressFrame();

            video.pause();
            video.onended = null;
            video.onloadedmetadata = null;
            video.onplay = null;

            video.removeAttribute('src');
            video.load();

            elapsed = 0;
            timerStartedAt = 0;
            paused = false;
            pointerIsDown = false;
        };

        const close = () => {
            clearPlayback();

            viewer.classList.add('hidden');
            viewer.classList.remove('flex');

            viewer.setAttribute('aria-hidden', 'true');

            document.body.style.overflow = '';
        };

        const buildProgress = () => {
            progress.innerHTML = '';

            const items = groups[groupIndex]?.items ?? [];

            items.forEach((item, index) => {
                const bar = document.createElement('span');
                const fill = document.createElement('i');

                if (index < storyIndex) {
                    fill.style.width = '100%';
                }

                bar.appendChild(fill);
                progress.appendChild(bar);
            });

            activeFill = progress.children[storyIndex]?.firstElementChild ?? null;
        };

        /*
         * رفتن به استوری بعدی:
         * ابتدا استوری بعدی همین هنرمند؛
         * سپس اولین استوری هنرمند بعدی؛
         * و در نهایت بستن نمایشگر.
         */
        const advance = () => {
            if (!isViewerOpen()) {
                return;
            }

            const currentGroup = groups[groupIndex];

            if (!currentGroup) {
                close();
                return;
            }

            if (storyIndex < currentGroup.items.length - 1) {
                storyIndex++;
                render();
                return;
            }

            if (groupIndex < groups.length - 1) {
                groupIndex++;
                storyIndex = 0;
                render();
                return;
            }

            close();
        };

        const goBack = () => {
            if (!isViewerOpen()) {
                return;
            }

            if (storyIndex > 0) {
                storyIndex--;
                render();
                return;
            }

            if (groupIndex > 0) {
                groupIndex--;
                storyIndex = groups[groupIndex].items.length - 1;
                render();
            }
        };

        /*
         * زمان‌بندی عکس
         */
        const animateImageProgress = () => {
            cancelProgressFrame();

            timerStartedAt = performance.now();

            const tick = (now) => {
                if (paused || !isViewerOpen()) {
                    return;
                }

                elapsed += now - timerStartedAt;
                timerStartedAt = now;

                const ratio = Math.min(elapsed / imageDuration, 1);

                if (activeFill) {
                    activeFill.style.width = `${ratio * 100}%`;
                }

                if (ratio >= 1) {
                    advance();
                    return;
                }

                raf = requestAnimationFrame(tick);
            };

            raf = requestAnimationFrame(tick);
        };

        /*
         * به‌روزرسانی نوار پیشرفت ویدئو
         */
        const animateVideoProgress = () => {
            cancelProgressFrame();

            const tick = () => {
                if (
                    paused ||
                    !isViewerOpen() ||
                    video.paused ||
                    video.ended
                ) {
                    return;
                }

                const duration =
                    Number.isFinite(video.duration) && video.duration > 0
                        ? video.duration
                        : 10;

                const ratio = Math.min(video.currentTime / duration, 1);

                if (activeFill) {
                    activeFill.style.width = `${ratio * 100}%`;
                }

                raf = requestAnimationFrame(tick);
            };

            raf = requestAnimationFrame(tick);
        };

        /*
         * نمایش استوری فعلی
         */
        const render = () => {
            clearPlayback();

            const group = groups[groupIndex];
            const item = currentItem();

            if (!group || !item) {
                close();
                return;
            }

            nameEl.textContent = group.name || 'هنرمند';
            dateEl.textContent = item.created_at || '';
            captionEl.textContent = item.caption || '';

            avatarEl.innerHTML = '';

            if (group.avatar) {
                const avatar = document.createElement('img');

                avatar.src = group.avatar;
                avatar.alt = group.name || 'هنرمند';
                avatar.className = 'h-full w-full object-cover';

                avatarEl.appendChild(avatar);
            } else {
                avatarEl.textContent =
                    (group.name || 'هنر').trim().charAt(0) || 'هنر';
            }

            buildProgress();

            if (item.type === 'video') {
                image.classList.add('hidden');

                video.classList.remove('hidden');
                video.src = item.src;
                video.currentTime = 0;

                video.onended = () => {
                    advance();
                };

                video.onplay = () => {
                    if (!paused) {
                        animateVideoProgress();
                    }
                };

                video.play().catch((error) => {
                    console.warn('Video playback failed:', error);
                });

            } else {
                video.classList.add('hidden');

                image.classList.remove('hidden');
                image.src = item.src;

                imageDuration = IMAGE_DURATION;

                animateImageProgress();
            }
        };

        /*
         * توقف هنگام نگه‌داشتن انگشت یا ماوس
         */
        const pausePlayback = () => {
            if (!isViewerOpen() || paused) {
                return;
            }

            paused = true;

            cancelProgressFrame();

            if (currentItem()?.type === 'video') {
                video.pause();
                return;
            }

            if (timerStartedAt) {
                elapsed += performance.now() - timerStartedAt;
            }

            timerStartedAt = 0;

            if (activeFill) {
                const ratio = Math.min(elapsed / imageDuration, 1);
                activeFill.style.width = `${ratio * 100}%`;
            }
        };

        /*
         * ادامه پخش پس از برداشتن انگشت
         */
        const resumePlayback = () => {
            if (!isViewerOpen() || !paused) {
                return;
            }

            paused = false;

            if (currentItem()?.type === 'video') {
                video.play().catch((error) => {
                    console.warn('Video resume failed:', error);
                });

                return;
            }

            timerStartedAt = performance.now();

            const tick = (now) => {
                if (paused || !isViewerOpen()) {
                    return;
                }

                elapsed += now - timerStartedAt;
                timerStartedAt = now;

                const ratio = Math.min(elapsed / imageDuration, 1);

                if (activeFill) {
                    activeFill.style.width = `${ratio * 100}%`;
                }

                if (ratio >= 1) {
                    advance();
                    return;
                }

                raf = requestAnimationFrame(tick);
            };

            raf = requestAnimationFrame(tick);
        };

        /*
         * انتخاب هنرمند از نوار استوری
         */
        document.querySelectorAll('.story-person').forEach((button) => {
            button.addEventListener('click', () => {
                const selectedIndex = Number(button.dataset.groupIndex);

                if (
                    !Number.isInteger(selectedIndex) ||
                    !groups[selectedIndex]?.items?.length
                ) {
                    return;
                }

                groupIndex = selectedIndex;
                storyIndex = 0;

                viewer.classList.remove('hidden');
                viewer.classList.add('flex');

                viewer.setAttribute('aria-hidden', 'false');

                document.body.style.overflow = 'hidden';

                render();
            });
        });

        /*
         * دکمه‌های کنترل
         */
        closeButton.addEventListener('click', close);

        nextButton.addEventListener('click', advance);

        prevButton.addEventListener('click', goBack);

        /*
         * توقف فقط وقتی روی محتوای نمایشگر نگه داشته شود.
         * لمس دکمه‌های قبلی، بعدی و بستن باعث توقف نمی‌شود.
         */
        const shell = viewer.querySelector('.story-viewer-shell');

        shell.addEventListener('pointerdown', (event) => {
            if (
                event.target.closest('#story-close') ||
                event.target.closest('#story-next') ||
                event.target.closest('#story-prev')
            ) {
                return;
            }

            pointerIsDown = true;
            pausePlayback();
        });

        const releasePointer = () => {
            if (!pointerIsDown) {
                return;
            }

            pointerIsDown = false;
            resumePlayback();
        };

        window.addEventListener('pointerup', releasePointer);
        window.addEventListener('pointercancel', releasePointer);

        window.addEventListener('blur', releasePointer);

        /*
         * جلوگیری از منوی پیش‌فرض لمس طولانی روی عکس
         */
        viewer.addEventListener('contextmenu', (event) => {
            event.preventDefault();
        });

        /*
         * کلیک بیرون نمایشگر برای بستن
         */
        viewer.addEventListener('click', (event) => {
            if (event.target === viewer) {
                close();
            }
        });

        /*
         * کنترل با صفحه‌کلید
         */
        document.addEventListener('keydown', (event) => {
            if (!isViewerOpen()) {
                return;
            }

            if (event.key === 'Escape') {
                close();
            }

            if (event.key === 'ArrowLeft') {
                advance();
            }

            if (event.key === 'ArrowRight') {
                goBack();
            }

            if (event.code === 'Space') {
                event.preventDefault();

                if (paused) {
                    resumePlayback();
                } else {
                    pausePlayback();
                }
            }
        });

    })();
    </script>
@endif