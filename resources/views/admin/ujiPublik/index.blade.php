@extends('admin.layouts.base')
@section('content')

    <div class="ui container">

        <section class="section-audit-trails">

            <div class="ui top attached menu">
                <div class="menu">
                    <div class="item borderless">
                        <h4>Daftar Uji Publik</h4>
                    </div>
                </div>
                <div class="right menu">
                    <div class="ui right aligned item">
                        <form method="GET" action="{{ route('admin.ujiPublik.index') }}">
                            <div class="ui transparent icon input">
                                <input class="prompt" name="nama" value="{{ request('search') }}" type="text" placeholder="Cari Uji Publik">
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
                        <th>Nama</th>
                        <th>Materi</th>
                        <th>Dokumen</th>
                        <th>Dibuat pada tanggal</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($ujiPublik as $data)
                        <tr>
                            <td><input class="deletedId" type="checkbox" value="{!! $data->present('id') !!}" /></td>
                            <td class="nameColumn">{!! $data->present('name') !!}</td>
                            <td class="comments-list">{!! $data->present('materi') !!}</td>
                            <td>
                                @foreach($data->getMedia() as $item)
                                  <a href="{{ $item->getUrl() }}">{{ $item->file_name }}</a>
                                @endforeach
                              </ul>
                            </td>
                            <td>
                              {!! $data->present('created_at') !!}
                            </td>
                            <td class="right aligned">

                              <form role="form" action="{{ route('admin.ujiPublik.destroy',  [ 'id' => $data->present('id') ]) }}" method="POST" id="delete-form">
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
                    <small>{!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($ujiPublik))->summary() !!}</small>
                </div>
                {!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($ujiPublik))->render('attached bottom right') !!}
            </div>
        </section>
    </div>

    <div class="ui small test modal deleteConfirm">
      <div class="header">
        Hapus Uji Publik
      </div>
    <div class="content">
      <p>Apakah anda akan menghapus uji publik ini ?</p>
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
        Hapus Beberapa Komentar
      </div>
    <div class="content">
      <p>Anda akan menghapus semua uji publik yang telah dicentang ?</p>
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

    <form method="post" action="{{ route('admin.ujiPublik.deleteMultiple') }}" role="form" id="multipleDeletedForm">
      {{ csrf_field() }}

    </form>

    <button id="deleteMultiple">Delete Multiple</button>


@endsection
