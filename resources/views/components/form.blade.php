@extends('layouts.frontend')

@section('content')
    <div class="ui container page-component">
        <h2 class="ui header">
            SemanticForm
            <div class="sub header">Semantic-UI Form</div>
        </h2>

        {!! SemanticForm::open() !!}
        {!! SemanticForm::text('username') !!}
        {!! SemanticForm::submit('Submit') !!}
        {!! SemanticForm::close() !!}
    </div>
@endsection
