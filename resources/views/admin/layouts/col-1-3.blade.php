@extends('admin.layouts.base')

@section('content')
    <div class="ui container">
        <div class="ui grid">
            <div class="column four wide">
                @yield('content-left')
            </div>
            <div class="column twelve wide">
                @yield('content-right')
            </div>
        </div>
    </div>
@endsection
