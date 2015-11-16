@extends('admin.layouts.base')
@section('content')

    <div class="ui container">

        <section class="section-audit-trails">

            <div class="ui top attached menu">
                <div class="menu">
                    <div class="item borderless">
                        <h4>Daftar Komentar</h4>
                    </div>
                </div>
                <div class="right menu">
                    <div class="ui right aligned item">
                        <form action="">
                            <div class="ui transparent icon input">
                                <input class="prompt" name="search" value="{{ request('search') }}" type="text" placeholder="@lang('audit_trail.search')">
                                <i class="search link icon"></i>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="ui segment attached fitted">
                <table class="ui very compact table bottom small sortable">
                    <thead>
                    <tr>
                        <th>Pembuat Komentar</th>
                        <th>Komentar</th>
                        <th>Dibuat pada tanggal</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($comments as $comment)
                        <tr>
                            <td class="nameColumn"><img class="ui image avatar" src="{{ Avatar::create($comment->author->name)->toBase64() }}" /> {{ $comment->author->name }} </td>
                            <td class="comments-list">{{ $comment->body }}</td>
                            <td>{{ $comment->created_at }}</td>
                            <td class="right aligned">

                              <form role="form" action="{{ route('admin.comments.destroy', ['id' => $comment->id]) }}" method="POST" class="delete-form">
                                <input type="hidden" name="_method" value="DELETE">
                                {{ csrf_field() }}
                              </form>

                              <button class="ui red button basic mini delete-button">Delete</button>
                            </td>


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
                    <small>{!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($comments))->summary() !!}</small>
                </div>
                {!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($comments))->render('attached bottom right') !!}
            </div>
        </section>
    </div>


@endsection
