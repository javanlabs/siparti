@extends('admin.layouts.base')
@section('content')

    <div class="ui container">
        <section class="section-audit-trails">

            <div class="ui top attached menu">
                <div class="menu">
                    <div class="item borderless">
                        <h4>@lang('audit_trail.title')</h4>
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
                        <th>@lang('audit_trail.time')</th>
                        <th>@lang('audit_trail.user')</th>
                        <th>@lang('audit_trail.action')</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($revisions as $item)
                        <tr>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->user }}</td>
                            <td>
                                {{ $item->table_name . '.' . $item->action }}
                            </td>
                            <td>
                                @if($item->action !== 'deleted')
                                <button class="ui button mini basic btn-view-log" data-target="#modal-log-{{ $item->id }}">@lang('audit_trail.detail')</button>

                                <div class="ui modal small" id="modal-log-{{ $item->id }}">
                                    <div class="header">{{ $item->table_name . '.' . $item->action }}</div>
                                    <div class="content">
                                        <table class="ui definition table small">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>Old</th>
                                                <th>New</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($item->getDiff() as $field => $value)
                                                <tr>
                                                    <td>{{ $field }}</td>
                                                    <td>{{ $value['old'] }}</td>
                                                    <td>{{ $value['new'] }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif
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
                    <small>{!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($revisions))->summary() !!}</small>
                </div>
                {!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($revisions))->render('attached bottom right') !!}
            </div>
        </section>
    </div>
@endsection
