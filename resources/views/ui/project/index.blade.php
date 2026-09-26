@extends('templates.ui')
@section('title', 'سمفونی رنگ (گالری تابلوهای ایران و جهان)')
@section('describe','siteDescribe')

@section('main-content')
@if ($message = Session::get('error'))
    <div class="text-center p-3 text-sm"> {{ $message }} </div>
@endif

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
                @if(request('member') && $projects->isNotEmpty() && $projects[0]->member !== null)
                <span class="text-sm text-gold">{{$projects[0]->member->name_fa}}</span>
                @endif
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