@extends('admin.layouts.base')

@section('content')

<div class="ui container">
    <section class="section-audit-trails">
        <div class="ui top attached menu borderless small">
            <div class="item">
                <h4>Daftar Kategori</h4>
            </div>
            <div class="item">
                <a href="{{ route('admin.category.create') }}" class="ui button"><i class="icon plus"></i> Tambah</a>
            </div>
        </div>
        <div class="ui segment attached fitted">
            <table class="ui very compact table bottom small">
                <thead>
                    <tr>
                        <th>Nama Kategori</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allSubCategories as $subCate)
                    <tr>
                        <td>{{ $subCate->name }} </td>
                        <td>{{ $subCate->status }} </td>
                        <td class="right aligned">
                            <div class="ui buttons mini basic">
                                <a class="ui button icon" href="{{ Route('admin.category.edit',
                                                                            ['id' => $subCate->id]) }}">
                                    <i class="edit icon"></i>
                                </a>
                                <form role="form" action="{{ route('admin.category.destroy',
                                                        [ 'id' => $subCate->id ]) }}"
                                      method="POST" id="delete-form">
                                    <input type="hidden" name="_method" value="DELETE">
                                    {{ csrf_field() }}
                                </form>
                                <button class="ui icon button delete-button">
                                    <i class="remove icon"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                        @foreach($subCate->subCategory as $firstNestedSub)
                        <tr>
                            <td>{{ str_repeat('&nbsp;', 8) }} {{ $firstNestedSub->name }}</td>
                            <td>{{ $firstNestedSub->status }} </td>
                            <td class="right aligned">
                                <div class="ui buttons mini basic icon">
                                    <a class="ui button" href="{{ Route('admin.category.edit',
                                                                                ['id' => $firstNestedSub->id]) }}">
                                        <i class="edit icon"></i>
                                    </a>
                                    <form role="form" action="{{ route('admin.category.destroy',
                                                            [ 'id' => $firstNestedSub->id ]) }}"
                                          method="POST" id="delete-form">
                                        <input type="hidden" name="_method" value="DELETE">
                                        {{ csrf_field() }}
                                    </form>
                                    <button class="ui button icon delete-button">
                                        <i class="remove icon"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @endforeach
              </tbody>
              <tfoot>
                </tfoot>
            </table>
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
