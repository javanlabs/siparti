@extends('layouts.frontend')

@section('content')
    <section class="ui container page">
        <h2 class="ui header text centered"><span>Arsip</span> Program Kerja</h2>

        @include('program_kerja.table', ['route' => 'proker.arsip'])

    </section>
@endsection
