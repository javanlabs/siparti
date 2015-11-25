@extends('admin.layouts.base')
@section('style-head')
    @include('admin.layouts.style')
   @endsection

@section('script-head')
        @include('admin.layouts.script')

         <script>

        $(document).ready(function() {

            function checkRadio() {
                var $val = $("input[type=radio]:checked").val();
                
                switch ($val) {

                    case "baru" :
                        $("#choice1").show();
                        $("#choice2").hide();
                        break;
                    case "pilih" :
                        $("#choice1").hide();
                        $("#choice2").show();
                        break;        
                }
            }

            checkRadio();
            
            $("input[type=radio]").change(function() {

                $('input[name=satker_id]').val("");
                $('input[name=satuanKerjaBaru]').val("");

                checkRadio();
            });
        });
            

        </script>
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
                      
                         <br />
                   
                        {{ csrf_field() }}
                        
                        {!! SemanticForm::text('name', 'Nama Program Kerja') !!}                            

                        <div class="field">

                            <label>Satuan Kerja</label>
                            
                            <div class="inline fields">
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input name="satkerChoice" type="radio" value="baru">
                                        <label>Buat Baru</label>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input checked="checked" name="satkerChoice" value="pilih" type="radio" >
                                        <label>Pilih Satuan Kerja</label>
                                    </div>
                                </div>
                            </div>

                            <div id="choice1">
                                {!! SemanticForm::text('satuanKerjaBaru', 'Satuan Kerja Baru') !!}                            
                            </div>
                            
                            <div class="field" id="choice2">

                                <label>Pilih Satuan Kerja</label>
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
                        </div>
                        
                        {!! SemanticForm::submit('Simpan') !!}

                    @else

                        <br />
                    
                        {{ csrf_field() }}
                        
                        <input type="hidden" name="_method" value="PUT">
                        
                        <div class="field">
                            <label>Nama Program Kerja</label>
                            <input type="text" name="name" value="{{ $programKerja->present('name') }}" />
                        </div>
                       
                        <div class="field">

                            <label>Satuan Kerja</label>
                            
                            <div class="inline fields">
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input name="satkerChoice" type="radio" value="baru">
                                        <label>Buat Baru</label>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input checked="checked" name="satkerChoice" value="pilih" type="radio" >
                                        <label>Pilih Satuan Kerja</label>
                                    </div>
                                </div>
                            </div>

                            <div id="choice1">
                                {!! SemanticForm::text('satuanKerjaBaru', 'Satuan Kerja Baru') !!}                            
                            </div>
                            
                            <div class="field" id="choice2">

                                <label>Pilih Satuan Kerja</label>
                                <div class="ui fluid search selection dropdown">
                                    <input name="satker_id" type="hidden" value="{{ $programKerja->present('satker') }}">
                                    <i class="dropdown icon"></i>
                                <div class="default text">Satuan Kerja</div>
                                    <div class="menu">
                                        @foreach($satkers as $data)
                                                <div class="item" data-value="{!! $data->present('id') !!}">{!! $data->present('name') !!}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>    
                        </div>

                        <div class="field">
                            {{ $programKerja->present('current_fase') }}
                        </div>
                        
                        {!! SemanticForm::submit('Simpan') !!}
                        
                       
                    @endif  

                    </form>
                    
                    
                </div>
            </div>
        </div>
    </section>      
    </div>
    
@endsection

