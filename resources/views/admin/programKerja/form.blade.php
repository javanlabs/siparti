@extends('admin.layouts.base')
@section('style-head')
    @include('admin.layouts.style')
@endsection

@section('script-head')
        @include('admin.layouts.script')
@endsection
@section('content')

    <div class="ui container">
    <section class="ui container page" id="page-fase-program-kerja-create">
        <div class="ui centered grid">
            <div class="ten wide column">
                <div class="ui segment very padded">
                    @if ($action == "create")
                    <h2 class="ui header text centered"><span>Membuat</span> Program Kerja</h2>
                    @else
                    <h2 class="ui header text centered"><span>Edit</span> Program Kerja</h2>
                    @endif
                    <form class="ui form" action="{{ $route }}" class="ui form large" method="POST" enctype="multipart/form-data">
                    @if ($action == "create")    
                        {{ csrf_field() }}
                        
                        {{ SemanticForm::text('name', 'Nama Program Kerja') }}                            

                        <div class="field">
                            <label>Satuan Kerja</label>
                            <div class="ui fluid search selection dropdown">
                            <input name="satker_id" type="hidden">
                            <i class="dropdown icon"></i>
                            <div class="default text">Satuan Kerja</div>
                                <div class="menu">
                                    @foreach($satkers as $data)
                                            <div class="item" data-value="{!! $data->present('id') !!}">{!! $data->present('name') !!}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        {!! SemanticForm::submit('Simpan') !!}

                    @else

                        {{ csrf_field() }}
                        
                        <input type="hidden" name="_method" value="PUT">
                        
                        <div class="field">
                            <label>Nama Program Kerja</label>
                            <input type="text" name="name" value="{{ $programKerja->present('name') }}" />
                        </div>
                       
                        <div class="field">
                            <label>Satuan Kerja</label>

                            <label>Satuan Kerja Baru</label>
                            
                            <input type="text" name="satker" />
                            
                            <label>Satuan Kerja yang Tersedia</label>

                            <div class="ui fluid search selection dropdown">
                            <input name="satker_id" type="hidden" value="{{ $programKerja->present('satker_id') }}">
                            <i class="dropdown icon"></i>
                            <div class="default text">Satuan Kerja</div>
                                <div class="menu">
                                    @foreach($satkers as $data)
                                            <div class="item" data-value="{!! $data->present('id') !!}">{!! $data->present('name') !!}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            {{ $programKerja->present('current_fase') }}
                        </div>
                        
                        {!! SemanticForm::submit('Simpan') !!}
                        
                        <div class="descriptionText" style="display: none;">
                            {{ $fase->present('description') }}
                        </div>
                    @endif      
                    </form>
                    
                    
                </div>
            </div>
        </div>
    </section>      
    </div>
    
@endsection

