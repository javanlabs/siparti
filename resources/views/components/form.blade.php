@extends('layouts.frontend')

@section('content')
    <div class="ui container page-component">
        <h2 class="ui header">
            SemanticForm
            <div class="sub header">Semantic-UI Form</div>
        </h2>

        {!! SemanticForm::open() !!}
        {!! SemanticForm::text('text') !!}
        {!! SemanticForm::password('password') !!}
        {!! SemanticForm::checkboxGroup('name[]', ['satu' => 'Satu', 'dua' => 'Dua'], 'Checkbox') !!}
        {!! SemanticForm::textarea('textarea') !!}
        {!! SemanticForm::submit('Submit') !!}
        {!! SemanticForm::close() !!}
    </div>
@endsection
