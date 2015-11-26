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
                        $("input[name=satuanKerjaBaru]").prop('disabled', false);
                        $("input.search").prop('disabled', true);
                        break;
                    case "pilih" :
                        $("input[name=satuanKerjaBaru]").prop('disabled', true);
                        $("input.search").prop('disabled', false);
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
                        
                        <div class="field">
                            <label>Nama Program Kerja</label>
                            <input type="text" name="name" />
                        </div>

                        <div class="field">

                            <label>Satuan Kerja</label>

                            <div class="ui grid">
                                <div class="two column row">
                                    <div class="column">
                                         <div class="field" id="choice2">
                                            <div class="ui radio checkbox">
                                                <input checked="checked" name="satkerChoice" value="pilih" type="radio" >
                                                <label>Pilih Satuan Kerja</label>
                                            </div>
                                            <label></label>
                                            <div class="ui fluid search selection dropdown">
                                                <input name="satker_id" type="hidden">
                                                <i class="dropdown icon"></i>
                                                <div class="default text">Pilih Satuan Kerja</div>
                                                <div class="menu">
                                                    @foreach($satkers as $data)
                                                        <div class="item" data-value="{!! $data->present('id') !!}">{!! $data->present('name') !!}</div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div> 
                                    </div>

                                    <div class="column">
                                    <div class="ui radio checkbox">
                                            <input name="satkerChoice" type="radio" value="baru">
                                            <label>Buat Baru</label>
                                        </div>
                                        <div id="choice1">
                                            <input type="text" name="satuanKerjaBaru" placeholder="Buat Satuan Kerja Baru" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br />
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

                            <div class="ui grid">
                                <div class="two column row">
                                    <div class="column">
                                         <div class="field" id="choice2">
                                            <div class="ui radio checkbox">
                                                <input checked="checked" name="satkerChoice" value="pilih" type="radio" >
                                                <label>Pilih Satuan Kerja</label>
                                            </div>
                                            <label></label>
                                            <div class="ui fluid search selection dropdown">
                                                <input name="satker_id" type="hidden" value="{{ $programKerja->present('satker') }}">
                                                <i class="dropdown icon"></i>
                                                <div class="default text">Pilih Satuan Kerja</div>
                                                <div class="menu">
                                                    @foreach($satkers as $data)
                                                        <div class="item" data-value="{!! $data->present('id') !!}">{!! $data->present('name') !!}</div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div> 
                                    </div>

                                    <div class="column">
                                    <div class="ui radio checkbox">
                                            <input name="satkerChoice" type="radio" value="baru">
                                            <label>Buat Baru</label>
                                        </div>
                                        <div id="choice1">
                                            <input type="text" name="satuanKerjaBaru" placeholder="Buat Satuan Kerja Baru" />
                                        </div>
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
            <div class="six wide column">
               <div class="ui segment">
                    <h3 class="ui header">Program Kerja Terkait</h3>
                    
                    <div class="ui form">
                        <div class="fields inline">
                            <select id="optionProgramKerja" class="ui dropdown fluid search selection">

                                <?php $arrayId = []; ?>
              
                                <?php $arrayName = []; ?>
              
                                @foreach ($usulan as $data)
                                    {!! $arrayId[] = $data->present('id') !!}
                                    {!! $arrayName[] = $data->present('name') !!}  
                                @endforeach

                                @foreach ($usulan as $data)
                                    @if (!in_array($data->present('id'), $arrayId) and !in_array($data->present('name'), $arrayName))
                                    <option value="{{ $data->present('id') }}">{{ $data->present('name') }}</option>
                                    @endif
                                @endforeach

                            </select>
                            &nbsp;
                            <button id="addProgramKerja" class="ui button icon green"><i class="icon plus"></i></button>
                        </div>
                    </div>

                    <div class="ui divider"></div>

                    <div id="programKerjaContainer" class="ui middle aligned divided list relaxed">
                        
                        @foreach($usulan as $data)
              
                        <div class="item">
                            <div class="right floated content">
                                <div data-text="{{ $data->name }}" data-val="{{ $data->id }}" class="ui button mini hapus">Hapus</div>
                            </div>
                            <div class="content">{{ $data->name }}</div>
                        </div>
            
                        @endforeach
                    
                    </div>

                </div>
            </div>
        </div>
    </section>      
</div>
    
@endsection

