@extends('layouts.frontend')

@section('content')
    <section class="welcome">
        <div class="ui container center aligned">
            <div class="headline">
                <h2 class="title">Selamat Datang di <span class="highlight">{{ settings('app.name') }}</span></h2>

                <h3 class="body">Layanan partisipasi publik dalam membangun program kerja <br> Kominfo yang berkualitas.
                </h3>
            </div>
            <a href="{{ (auth()->check())?route('proker-usulan.create'): url('auth/login') }}" class="ui button large green">Ikut Berpartisipasi
                <i class="icon sign in right"></i></a>
        </div>
    </section>

    <section class="program-category ui container center aligned">
        <div class="ui equal width grid stackable">
            <div class="row">
                <a class="column" href="{{ route('proker.arsip') }}">
                    <i class="bordered inverted red archive icon massive"></i>

                    <h3 class="ui header">
                        Arsip Program Kerja
                        <div class="sub header">Daftar semua program kerja yang pernah dibuat.</div>
                    </h3>
                </a>
                <a class="column" href="{{ route('proker.berjalan') }}">
                    <i class="bordered inverted blue tasks icon massive"></i>

                    <h3 class="ui header">
                        Program Kerja
                        <div class="sub header">Daftar program kerja yang sedang berjalan.</div>
                    </h3>
                </a>
                <a class="column" href="{{ route('proker-usulan.index') }}">
                    <i class="bordered inverted yellow idea icon massive"></i>

                    <h3 class="ui header">
                        Usulan Program Kerja
                        <div class="sub header">Usulan program kerja dari masyarakat.</div>
                    </h3>
                </a>
            </div>
        </div>
    </section>

    <section class="program-list ui container page">
        <div class="ui segment padded">
            <div class="ui equal width grid stackable">
                <div class="column">
                    <h3 class="ui header">Program Kerja <span>Terbaru</span></h3>

                    @foreach($terbaru as $item)
                        @include('program_kerja.card')
                    @endforeach
                    <a href="{{ route('proker.berjalan') }}" class="ui button fluid basic">Lihat Program Terbaru Lainnya</a>
                </div>
                <div class="column">
                    <h3 class="ui header">Program Kerja <span>Terpopuler</span></h3>
                    @foreach($terpopuler as $item)
                        @include('program_kerja.card')
                    @endforeach
                    <a href="{{ route('proker.berjalan', ['orderBy' => 'vote_up', 'sortedBy' => 'desc']) }}" class="ui button fluid basic">Lihat Program Populer Lainnya</a>
                </div>
            </div>
        </div>
    </section>
@endsection
