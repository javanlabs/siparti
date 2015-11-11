@extends('layouts.frontend')

@section('content')
    <section class="ui container page">

        <div class="ui grid">
            <div class="column ten wide">
                <h2 class="">{!! $programKerja->present('name') !!}</h2>

                <table class="ui definition table small">
                    <tbody>
                    <tr><td>Status</td><td>{{ $programKerja->present('status') }}</td></tr>
                    <tr><td>Periode Fase</td><td>{{ $programKerja->present('periode') }}</td></tr>
                    <tr><td>Instansi Terkait</td><td>{{ $programKerja->present('instansi_terkait') }}</td></tr>
                    <tr><td>Deskripsi</td><td>{{ $programKerja->present('description') }}</td></tr>
                    </tbody>
                </table>

                {!! Votee::render($programKerja, ['class' => 'fluid']) !!}
                {!! Mural::render($programKerja, 'default') !!}

            </div>
            <div class="column six wide">

            </div>
        </div>

    </section>
@endsection
