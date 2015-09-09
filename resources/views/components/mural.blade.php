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

                {!! Mural::render($model, 'default') !!}
            </div>
            <div class="column eight wide">
                <div class="ui segment">
                    <h3 class="ui header">Comment Retrieval</h3>
                    <div class="ui feed">
                        @foreach($comments as $comment)
                        <div class="event">
                            <div class="content">
                                <div class="summary">
                                    <a href="{{ $comment->author->commentator_permalink }}">{{ $comment->author->commentator_name }}</a> mengomentari
                                    <a href="{{ $comment->commentable->commentable_permalink }}">{{ $comment->commentable->commentable_title }}</a>
                                </div>
                                <div class="text">
                                    {{ $comment->body }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
