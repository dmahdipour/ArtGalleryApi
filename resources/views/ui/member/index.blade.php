@extends('templates.ui')
@section('title', 'هنرمندان گالری')
@section('describe','siteDescribe')

@section('main-content')
@if ($message = Session::get('error'))
    <div class="text-center p-3 text-sm"> {{ $message }} </div>
@endif
{{-- ======================= users ========================= --}}
<main class="mx-auto max-w-[1500px] px-5 py-12 sm:px-8">
    <div class="mb-8 flex items-end justify-between">
        <div>
            <span
                class="text-[10px] tracking-[0.3em]
                text-[#ad873d]"
            >
                ARTISTS
            </span>
            <h2
                class="mt-2 text-2xl font-semibold
                text-[#17352a] sm:text-3xl"
            >
                هنرمندان
            </h2>
        </div>
        <div class="text-xs text-[#77746d]">
            {{ $users->count() }}
            هنرمند
        </div>
    </div>

    {{-- Cards --}}
    <div
        class="grid grid-cols-1 gap-6
        sm:grid-cols-2
        lg:grid-cols-3
        xl:grid-cols-4"
    >
        @forelse($users as $user)
            <article
                class="group overflow-hidden rounded-2xl
                border border-[#e7e1d6] bg-white
                shadow-sm transition duration-500
                hover:-translate-y-1 hover:shadow-xl"
            >
                {{-- Image --}}
                <a
                    href="{{ route('projectIndex',  ['user' => $user->uuid]) }}"
                    class="relative block overflow-hidden"
                >
                    @if($user->avatar)
                        <img
                            src="{{ asset('storage/' . $user->avatar) }}"
                            alt="{{ $user->name_fa }}"
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
                        class="absolute inset-x-0 bottom-25
                        translate-y-full bg-gradient-to-t
                        from-black/70 to-transparent p-5 pt-16
                        text-white transition duration-500
                        group-hover:translate-y-0"
                    >
                        <span class="text-xs text-[#e1c37e]">
                            مشاهده اثار
                        </span>
                    </div>

                    {{-- Card Info --}}
                    <div class="p-5">
                        <h3 class="text-gold ">
                            {{ $user->member->name_fa }}
                        </h3>
                        <h4 class="text-gold text-left">
                            {{ $user->member->name_en }}
                        </h4>
                        <hr class="border-gold" />
                        <h5
                            class="text-sm text-gray-500"
                        >
                            {{ $user->member->activities }}
                        </h5>
                    </div>
                </a>
            </article>
        @empty
            <div
                class="col-span-full rounded-2xl
                border border-dashed border-[#d7d0c2]
                py-24 text-center"
            >
                <p class="text-lg text-[#777]">
                    هنرمندی برای نمایش پیدا نشد.
                </p>
                <a
                    href="{{ route('home') }}"
                    class="mt-5 inline-block text-sm
                    text-[#aa8139] hover:underline"
                >
                    رفتن به صفحه اول
                </a>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($users->hasPages())
        <div class="mt-12">
            {{ $users->onEachSide(1)->links() }}
        </div>
    @endif
</main>
@endsection

@section('page-js')
<script>
</script>
@endsection