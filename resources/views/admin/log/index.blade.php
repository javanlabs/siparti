@extends('admin.layouts.base')
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
                        <th ><button data-click-state="0" id="checkAll"><i class="check circle icon icon-button"></i></button></th>
                        <th>Tanggal</th>
                        <th>Ip address</th>
                        <th>User</th>
                        <th>Email address</th>
                        <th>Activity</th>
             			<th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($logs as $data)
                        <tr>
                            <td><input class="deletedId" type="checkbox" value="{!! $data->present('id') !!}" /></td>
                            <td>{!! $data->present('date_for_human') !!}</td>
                            <td>{!! $data->present('ip_address') !!}</td>
                            <td>{!! $data->present('name') !!}</td>
                            <td>{!! $data->present('email') !!}</td>
                            
                            	
                            <td>{!! $data->present('activity') !!}</td>
                       		<td class="right aligned">
                              	
                              	<form role="form" action="{{ route('admin.logs.destroy',  [ 'id' => $data->present('id') ]) }}" method="POST" id="delete-form">
                                	<input type="hidden" name="_method" value="DELETE">
                                	{{ csrf_field() }}
                              	</form>

                              	<button class="ui red button basic mini delete-button"><i class="large remove icon"></i></button>
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="4" class="warning center aligned" style="font-size: 1.5rem;padding:40px;font-style: italic">Data tidak tersedia</td>
                        </tr>
                    @endforelse
                  </tbody>
                  <tfoot>
                    	<tr>
                    		<td>
                    			<button class="negative ui button" id="deleteMultiple">X</button>
                    		</td>
                    	</tr>
                    </tfoot>
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

    <div class="ui small test modal deleteConfirm">
      <div class="header">
        Hapus Log
      </div>
    <div class="content">
      <p>Apakah anda akan menghapus log ini ?</p>
    </div>
    <div class="actions">
        <div class="ui negative button">
        Tidak
        </div>
        <div class="ui positive right labeled icon button yess-button">
          Ya
          <i class="checkmark icon"></i>
        </div>
      </div>
    </div>

    <div class="ui small test modal multipleDeleteConfirm">
      <div class="header">
        Hapus Log
      </div>
    <div class="content">
      <p>Anda akan menghapus semua log yang telah dicentang ?</p>
    </div>
    <div class="actions">
        <div class="ui negative button">
        Tidak
        </div>
        <div class="ui positive right labeled icon button yess2-button">
          Ya
          <i class="checkmark icon"></i>
        </div>
      </div>
    </div>

    <form method="post" action="{{ route('admin.logs.deleteMultiple') }}" role="form" id="multipleDeletedForm">
      {{ csrf_field() }}

    </form>



@endsection
