@extends('templates.ui')
@section('title', 'سمفونی رنگ (تابلوها)')
@section('describe','siteDescribe')

@section('main-content')

{{-- ======================= FILTERS ========================= --}}
@include('ui.components.filter')

{{-- ======================= GALLERY ========================= --}}
@include('ui.components.gallery')

@endsection

@section('page-js')
<script>
</script>
@endsection