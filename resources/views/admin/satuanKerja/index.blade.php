@extends('admin.layouts.base')

@section('style-head')
    @include('admin.layouts.style')
@endsection

@section('script-head')
        @include('admin.layouts.script')
@endsection

@section('content')

    <div class="ui container">
        <a href="{{ route('admin.satuanKerja.create') }}" class="ui primary button">Buat Satuan Kerja</a>
        <section class="section-audit-trails">
         <br />
        
            <div class="ui top attached menu">
                <div class="menu">
                    <div class="item borderless">
                        <h4>Daftar Satuan Kerja</h4>
                    </div>
                </div>
                
            </div>
            <div class="ui segment attached fitted">
                <table class="ui very compact table bottom small sortable">
                    <thead>
                    <tr>                        
                        <th>Nama Satuan Kerja</th>
                        <th>Dibuat Pada Tanggal</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($satker as $data)
                        <tr>
                            
                            <td>{!! $data->present('name') !!}</td>
                            <td>{!! $data->present('created_at') !!}</td>
                            <td class="right aligned">
                                <a class="ui green button basic mini" href="{{ Route('admin.satuanKerja.edit', ['id' => $data->present('id')]) }}"><i class="large edit icon"></i></a> 
                                
                                <form role="form" action="{{ route('admin.satuanKerja.destroy',  [ 'id' => $data->present('id') ]) }}" method="POST" id="delete-form">
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
                    </tfoot>
                </table>
            </div>
            <div class="ui menu bottom attached">
                <div class="item borderless">
                    <small>{!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($satker))->summary() !!}</small>
                </div>
                {!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($satker))->render('attached bottom right') !!}
            </div>
        </section>
    </div>

    <div class="ui small test modal deleteConfirm">
      <div class="header">
        Hapus Program Kerja
      </div>
    <div class="content">
      <p>Apakah anda akan menghapus program kerja ini ?</p>
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

@endsection
