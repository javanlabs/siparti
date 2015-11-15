@extends('layouts.frontend')

@section('content')
    <section class="ui container page" id="page-program-kerja-usulan-create">
        <div class="ui centered grid">
            <div class="ten wide column">
                <div class="ui segment very padded">
                    <h2 class="ui header text centered"><span>Uji Publik</span> Baru</h2>

                    <form action="{{ route('uji-publik.store') }}" class="ui form large" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {!! SemanticForm::text('name', 'Nama') !!}
                        {!! SemanticForm::textarea('materi', 'Materi') !!}
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
