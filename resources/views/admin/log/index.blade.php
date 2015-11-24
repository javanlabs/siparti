@extends('admin.layouts.base')

@section('style-head')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/BeatPicker.min.css') }}">
@endsection

@section('script-head')
	<script src="{{ asset('js/BeatPicker.min.js') }}"></script>
@endsection

@section('content')

	<div class="ui container">
        <section class="section-audit-trails">
		 <br />
		
            <div class="ui top attached menu">
                <div class="menu">
                    <div class="item borderless">
                        <h4>Logging History</h4>
                    </div>
                </div>
                <div class="right menu">
                    <div class="ui right aligned item">
                        <form id="searchForm" method="GET" action="{{ route('admin.logs.index') }}">
                            <div class="ui transparent icon input">
                                <input class="dateInput" name="search" data-beatpicker-module="icon, clear" 
                                data-beatpicker="true" value="{{ request('search') }}" type="text" placeholder="Cari Log">
                                <input type="hidden" name="searchField" value="created_at" />
                                <button type="submit"><i class="search link icon"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="ui segment attached fitted">
                <table class="ui very compact table bottom small sortable">
                    <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Ip address</th>
                        <th>User</th>
                        <th>Email address</th>
                        <th>Activity</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($logs as $data)
                        <tr>
                            <td>{!! $data->present('date_for_human') !!}</td>
                            <td>{!! $data->present('ip_address') !!}</td>
                            <td>{!! $data->present('name') !!}</td>
                            <td>{!! $data->present('email') !!}</td>
                        	<td>{!! $data->present('activity') !!}</td>
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
                    <small>{!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($logs))->summary() !!}</small>
                </div>
                {!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($logs))->render('attached bottom right') !!}
            </div>
        </section>
    </div>
@endsection
