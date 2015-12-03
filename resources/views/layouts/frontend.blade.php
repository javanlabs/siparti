@extends('layouts.base')

@section('body')

    @include('elements.header')
    @include('elements.flash')

    <div id="layout-frontend" style="margin-bottom: 40px">
        @yield('content')
    </div>

    @include('elements.footer')
    @include('votee::script')
    @include('mural::script')
@endsection
