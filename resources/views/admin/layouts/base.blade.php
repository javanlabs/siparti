@extends('layouts.base')

@section('body')
    @include('admin.elements.header')
    @include('elements.flash')

    <div id="layout-admin">
        <div class="ui divider hidden"></div>
        @yield('content')
    </div>

    @include('admin.elements.footer')
@endsection
