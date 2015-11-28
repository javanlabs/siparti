@extends('layouts.frontend')

@section('content')
    <section class="ui container page" id="page-program-kerja-usulan-create">
        <div class="ui centered grid">
            <div class="ten wide column">
                <div class="ui segment very padded">
                    <h2 class="ui header text centered"><span>Usulkan</span> Program Kerja</h2>

                    <form action="{{ route('proker-usulan.store') }}" class="ui form large" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        {!! SemanticForm::text('name', 'Nama Program Kerja')->defaultValue($name) !!}
                        {!! SemanticForm::textarea('description', 'Penjelasan Program Kerja', ['class' => 'textRedactor'])->defaultValue($description) !!}
                        {!! SemanticForm::text('scope', 'Manfaat') !!}
                        {!! SemanticForm::text('lokasi', 'Lokasi Pelaksanaan') !!}
                        {!! SemanticForm::text('target', 'Target (jumlah/kuantitas), bukan uang') !!}
                        <div class="field">
                            <label for="">Dokumen Terkait</label>
                            <input type="file" name="file[]"><br>
                            <input type="file" name="file[]"><br>
                            <input type="file" name="file[]"><br>
                            <input type="file" name="file[]"><br>
                            <input type="file" name="file[]">
                        </div>
                        {!! SemanticForm::submit('Simpan') !!}
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
