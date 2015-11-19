@extends('admin.layouts.base')

@section('content')
    <div class="ui container">
        <h2>Create Uji Publik</h2>

        {!! SemanticForm::open()->action(route('uji-publik.store'))->post() !!}
        {!! SemanticForm::text('name', 'Nama') !!}
        {!! SemanticForm::submit('Simpan') !!}
        {!! SemanticForm::close() !!}


    </div>
@endsection
