@extends('layouts.frontend')

@section('content')
    <section class="ui container page">

        <div class="ui grid">
            <div class="column one wide">
            </div>

            <div class="column ten wide" >

            @if(Session::has('flash_message'))
                <div class="ui positive message">
                    {{ Session::get('flash_message') }}
                </div>
            @endif

            

                {!! Form::open([
                    
                    'class' => 'ui form',
                    'enctype' => 'multipart/form-data'

                ]) !!}

                <div class="field">
                    {!! Form::label('namaProgram', 'Nama Program Kerja', ['class' => 'my-label']) !!}
                    {!! Form::text('namaProgram', null) !!}
                </div>

                <div class="field">
                    {!! Form::label('instansiTerkait', 'Instansi Terkait') !!}
                    {!! Form::text('instansiTerkait', null) !!}
                </div>

                 <div class="field">
                    {!! Form::label('description', 'Description:') !!}
                    {!! Form::textarea('description', null) !!}
                </div>

                 <div class="field ui primary button" style="color: white">
                    
                    {!! Form::file('file', null) !!}
                    
                </div>

                <div class="field" >
                        {!! Form::submit('Simpan', ['class' => 'ui primary button']) !!}
                        {!! Form::reset('Batal', ['class' => 'ui primary red button']) !!}
                </div>    
            

                {!! Form::close() !!}

            </div>
            <div class="column one wide">
            </div>
        </div>

    </section>
@endsection
