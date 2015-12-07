@extends('admin.layouts.base')

@section('content')

    <div class="ui container">
        {!! Tablet::source($programKerja)
        ->title('Fase Program Kerja')
        ->addToolbar(render('tablet::buttons.create', ['url' => route('admin.programKerja.create')]))
        ->addToolbar(render('tablet::toolbars.delete', ['url' => route('admin.faseProgramKerja.destroy', ':ids')]))
        ->columns([
            new \Laravolt\Tablet\Components\Checkall(),
            ['header' => 'Nama', 'field' => 'name'],
            ['header' => 'Fase', 'present' => 'fase_sekarang'],
            ['header' => 'Satuan Kerja', 'present' => 'satker_name'],
            ['header' => 'Ditambahkan Oleh', 'present' => 'creator_name'],
            ['header' => 'Ditambahkan Pada', 'present' => 'date_for_human'],
            ['view' => 'tablet::buttons.action']
        ])
        ->render() !!}
    </div>
@endsection


@extends('admin.layouts.base')

@section('content')

    <div class="ui container">
        <section class="section-audit-trails">
            <div class="ui top attached menu small">
                <div class="item borderless">
                    <h4>Fase Program Kerja</h4>
                </div>
                <div class="item borderless">
                    <a href="{{ route('admin.faseProgramKerja.create') }}" class="ui button"><i class="icon plus"></i> Tambah</a>
                </div>
                <div class="right menu">
                    <div class="ui right aligned item">
                        <form method="GET" action="{{ route('admin.faseProgramKerja.index') }}">
                            <div class="ui transparent icon input">
                                <input class="prompt" name="nama" value="{{ request('search') }}" type="text" placeholder="Cari Fase Program Kerja">
                                <i class="search link icon"></i>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @if(!$programKerja->isEmpty())
                <div class="ui menu attached">
                    <div class="menu">
                        <div class="item borderless">
                            <small>{!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($programKerja))->summary() !!}</small>
                        </div>
                    </div>
                </div>
            @endif

            <div class="ui segment attached fitted">
                <table class="ui very compact table bottom small">
                    <thead>
                    <tr>
                        <th width="50px">
                            <div class="ui checkbox" data-toggle="checkall" data-selector=".checkbox[data-type='check-all-child']">
                                <input type="checkbox">
                            </div>
                        </th>
                        <th>Nama Progran Kerja</th>
                        <th>Fase Sekarang</th>
                        <th>Instansi Terkait</th>
                        <th>Satker</th>
                        <th><i class="comments icon"></i></th>
                        <th><i class="thumbs up icon"></i></th>
                        <th><i class="thumbs down icon"></i></th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($programKerja as $data)
                        <tr>
                            <td>
                                <div class="ui checkbox" data-type="check-all-child">
                                    <input type="checkbox" name="ids[]" value="{{ $data->id }}">
                                </div>
                            </td>
                            <td>{!! $data->present('name') !!}</td>
                            <td class="nameColumn">{!! $data->present('label') !!}</td>
                            <td>{!! $data->present('instansi_terkait') !!}</td>
                            <td>{!! $data->present('satker') !!}</td>
                            <td>{!! $data->present('komentar') !!}</td>
                            <td>{!! $data->present('dukungan') !!}</td>
                            <td>{!! $data->present('penolakan') !!}</td>
                            <td class="right aligned">
                                <div class="ui icon buttons mini basic">
                                    <a class="ui button" href="{{ Route('admin.faseProgramKerja.edit', ['id' => $data->id]) }}"><i class="edit icon"></i></a>

                                    <form role="form" action="{{ route('admin.faseProgramKerja.destroy',  $data->id) }}" method="POST" onsubmit="return confirm('Anda yakin?')">
                                        <input type="hidden" name="_method" value="DELETE">
                                        {{ csrf_field() }}
                                        <button type="submit" class="ui button"><i class="delete icon"></i></button>
                                    </form>
                                </div>
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
                    <form role="form" data-type="delete-multiple" action="{{ route('admin.faseProgramKerja.destroy', ':ids') }}" method="POST" onsubmit="return confirm('Anda yakin?')">
                        <input type="hidden" name="_method" value="DELETE">
                        {{ csrf_field() }}
                        <button type="submit" class="ui button basic mini">Hapus Terpilih</button>
                    </form>
                    {{--<small>{!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($programKerja))->summary() !!}</small>--}}
                </div>
                {!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($programKerja))->render('attached bottom right') !!}
            </div>
        </section>
    </div>

    <div class="ui small test modal deleteConfirm">
      <div class="header">
        Hapus Fase Program Kerja
      </div>
    <div class="content">
      <p>Apakah anda akan menghapus fase program kerja ini ?</p>
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
        Hapus Beberapa Fase Program Kerja
      </div>
    <div class="content">
      <p>Anda akan menghapus semua fase program kerja yang telah dicentang ?</p>
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

    <form method="post" action="{{ route('admin.faseProgramKerja.deleteMultiple') }}" role="form" id="multipleDeletedForm">
      {{ csrf_field() }}

    </form>



@endsection
