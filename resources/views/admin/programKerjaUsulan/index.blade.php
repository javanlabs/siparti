@extends('admin.layouts.base')
@section('style-head')
	@include('admin.layouts.style')
@endsection

@section('script-head')
		@include('admin.layouts.script')
@endsection
@section('content')

    <div class="ui container">

        <section class="section-audit-trails">

            <div class="ui top attached menu">
                <div class="menu">
                    <div class="item borderless">
                        <h4>Daftar Program Kerja Usulan</h4>
                    </div>
                </div>
                <div class="right menu">
                    <div class="ui right aligned item">
                        <form method="GET" action="{{ route('admin.programKerjaUsulan.index') }}">
                            <div class="ui transparent icon input">
                                <input class="prompt" name="nama" value="{{ request('search') }}" type="text" placeholder="Cari Program Kerja Usulan">
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
                        <th ><button data-click-state="0" id="checkAll"><i class="check circle icon icon-button"></i></button></th>
                        <th>Nama Pembuat</th>
                        <th>Nama Program Kerja Usulan</th>
                        <th>Instansi Terkait</th>
                        <th>Dokumen</th>
                        <th><i class="comments icon"></i></th>
                        <th><i class="thumbs up icon"></i></th>
                        <th><i class="thumbs down icon"></i></th>
                        <th>Dibuat pada tanggal</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($programKerjaUsulan as $data)
                        <tr>
                            <td><input class="deletedId" type="checkbox" value="{!! $data->present('id') !!}" /></td>
                            <td class="nameColumn"><img class="ui image avatar" src="{!! $data->present('creator_avatar') !!}">{!! $data->present('creator_name') !!}</td>
                            <td class="comments-list">
                                {!! $data->present('name') !!}
                           	</td>
                            <td>{!! $data->present('instansi_terkait') !!}</td>    
                            <td>
                                @foreach($data->getMedia() as $item)
                                  <a href="{{ $item->getUrl() }}">{{ $item->file_name }}</a>
                                @endforeach
                            </td>
                            <td>{!! $data->present('komentar') !!}</td>
                            <td>{!! $data->present('dukungan') !!}</td>
                            <td>{!! $data->present('penolakan') !!}</td>
                            <td>{!! $data->present('created_at') !!}</td>
                            <td class="right aligned">

                              <form role="form" action="{{ route('admin.programKerjaUsulan.destroy',  [ 'id' => $data->present('id') ]) }}" method="POST" id="delete-form">
                                <input type="hidden" name="_method" value="DELETE">
                                {{ csrf_field() }}
                              </form>
							  
							  <a class="ui green button basic mini" href="{{ route('admin.programKerjaUsulan.edit', [ 'id' => $data->present('id') ]) }}"><i class="large edit icon"></i></a>
							  		
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
            	</div>
            	
                <div class="item borderless">
                    <small>{!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($programKerjaUsulan))->summary() !!}</small>
                </div>
                {!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($programKerjaUsulan))->render('attached bottom right') !!}
            </div>
        </section>
    </div>

    <div class="ui small test modal deleteConfirm">
      <div class="header">
        Hapus Program Kerja Usulan
      </div>
    <div class="content">
      <p>Apakah anda akan menghapus program kerja usulan ini ?</p>
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
        Hapus Program Kerja Usulan
      </div>
    <div class="content">
      <p>Anda akan menghapus semua program kerja usulan yang telah dicentang ?</p>
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

    <form method="post" action="{{ route('admin.programKerjaUsulan.deleteMultiple') }}" role="form" id="multipleDeletedForm">
      {{ csrf_field() }}

    </form>



@endsection
