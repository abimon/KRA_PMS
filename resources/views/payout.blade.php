@extends('layouts.app')
@section('content')
<div class="container card p-2" >
    <iframe src="{{$redirect_url}}" frameborder="0" style="min-height:100vh;"></iframe>
</div>
@endsection