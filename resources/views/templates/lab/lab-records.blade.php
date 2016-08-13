@extends('templates.main.home')

@section('header')
	@include('templates.sub-sections.nav.header')
@stop

@section('main-header')
	@include('templates.lab.lab-records-header')
@stop

@section('aside')
	@include('templates.lab.aside')
@stop

@section('body')
	@include('templates.lab.lab-records-body')
@stop

@section('footer')
	@include('templates.sub-sections.footer.footer')
@stop

@section('scripts')
	@include('templates.main.scripts')
@stop
