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

            <div class="ui menu top attached small">
                <div class="item borderless">
                    <strong>Program Kerja</strong>
                </div>
                <div class="item borderless">
                    <a href="{{ route('admin.programKerja.create') }}" class="ui button"><i class="icon plus"></i> Tambah</a>
                </div>
                <div class="menu right">
                    <a href="" class="item"><i class="icon file pdf outline red"></i></a>
                    <a href="" class="item"><i class="icon file excel outline green"></i></a>
                </div>
            </div>
            <div class="ui menu attached">
                <div class="menu">
                    <div class="item borderless">
                        <small>{!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($programKerja))->summary() !!}</small>
                    </div>
                </div>
                <div class="right menu">
                    <div class="ui right aligned item">
                        <form method="GET" action="{{ route('admin.programKerja.index') }}">
                            <div class="ui transparent icon input">
                                <input class="prompt" name="nama" value="{{ request('search') }}" type="text" placeholder="Cari Program Kerja">
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
                        <th width="50px">
                            <div class="ui checkbox" data-toggle="checkall" data-selector=".checkbox[data-type='check-all-child']">
                                <input type="checkbox">
                            </div>
                        </th>
                        <th>Nama Progran Kerja</th>
                        <th>Fase Sekarang</th>
                        <th>Pembuat</th>
                        <th>Satker</th>
                        <th>Dibuat Pada</th>


                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody class="collection">
                    @forelse($programKerja as $data)
                        <tr>
                            <td>
                                <div class="ui checkbox" data-type="check-all-child">
                                    <input type="checkbox" name="ids[]" value="{{ $data->id }}">
                                </div>
                            </td>
                            <td>{{ $data->present('name') }}</td>
                            <td>{!! $data->present('fase_sekarang') !!}</td>
                            <td>{{ $data->present('creator_name') }}</td>
                            <td>{{ $data->present('satker_name') }}</td>
                            <td>{{ $data->present('date_for_human') }}</td>

                            <td class="right aligned">
                                <div class="ui icon buttons mini basic">
                                    <a class="ui button" href="{{ Route('admin.programKerja.edit', ['id' => $data->present('id')]) }}"><i class="edit icon"></i></a>

                                    <form role="form" action="{{ route('admin.programKerja.destroy',  $data->id) }}" method="POST" onsubmit="return confirm('Anda yakin?')">
                                        <input type="hidden" name="_method" value="DELETE">
                                        {{ csrf_field() }}
                                        <button type="submit" class="ui button"><i class="delete icon"></i></button>
                                    </form>
                                </div>
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" class="warning center aligned" style="font-size: 1.5rem;padding:40px;font-style: italic">Data tidak tersedia</td>
                        </tr>
                    @endforelse
                  </tbody>
                </table>
            </div>
            <div class="ui menu bottom attached">
                <div class="item borderless">

                    <form role="form" data-type="delete-multiple" action="{{ route('admin.programKerja.destroy', ':ids') }}" method="POST" onsubmit="return confirm('Anda yakin?')">
                        <input type="hidden" name="_method" value="DELETE">
                        {{ csrf_field() }}
                        <button type="submit" class="mini ui button">Hapus Terpilih</button>
                    </form>
                </div>
                {!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($programKerja))->render('attached bottom right') !!}
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

    <div class="ui small test modal multipleDeleteConfirm">
      <div class="header">
        Hapus Beberapa Program Kerja
      </div>
    <div class="content">
      <p>Anda akan menghapus semua program kerja yang telah dicentang ?</p>
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

    <form method="post" action="{{ route('admin.programKerja.deleteMultiple') }}" role="form" id="multipleDeletedForm">
      {{ csrf_field() }}

    </form>



@endsection
