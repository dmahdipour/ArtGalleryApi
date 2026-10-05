@extends('templates.ui')
@section('title', 'تابلوهای کار شده در حوزه ی '.$title)

@section('main-content')

{{-- ======================= GALLERY ========================= --}}
@include('ui.components.gallery')

@endsection

@section('page-js')
<script>
</script>
@endsection