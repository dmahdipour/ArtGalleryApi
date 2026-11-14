@extends('templates.ui')
@section('title', $title)

@section('main-content')

{{-- ======================== Stories ========================= --}}
@include('ui.components.stories.index', ['stories' => $stories ?? collect()])

{{-- ======================== Slider ========================= --}}
@include('ui.components.slider')

{{-- ======================= FILTERS ========================= --}}
@include('ui.components.filter')

{{-- ======================= GALLERY ========================= --}}
@include('ui.components.gallery')

{{-- ===================== STATISTICS ========================= --}}
@include('ui.components.statistic')

@endsection

@section('page-js')
<script>
</script>
@endsection
