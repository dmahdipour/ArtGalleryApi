@extends('templates.ui')
@section('title', $title)

@section('main-content')

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