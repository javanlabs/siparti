@extends('layouts.frontend')

@section('content')
    <section class="ui container page">
        <h2 class="ui header text centered"><span>Arsip</span> Program Kerja</h2>

        <form class="ui form top attached menu borderless">
            <div class="item">
                <select name="" id="" class="ui dropdown">
                    <option value="1">-- Semua Satker --</option>
                </select>
            </div>
            <div class="item">
                <select name="" id="" class="ui dropdown">
                    <option value="1">-- Semua Fase --</option>
                </select>
            </div>
            <div class="item">
                <select name="" id="" class="ui dropdown">
                    <option value="1">2015</option>
                </select>
            </div>
            <div class="item">
                <input type="text">
            </div>
            <div class="item">
                <button type="submit" class="ui button primary">Cari</button>
            </div>
        </form>
        <div class="ui segment attached fitted">
            <table class="ui very compact table bottom small sortable">
                <thead>
                <tr>
                    <th>Nama</th>
                </tr>
                </thead>
                <tbody>
                @forelse($programKerja as $item)
                    <tr>
                        <td>{{ $item->present('name') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="warning center aligned" style="font-size: 1.5rem;padding:40px;font-style: italic">Data tidak tersedia</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="ui menu bottom attached">
            <div class="item borderless">
                <small>{!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($programKerja))->summary() !!}</small>
            </div>
            {!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($programKerja))->render('attached bottom right') !!}
        </div>

    </section>
@endsection
