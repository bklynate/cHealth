@extends('templates.main.home')

@section('header')
	@include('templates.sub-sections.nav.header')
@stop

@section('header-appointments')
	@include('templates.pharmacy.header-inventory')
@stop

@section('main-header-appointments')
	@include('templates.pharmacy.main-header-inventory')
@stop


@section('aside')
	@include('templates.pharmacy.aside')
@stop

@section('doctor-appointments-body')
	@include('templates.pharmacy.inventory-body')
@stop

@section('footer')
	@include('templates.sub-sections.footer.footer')
@stop

@section('scripts')
	@include('templates.main.scripts')
@stop
