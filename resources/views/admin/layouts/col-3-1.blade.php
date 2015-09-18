@extends('admin.layouts.base')

@section('content')
    <div class="ui container">

        @yield('content-top')

        <div class="ui grid">
            <div class="column twelve wide">
                @yield('content-left')
            </div>
            <div class="column four wide">
                @yield('content-right')
            </div>
        </div>
    </div>
@endsection
