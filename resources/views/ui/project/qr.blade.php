@extends('templates.project')
@section('title', $item->name_fa)

@section('main-content')
<div dir="rtl" class="container min-h-screen mx-auto pt-10">
    <div class="flex flex-col md:flex-row items-center justify-center gap-6 md:gap-8">
        <div class="flex flex-col items-center justify-between md:gap-20">
            <span class="text-5xl md:text-7xl font-nastaliq font-bold text-blue-700 whitespace-nowrap">
                {{ $item->member->name_fa }}
            </span>
            <span class="text-lg md:text-xl text-gold text-center">
                {{ $item->name_fa }} **** {{ $item->name_en }}
            </span>
        </div>
        <div class="shrink-0">
            {!! QrCode::size(300)->generate(url()->current()) !!}
        </div>
    </div>
</div>
@endsection

@section('page-js')
<script>
    
</script>
@endsection