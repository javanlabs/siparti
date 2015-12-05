@extends('admin.layouts.base')
@section('style-head')
    @include('admin.layouts.style')
    @endsection

@section('script-head')
        @include('admin.layouts.script')

    <script>

        $(document).ready(function() {
                                    $("input.search").prop('disabled', true);

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
                    <h2 class="ui header text centered"><span>Membuat</span> Program Kerja <span style="color: red;">Berdasar Usulan<span></h2>
                        <form class="ui form" action="{{ route('admin.programKerja.storeBasedUsulan') }}" class="ui form large" method="POST" enctype="multipart/form-data">
                            <br />
                            {{ csrf_field() }}
                            
                            <div class="field">
                                <label>Nama Usulan Program Kerja</label>
                                <p>{{ $programKerjaUsulan->present('name') }}</p>
                            </div>

                            <input type="hidden" name="usulan_id" value="{{ $programKerjaUsulan->present('id') }}" />

                             <div class="field">
                                <label>Nama Program Kerja</label>
                                <input type="text" name="name" 
                                    value="{{ Input::old('name') ? Input::old('name') : "" }}"/>
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
                                                <input name="satkerChoice" 

                                                    @if(Input::old('satkerChoice') == "baru")

                                                        checked="checked" 

                                                    @endif

                                                type="radio" value="baru">
                                            </div>
                                                <label>Buat Baru</label>
                                                <div id="choice1">
                                                <input type="text" name="satuanKerjaBaru" value="{{ Input::old('satuanKerjaBaru') }}" placeholder="Buat Satuan Kerja Baru" />
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                            <br />
                                        {!! SemanticForm::submit('Buat Program Kerja') !!}
                        </form>
                    </div>
                </div>
            </div>
    </section>      
</div>
    
@endsection

