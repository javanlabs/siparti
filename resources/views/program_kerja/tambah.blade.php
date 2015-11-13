@extends('layouts.frontend')

@section('content')
    <section class="ui container page">

        <div class="ui grid">
            <div class="column one wide">
            </div>

            <div class="column fourteen wide" >

            <h2 class="ui header"><span>Usulan</span> Program Kerja</h2>

            {!! Form::open([
                    
                    'class' => 'ui form',
                    'enctype' => 'multipart/form-data',
                    'route' => 'tambahProgramKerjaUsulan'

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

                 <div class="inline field input" style="color: white">

                    {!! Form::label('description', 'Unggah Dokumen') !!}

                    {!! Form::text('text', null, ['id' => 'uploadFile', 'placeholder' => 'Pilih file', 'disabled']) !!}

                    {!! Form::file('file', null, ['id' => 'file', 'class' => 'upload']) !!}
                    <button id="upload-button" type="button" class="ui primary button">Pilih Dokumen</button>
                    
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
