@extends('layouts.base')

@section('script-head')
    @parent
    <script src="{{ asset('js/admin.js') }}"></script>
@endsection

@section('body')
    @include('admin.elements.sidebar')

    <div class="pusher">
        @include('admin.elements.header')
        @include('elements.flash')

        <div id="layout-admin">
            <div class="ui divider hidden"></div>
            @yield('content')
        </div>

        @include('admin.elements.footer')

    </div>

@endsection
