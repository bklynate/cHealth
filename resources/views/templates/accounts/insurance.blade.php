@extends('templates.main.home')

@section('header')
	@include('templates.sub-sections.nav.header')
@stop

@section('main-header')
	@include('templates.accounts.insurance-header')
@stop

@section('aside')
	@include('templates.accounts.aside')
@stop

@section('body')
	@include('templates.accounts.insurance-body')
@stop

@section('footer')
	@include('templates.sub-sections.footer.footer')
@stop

@section('scripts')
	@include('templates.main.scripts')
@stop
