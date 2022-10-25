@extends('voyager::master')

@section('page_title')
    {{ $title ?? setting('admin.title') . " - " . setting('admin.description') }}
@endsection

@section('head')
    {{-- @include('components.css') --}}
    @yield('head_html')
@endsection

@section('content')
    @yield('content_html')
@endsection

@section('javascript')
    {{-- @include('components.js') --}}
    @yield('footer_html')
@endsection