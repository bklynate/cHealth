@extends('templates.main.home')

@section('header')
	@include('templates.sub-sections.nav.header')
@stop

@section('main-header')
	@include('templates.reception.appointments-header')
@stop

@section('aside')
	@include('templates.reception.aside')
@stop

@section('body')
	@include('templates.reception.appointments-body')
@stop

@section('footer')
	@include('templates.sub-sections.footer.footer')
@stop

@section('scripts')
	@include('templates.main.scripts')

@stop

