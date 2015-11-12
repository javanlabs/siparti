@extends('layouts.frontend')

@section('content')
    <section class="ui container page">

        <div class="ui grid">
            <div class="column one wide">
            </div>

            <div class="column fourteen wide" >

            @if(Session::has('flash_message'))
                <div class="ui positive message">
                    {{ Session::get('flash_message') }}
                </div>
            @endif

            

                {!! Form::open([
                    
                    'class' => 'ui form',
                    'enctype' => 'multipart/form-data'

                ]) !!}

                <div class="ui grid">
                    <div class="column eight wide">
                        {!! Form::label('namaProgram', 'Nama Program Kerja', ['class' => 'my-label']) !!} 
                    </div>

                    <div class="column eight wide">
                        {!! Form::text('namaProgram', null) !!}
                    </div>
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
                    
                    {!! Form::file('file', null, 
                        
                        [
                            'style' => "width: 0.1px;
                                        height: 0.1px;
                                        opacity: 0;
                                        overflow: hidden;
    position: absolute;
    z-index: -1;" 
                        ]

                    ) !!}
                    
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
