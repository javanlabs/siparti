@extends('layouts.frontend')

@section('content')
    <section class="ui container page" id="page-program-kerja-usulan-create">
        <div class="ui centered grid">
            <div class="ten wide column">
                <div class="ui segment very padded">
                    <h2 class="ui header text centered"><span>Usulkan</span> Program Kerja</h2>

                    <form action="{{ route('proker-usulan.store') }}" class="ui form large" method="POST">
                        {{ csrf_field() }}
                        <div class="field">
                            <label>Nama Program Kerja</label>
                            <input type="text" name="name" value="">
                        </div>
                        <div class="field">
                            <label>Instansi Terkait</label>
                            <input type="text" name="instansi_stakeholder" value="">
                        </div>

                        <div class="field">
                            <label>Deskripsi</label>
                            <textarea name="description" id="" cols="30" rows="10"></textarea>
                        </div>

                        <button class="ui button primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
