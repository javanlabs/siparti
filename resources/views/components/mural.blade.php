@extends('layouts.frontend')

@section('content')
    <h2 class="ui header title">
        <div class="ui container">
            Mural
            <div class="sub header">Comment stream</div>
        </div>
    </h2>

    <div class="ui container page-component">
        <div class="ui grid">
            <div class="column eight wide">
                {!! Mural::render($model, 'default') !!}
            </div>
        </div>

    </div>
@endsection
