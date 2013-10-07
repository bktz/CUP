@extends('site.layouts.default')

{{-- Content --}}
@section('content')
    @if ($disabled == "disabled")
        <h2>You must create an account to use this feature.</h3>
    @else
	    <h1>Projects</h1>            
    @endif
@stop
