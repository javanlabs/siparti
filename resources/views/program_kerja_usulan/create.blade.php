@extends('layouts.frontend')

@section('content')
    <section class="ui container page" id="page-program-kerja-usulan-create">
        <div class="ui centered grid">
            <div class="ten wide column">
                <div class="ui segment very padded">
                    <h2 class="ui header text centered"><span>Usulkan</span> Program Kerja</h2>

                    <form action="{{ route('proker-usulan.store') }}" class="ui form large" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {!! SemanticForm::text('name', 'Nama Program Kerja') !!}
                        {!! SemanticForm::text('manfaat', 'Manfaat') !!}
                        {!! SemanticForm::text('lokasi', 'Lokasi Pelaksanaan') !!}
                        {!! SemanticForm::text('target', 'Target (jumlah/kuantitas), bukan uang') !!}
                        {!! SemanticForm::textarea('description', 'Penjelasan Program Kerja') !!}
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
