@extends('admin.layouts.base')
@section('style-head')
    @include('admin.layouts.style')
@endsection

@section('script-head')
        @include('admin.layouts.script')
@endsection
@section('content')

    <section class="ui container page" id="page-program-kerja-usulan-create">
        <div class="ui centered grid">
            <div class="ten wide column">
                <div class="ui segment very padded">
                    <h2 class="ui header text centered"><span>Uji Publik</span> Baru</h2>

                    <form action="{{ route('admin.ujiPublik.store') }}" class="ui form large" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="field">
                            <label>Nama UJi Publik</label>
                            <input name="name" value="{{ Input::old('name') ? Input::old('name') : "" }}" />
                        </div>

                        <div class="field">
                            <label>Materi</label>
                            <textarea name="materi">{{ Input::old('materi') ? Input::old('materi') : "" }}</textarea>
                        </div>

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