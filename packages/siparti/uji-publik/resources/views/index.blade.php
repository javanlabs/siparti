@extends('admin.layouts.base')

@section('content')
    <div class="ui container">
        <h2>Uji Publik</h2>

        <div class="ui top attached menu">
            <div class="menu">
                <div class="item borderless">
                    <small>{!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($collection))->summary() !!}</small>
                </div>
            </div>
            <div class="right menu">
                <div class="ui right aligned item">
                    <form action="">
                        <div class="ui transparent icon input">
                            <input class="prompt" name="search" value="{{ request('search') }}" type="text" placeholder="Cari Uji Publik...">
                            <i class="search link icon"></i>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="ui segment attached fitted">
            <table class="ui very compact table bottom small">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @forelse($collection as $item)
                    <tr>
                        <td>{{ $item->present('id') }}</td>
                        <td>{{ $item->present('name') }}</td>
                        <td class="center aligned">
                            <div class="ui mini icon basic buttons">
                                <a href="{{ route('uji-publik.show', $item->id) }}" class="ui button"><i class="file icon"></i></a>
                                <a href="{{ route('uji-publik.edit', $item->id) }}" class="ui button"><i class="edit icon"></i></a>
                                <a href="" class="ui button"><i class="delete icon"></i></a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="1" class="warning center aligned" style="font-size: 1.5rem;padding:40px;font-style: italic">Data tidak tersedia</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="ui menu bottom attached">
            <div class="item borderless">
                <small>{!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($collection))->pager() !!}</small>
            </div>
            {!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($collection))->render('attached bottom right') !!}
        </div>

    </div>
@endsection
