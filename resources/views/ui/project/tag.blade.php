@extends('templates.ui')
@section('title', 'تابلوهای کار شده در حوزه ی '.$tagValue)
@section('describe','siteDescribe')

@section('main-content')
@if ($message = Session::get('error'))
    <div class="text-center p-3 text-sm"> {{ $message }} </div>
@endif

{{-- ======================= GALLERY ========================= --}}
<main class="mx-auto max-w-[1500px] px-5 py-12 sm:px-8">
    <div class="mb-8 flex items-end justify-between">
        <div>
            <span
                class="text-[10px] tracking-[0.3em]
                text-[#ad873d]"
            >
                {{$tagName}}
            </span>
            <span
                class="mt-2 text-2xl font-semibold
                text-[#17352a] sm:text-3xl"
            >
                {{$tagValue}}
            </span>
        </div>
        <div class="text-xs text-[#77746d]">
            {{ $projects->count() }}
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
@endsection

@section('page-js')
<script>
</script>
@endsection