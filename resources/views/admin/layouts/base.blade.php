@extends('layouts.base')

@section('script-head')

@endsection

@section('body')
    @include('admin.elements.sidebar')

    <div class="pusher">
        @include('admin.elements.header')
        @include('elements.flash')

        <div id="layout-admin" class="content">
            <div class="ui divider hidden"></div>
            @yield('content')
        </div>

        @include('admin.elements.footer')

    </div>

@endsection
