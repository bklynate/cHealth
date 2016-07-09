@extends('templates.main.home')

@section('header')
	@include('templates.sub-sections.nav.header')
@stop

@section('main-header')
	@include('templates.doctor.main-header')
@stop

@section('aside')
	@include('templates.doctor.aside')
@stop

@section('doctor-blocks')
	@include('templates.doctor.blocks')
@stop

@section('doctor-medical-stats')
	@include('templates.doctor.medical-stats')
@stop

@section('footer')
	@include('templates.sub-sections.footer.footer')
@stop

@section('scripts')
	@include('templates.main.scripts')
@stop


