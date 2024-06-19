@extends('adminlte::page')

@section('title', 'Portfolio Forge - Manager')

@section('content_header')
    <h1>Portfolio Forge</h1>
@stop

@section('content')
    {{ $slot }}
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
@stop