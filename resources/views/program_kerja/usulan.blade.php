@extends('layouts.frontend')

@section('content')
    <section class="ui container page" id="page-program-kerja-usulan">
        <h2 class="ui header"><span>Usulan</span> Program Kerja</h2>

        <div class="ui three stackable doubling cards">
            @foreach($usulan as $item)
                <div class="ui card fluid">
                    <div class="content">
                        <a href=""><img src="{{ $item->present('creator_avatar') }}" class="ui avatar image" alt=""> {{ $item->present('creator_name') }}
                        </a>
                    </div>

                    <div class="content body">
                        <div class="header" href="{{ $item->present('url') }}">{{ str_limit($item->present('name'), 150) }}</div>
                    </div>

                    <div class="content">
                        <i class="thumbs up icon"></i>
                        {{ $item->present('dukungan') }}
                        &nbsp;
                        &nbsp;
                        <i class="comment icon"></i>
                        {{ $item->present('komentar') }}

                        <span class="right floated meta">{{ $item->present('created_for_human') }}</span>

                    </div>

                </div>
            @endforeach
        </div>

        <div class="ui segment basic center aligned padded">
            {!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($usulan))->render('ui compact') !!}
        </div>

    </section>
@endsection
