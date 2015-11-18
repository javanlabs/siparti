@extends('admin.layouts.base')

@section('content')
    <div class="ui container">
        <h2>Edit Uji Publik</h2>

        {!! SemanticForm::open()->action(route('uji-publik.update', $item->present('id')))->put() !!}
        {!! SemanticForm::bind($item) !!}
        {!! SemanticForm::text('name', 'Nama') !!}
        {!! SemanticForm::submit('Simpan') !!}
        {!! SemanticForm::close() !!}
        
    </div>
@endsection
