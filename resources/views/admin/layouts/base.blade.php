@extends('layouts.base')

@section('style-head')
    @parent
    @include('admin.layouts.style')
@endsection

@section('script-end')
    @parent
    @include('admin.layouts.script')
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
