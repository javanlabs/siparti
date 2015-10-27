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

                <div class="ui fluid card">
                    <div class="content">
                        <div class="header">{{ $model->title }}</div>
                        <div class="meta">{{ $model->created_at }}</div>
                        <div class="description">
                            <p>{{ $model->content }}</p>
                        </div>
                    </div>
                </div>
                <div class="ui message info">Default Room</div>
                {!! Mural::render($model, 'default') !!}
            </div>
            <div class="column eight wide">
                <div class="ui fluid card">
                    <div class="content">
                        <div class="header">{{ $model->title }}</div>
                        <div class="meta">{{ $model->created_at }}</div>
                        <div class="description">
                            <p>{{ $model->content }}</p>
                        </div>
                    </div>
                </div>
                <div class="ui message info">Custom Room</div>
                {!! Mural::render($model, 'custom-room') !!}

            </div>
        </div>

    </div>
@endsection
