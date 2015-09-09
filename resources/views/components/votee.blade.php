@extends('layouts.frontend')

@section('content')
    <h2 class="ui header title">
        <div class="ui container">
            Votee
            <div class="sub header">Like/dislike support for any content</div>
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
                    <div class="extra content">
                        {!! Votee::render($model) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
