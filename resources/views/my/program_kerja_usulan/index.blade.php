@extends('layouts.frontend')

@section('content')
    <section class="ui container page" id="page-program-kerja-usulan">
        <h2 class="ui header"><span>Usulan</span> Program Kerja Yang Pernah Dibuat</h2>
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
