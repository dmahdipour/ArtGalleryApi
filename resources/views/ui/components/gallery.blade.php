<main class="mx-auto max-w-[1500px] px-5 py-12 sm:px-8">
    <div class="mb-8 flex items-end justify-between">
        <div class="flex gap-2">
            <span
                class="text-[13px] text-[#ad873d]"
            >
                @if(!empty($tagName))
                    {{ $tagName }}
                @endif
            </span>
            <h2
                class="text-2xl font-semibold
                text-[#17352a] sm:text-3xl"
            >
                @if(!empty($tagValue))
                    {{$tagValue}}
                @else
                     مجموعه آثار
                @endif 
            </h2>
        </div>
        <div class="text-xs text-[#77746d]">
            {{ $allProjects }}
            اثر
        </div>
    </div>

    {{-- Cards --}}
    <div
        id="projects-grid"
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
    <div id="load-more-trigger"></div>
</main>


@section('page-js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const grid = document.getElementById('projects-grid');
    const trigger = document.getElementById('load-more-trigger');
    let nextPageUrl = @json($projects->nextPageUrl());
    let loading = false;

    if (!nextPageUrl) {
        trigger.remove();
        return;
    }

    const observer = new IntersectionObserver(
        async (entries) => {
            if (!entries[0].isIntersecting) {
                return;
            }
            if (loading || !nextPageUrl) {
                return;
            }

            loading = true;

            try {
                const response = await fetch(nextPageUrl, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                });
                if (!response.ok) {
                    throw new Error(
                        `HTTP Error: ${response.status}`
                    );
                }
                const data = await response.json();
                if (data.html) {
                    grid.insertAdjacentHTML(
                        'beforeend',
                        data.html
                    );
                }
                nextPageUrl = data.next_page_url;
                if (!nextPageUrl) {
                    observer.disconnect();
                    trigger.remove();
                }
            } catch (error) {

                console.error(
                    'Infinite Scroll Error:',
                    error
                );
            } finally {
                loading = false;
            }
        },
        {
            root: null,
            rootMargin: '300px',
            threshold: 0
        }
    );
    observer.observe(trigger);
});
</script>
@endsection