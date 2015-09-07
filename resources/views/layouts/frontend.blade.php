@extends('layouts.base')

@section('body')
    @include('elements.header')
    @include('elements.flash')

    <div id="layout-frontend">
        @yield('content')
    </div>

    @include('elements.footer')
@endsection
