@extends('layouts.frontend')

@section('content')
    <section class="ui container page">
        <h2 class="ui header"><span>Usulan</span> Program Kerja</h2>

        <div class="ui four doubling cards">
            @foreach($usulan as $item)
                <div class="ui card fluid">
                    <div class="content">
                        <a href=""><img src="{{ $item->present('creator_avatar') }}" class="ui avatar image" alt=""> {{ $item->present('creator_name') }}</a>
                    </div>

                    <div class="content">

                        <a class="header">{{ $item->present('name') }}</a>

                        <div class="description">
                            {{ $item->present('excerpt') }}
                        </div>
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

        {!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($usulan))->render('ui') !!}

    </section>
@endsection
