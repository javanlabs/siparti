@extends('layouts.frontend')

@section('content')
    <section class="ui container page" id="page-program-kerja-usulan">
        <h2 class="ui header"><span>Usulan</span> Program Kerja</h2>


        <form class="ui form top attached segment padded">
            <div class="ui grid two column stackable">
                <div class="column">
                    <div class="ui action input">
                        <input type="text" name="nama" value="{{ request('nama') }}" placeholder="Cari Usulan Program Kerja...">
                        <button type="submit" class="ui button primary">Cari</button>
                    </div>
                </div>
                <div class="column right">
                    <div class="ui list horizontal link right floated" style="margin-top: 5px">
                        <div class="item"><strong>Urut berdasar:</strong></div>
                        <a href="{{ route('proker-usulan.index', ['orderBy' => 'created_at', 'sortedBy' => 'desc']) }}" class="item">Terbaru</a>
                        <a href="{{ route('proker-usulan.index', ['orderBy' => 'vote_count', 'sortedBy' => 'desc']) }}" class="item">Dukungan</a>
                        <a href="{{ route('proker-usulan.index', ['orderBy' => 'comment_count', 'sortedBy' => 'desc']) }}" class="item">Komentar</a>
                    </div>
                </div>
            </div>
        </form>
        <div class="ui segment padded attached">
            <div class="ui three stackable doubling cards">
                @foreach($usulan as $item)
                    @include('program_kerja_usulan.card')
                @endforeach
            </div>
        </div>
        <div class="ui menu bottom attached">
            <div class="item borderless">
                <small>{!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($usulan))->summary() !!}</small>
            </div>
            {!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($usulan))->render('attached bottom right') !!}
        </div>

    </section>
@endsection
