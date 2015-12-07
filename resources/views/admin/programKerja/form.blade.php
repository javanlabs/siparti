@extends('admin.layouts.base')
@section('style-head')
    @include('admin.layouts.style')
    @endsection

@section('script-head')
        @include('admin.layouts.script')

<?php $usulanArray = []; ?>
                        
@foreach($usulan as $data)
      <?php $usulanArray[$data->id] = $data->name; ?>
@endforeach 
        
        <script>
        
        function lockAddButton() 
        {
            $optionsCount = $("select#optionProgramKerja").find("option").length;

            if ($optionsCount) {

                $("#addProgramKerja").prop("disabled", false)
          
            } else {

                $("#addProgramKerja").prop("disabled", true)
            }
        }

        $(document).ready(function() {

            @if (Input::old('usulanId'))

                @foreach(Input::old('usulanId') as $id)
                      {!! '$(".ui.fluid.search.dropdown")' !!}
                      {!! '.dropdown("set selected", "' . $id . '");' !!}
                @endforeach

            @endif  

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Upgrade' : "HTTP/1.1"
                }
            });

            lockAddButton();

            $("#addProgramKerja").click(function() {
              

              var $txt = $("#optionProgramKerja option:selected").text();

              var $val = $("#optionProgramKerja option:selected").val();

              var $element = '<div class="item"><div class="right floated content"><div data-text="' + $txt +'" data-val="' + $val + '" class="ui button mini hapus">Hapus</div></div><div class="content">' + $txt + '</div></div>';

              $.ajax({

                  url     : "/admin/programKerja/addRelation",
                  type    : "POST",
                  data    : {usulan_id : $val, program_kerja_id : $("#usulanId").val() },
              
              })
              .done(function(data) {

                  $("#programKerjaContainer").prepend($element);

                  $('option').each(function(i, obj) {

                    if ($(obj).text() == $txt) {

                      $(obj).remove();
                    
                    }  

                    lockAddButton();
              })
              .fail(function() {

                  alert("Data tidak bisa ditambahkan, periksa koneksi internet");
              });
          });

              lockAddButton();
          });      

          $("#programKerjaContainer").on('click', '.hapus', function() {

                  var $button = $(this);

                  var count = 0;

                  var $text = $(this).attr('data-text');

                  var $value = $(this).attr('data-val');

                  var $optionElem = '<option value="' + $value +'">' + $text +'</option>';

              $.ajax({

                  url     : "/admin/programKerja/deleteRelation",
                  type    : "POST",
                  data    : {usulan_id : $value, program_kerja_id : $("#usulanId").val()},
              
              })
              .done(function(data) {

                      $("select").prepend($optionElem);
                  
                      $button.parent().parent().remove();

                      lockAddButton();
                  
              })
              .fail(function() {

                  alert("Data tidak bisa dihapus, periksa koneksi internet");
              });
          });

          function checkRadio() {
                var $val = $("input[type=radio]:checked").val();
                
                switch ($val) {

                    case "baru" :
                        $("input[name=satuanKerjaBaru]").prop('disabled', false);
                        $("#choice2").find("div.ui.fluid.search.selection.dropdown").attr('class', 'disabled ui fluid search selection dropdown');

                        break;
                    case "pilih" :
                        $("input[name=satuanKerjaBaru]").prop('disabled', true);
                        $("#choice2").find("div.ui.fluid.search.selection.dropdown.disabled").attr('class', 'ui fluid search selection dropdown');
                        break;        
               
                }
            }

            checkRadio();
            
            $("input[type=radio]").change(function() {
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
                        <input type="hidden" id="usulanId" value="{{ $programKerja->present('id') }}" />

                    @endif


                        <form class="ui form" action="{{ $route }}" class="ui form large" method="POST" enctype="multipart/form-data">

                    @if ($action == "create")
                      
                         <br />
                   
                        {{ csrf_field() }}
                        
                        <div class="field">
                            <label>Nama Program Kerja</label>
                            <input type="text" name="name" value="{{ Input::old('name') }}" />
                        </div>

                        <div class="field">

                            <label>Satuan Kerja</label>

                            <div class="ui grid">
                                <div class="two column row">
                                    <div class="column">
                                         <div class="field" id="choice2">
                                            <div class="ui radio checkbox">
                                                <input 

                                                @if(Input::old('satkerChoice') == "pilih")

                                                  checked="checked" 

                                                @elseif(Input::old('satkerChoice') == "baru")

                                                @else

                                                  checked="checked" 

                                                @endif

                                                name="satkerChoice" value="pilih" type="radio" >
                                                <label>Pilih Satuan Kerja</label>
                                            </div>
                                            <label></label>
                                            <div class="ui fluid search selection dropdown">
                                                <input name="satker_id" type="hidden" value="{{ Input::old('satker_id') }}">
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
                                            <input 

                                            @if(Input::old('satkerChoice') == "baru")

                                                checked="checked"

                                            @endif

                                            name="satkerChoice" type="radio" value="baru">
                                            <label>Buat Baru</label>
                                        </div>
                                        <div id="choice1">
                                            <input type="text" name="satuanKerjaBaru" value="{{ Input::old('satuanKerjaBaru') }}" placeholder="Buat Satuan Kerja Baru" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($action == "create")
                        
                        <div class="field">
                            <label>Relasi Usulan Program Kerja</label>
                                
                                <select name="usulanId[]" multiple="multiple" class="ui fluid search dropdown">

                                    <option value="">Pilih Program Usulan Kerja</option>

                                @foreach($usulanArray as $key => $value)

                                    <option value="{{ $key }}">{{ $value }}</option>

                                @endforeach 

                            </select>

                        @endif

                        <br />
                        {!! SemanticForm::submit('Simpan') !!}
                        
                        @else

                        <br />
                    
                        {{ csrf_field() }}
                        
                        <input type="hidden" name="_method" value="PUT">
                        
                        <div class="field">
                            <label>Nama Program Kerja</label>
                            <input type="text" name="name" value="{{ Input::old('name') ? Input::old('name') : $programKerja->present('name') }}" />
                        </div>
                       
                        <div class="field">

                            <label>Satuan Kerja</label>

                            <div class="ui grid">
                                <div class="two column row">
                                    <div class="column">
                                         <div class="field" id="choice2">
                                            <div class="ui radio checkbox">
                                                <input 
                                                    
                                                    @if(Input::old('satkerChoice') == "pilih" || !Input::old('satkerChoice'))  
                                                        checked="checked" 
                                                    @endif
                                                    
                                                    name="satkerChoice" value="pilih" type="radio" >
                                                <label>Pilih Satuan Kerja</label>
                                            </div>
                                            <label></label>
                                            <div class="ui fluid search selection dropdown">
                                                <input name="satker_id" type="hidden" 

                                                    value="{{ Input::old('satker_id') ? Input::old('satker_id') : $programKerja->present('satker') }}">
                                                
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
                                            
                                            <input name="satkerChoice" 
                                                  @if(Input::old('satkerChoice') == "baru")
                                                      checked = "checked";
                                                  @endif
                                            type="radio" value="baru">
                                            
                                            <label>Buat Baru</label>
                                        </div>
                                        <div id="choice1">
                                            <input type="text" name="satuanKerjaBaru" placeholder="Buat Satuan Kerja Baru" value="{{ Input::old('satuanKerjaBaru') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($action == "edit")  
                        
                        <div class="field">
                            {{ $programKerja->present('current_fase') }}
                        </div>
                        
                        @endif

                        {!! SemanticForm::submit('Simpan') !!}
                        
                       
                    @endif  

                    </form>
                    
                    
                </div>
            </div>

            @if ($action == "edit")

                @include('admin.programKerja.usulanSelector')

            @endif

        </div>
    </section>      
</div>
    
@endsection

