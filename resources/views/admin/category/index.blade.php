@extends('admin.layouts.base')

@section('style-head')
    @include('admin.layouts.style')
@endsection

@section('script-head')
        @include('admin.layouts.script')
@endsection

@section('content')

    <div class="ui container">
        <a href="{{ route('admin.category.create') }}" class="ui primary button">Buat Kategori</a>
        <section class="section-audit-trails">
         <br />
        
            <div class="ui top attached menu">
                <div class="menu">
                    <div class="item borderless">
                        <h4>Daftar Kategori</h4>
                    </div>
                </div>
                
            </div>
            <div class="ui segment attached fitted">
                <table class="ui very compact table bottom small sortable">
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
                                <a class="ui green button basic mini" href="{{ Route('admin.category.edit', ['id' => $subCate->id]) }}"><i class="large edit icon"></i></a> 
                                
                                <form role="form" action="{{ route('admin.category.destroy',  [ 'id' => $subCate->id ]) }}" method="POST" id="delete-form">
                                    <input type="hidden" name="_method" value="DELETE">
                                    {{ csrf_field() }}
                                </form>

                                <button class="ui red button basic mini delete-button"><i class="large remove icon"></i></button>
                            </td>
                        </tr>
                        <ol>
                            @foreach($subCate->subCategory as $firstNestedSub)
                            
                            <tr>
                                <td><li value="{{ $firstNestedSub->name }}">{{ $firstNestedSub->name }}</li>  </td>
                                <td>{{ $firstNestedSub->status }} </td>
                                <td class="right aligned">
                                    <a class="ui green button basic mini" href="{{ Route('admin.category.edit', ['id' => $firstNestedSub->id]) }}"><i class="large edit icon"></i></a> 
                                    
                                    <form role="form" action="{{ route('admin.category.destroy',  [ 'id' => $firstNestedSub->id ]) }}" method="POST" id="delete-form">
                                        <input type="hidden" name="_method" value="DELETE">
                                        {{ csrf_field() }}
                                    </form>

                                    <button class="ui red button basic mini delete-button"><i class="large remove icon"></i></button>
                                </td>
                            </tr>
                             
                            @endforeach()
                        </ol>
                        @endforeach()
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
