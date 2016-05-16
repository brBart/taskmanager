@extends('layout')

@section('breadcrumbs_title')
@stop


@section('css')
    <style>

    </style>
@stop


@section('content')
    <h1> An email has been senT to {{ $email }}. </h1>
@stop	


@section('javascripts')
<script>
var mixin = {
    ready : function(){
    }
}
</script>

    


@stop																																																																																																																											