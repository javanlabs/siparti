@extends('admin.layouts.base')
@section('content')
    <div class="ui container">
        <h2>Dasbor</h2>

        @include('admin.dashboard.summary')
        @include('admin.dashboard.popular')
        @include('admin.dashboard.chart_content')
        @include('admin.dashboard.chart_interaction')
    </div>
@endsection
