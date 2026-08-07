@extends('templates.ui')
@section('title', 'پروژه ی')
@section('describe','siteDescribe')

@section('main-content')
@if ($message = Session::get('error'))
    <div class="text-center p-3 text-sm"> {{ $message }} </div>
@endif
@endsection

@section('page-js')
<script>
    
</script>
@endsection