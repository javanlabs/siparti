@extends('layouts.frontend')

@section('content')
    <section class="welcome">
        <div class="ui container center aligned">
            <div class="headline">
                <h2 class="title">Selamat Datang di <span class="highlight">{{ settings('app.name') }}</span></h2>

                <h3 class="body">Layanan partisipasi publik dalam membangun program kerja <br> Kominfo yang berkualitas.
                </h3>
            </div>
            <a href="" class="ui button large green">Ikut Berpartisipasi <i class="icon sign in right"></i></a>
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
                <a class="column" href="{{ route('proker.usulan') }}">
                    <i class="bordered inverted yellow idea icon massive"></i>

                    <h3 class="ui header">
                        Usulan Program Kerja
                        <div class="sub header">Usulan program kerja dari masyarakat.</div>
                    </h3>
                </a>
            </div>
        </div>
    </section>

    <section class="program-list ui container">
        <div class="ui equal width grid stackable">
            <div class="column">
                <div class="ui blue inverted segment center aligned"><h4>Program Kerja Terbaru</h4></div>

                @foreach($terbaru as $item)
                    <div class="ui card fluid">
                        <div class="content">

                            <a class="header">{{ $item->present('name') }}</a>
                            <div class="meta">
                                <span class="date">{{ $item->present('periode') }}</span>
                            </div>

                            <div class="description">
                                {{ $item->present('excerpt') }}
                            </div>
                        </div>
                        <div class="content">
                            <i class="thumbs up icon"></i>
                            {{ $item->present('dukungan') }} dukungan
                            &nbsp;
                            &nbsp;
                            <i class="comment icon"></i>
                            {{ $item->present('komentar') }} komentar

                            <span class="right floated">
                                {!! $item->present('label') !!}
                            </span>

                        </div>
                    </div>
                @endforeach
                <a href="{{ route('proker.berjalan') }}" class="ui button fluid basic">Lihat Program Terbaru Lainnya</a>
            </div>
            <div class="column">
                <div class="ui blue inverted segment center aligned"><h4>Program Kerja Terpopuler</h4></div>
                @foreach($terbaru as $item)
                    <div class="ui card fluid">
                        <div class="content">

                            <a class="header">{{ $item->present('name') }}</a>
                            <div class="meta">
                                <span class="date">{{ $item->present('periode') }}</span>
                            </div>

                            <div class="description">
                                {{ $item->present('excerpt') }}
                            </div>
                        </div>
                        <div class="content">
                            <i class="thumbs up icon"></i>
                            {{ $item->present('dukungan') }} dukungan
                            &nbsp;
                            &nbsp;
                            <i class="comment icon"></i>
                            {{ $item->present('komentar') }} komentar

                            <span class="right floated">
                                {!! $item->present('label') !!}
                            </span>

                        </div>
                    </div>
                @endforeach
                <a href="{{ route('proker.arsip') }}" class="ui button fluid basic">Lihat Program Populer Lainnya</a>
            </div>
        </div>
    </section>
@endsection
