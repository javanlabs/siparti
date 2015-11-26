@extends('admin.layouts.base')
@section('style-head')
	@include('admin.layouts.style')
@endsection

@section('script-head')
		@include('admin.layouts.script')

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

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          lockAddButton();

          $("#addProgramKerja").click(function() {
              

              var $txt = $("#optionProgramKerja option:selected").text();

              var $val = $("#optionProgramKerja option:selected").val();

              var $element = '<div class="item"><div class="right floated content"><div data-text="' + $txt +'" data-val="' + $val + '" class="ui button mini hapus">Hapus</div></div><div class="content">' + $txt + '</div></div>';

              $.ajax({

                  url     : "/admin/programKerjaUsulan/addRelation",
                  type    : "POST",
                  data    : {usulan_id : $("#usulanId").val(), program_kerja_id : $val},
              
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

                  url     : "/admin/programKerjaUsulan/deleteRelation",
                  type    : "POST",
                  data    : {usulan_id : $("#usulanId").val(), program_kerja_id : $value},
              
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

          
      });
     
    </script>

@endsection
@section('content')

<div class="ui container">

  <div class="ui container">
    <a class="ui button primary" href="{{ route('admin.programKerja.createBasedUsulan', ['usulan_id' => $programKerjaUsulan->present('id')] ) }}">Buat Program Kerja Berdasar Usulan ini</a>
  </div>

  
  <input type="hidden" id="usulanId" value="{{ $programKerjaUsulan->present('id') }}" />

	<section class="ui container page" id="page-program-kerja-usulan-create">
        <div class="ui grid">
            <div class="ten wide column">
                <div class="ui segment very padded">
                	<h2 class="ui header text centered"><span>Edit</span> Program Kerja Usulan</h2>
                    <form class="ui form" action="{{ route('admin.programKerjaUsulan.update', [ 'id' => $programKerjaUsulan->present('id') ]) }}" class="ui form large" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <input type="hidden" name="_method" value="PUT" />

                      	<div class="field">
                      	    <label>Nama Program Kerja Usulan</label>
                      		<input type="text" name="name" value="{{ $programKerjaUsulan->present('name') }}" />
                      	</div>

                      	<div class="field">
                      		<label>Deskripsi</label>
                      		<textarea name="description" class="textRedactor"></textarea>
                      	</div>

                        <div class="field">
                      	    <label>Instansi Terkait</label>
                      		<input type="text" name="instansi_stakeholder" value="{{ $programKerjaUsulan->present('instansi_terkait') }}" />
                      	</div>

                         <div class="field">
                        	<label>Manfaat</label>
                        	<input name="manfaat" type="text" value="{{ $programKerjaUsulan->present('manfaat') }}"  />
                        </div>

                        <div class="field">
                        	<label>Lokasit</label>
                        	<input name="lokasi" type="text" value="{{ $programKerjaUsulan->present('lokasi') }}"  />
                        </div>

                        <div class="field">
                        	<label>Target</label>
                        	<input name="target" type="text" value="{{ $programKerjaUsulan->present('target') }}"  />
                        </div>

                        <div class="field">
                        	<label>Lampiran</label>

                        	{{--*/ $i = 0 /*--}}
                        		<table class="ui celled table">
  									<thead>
    									<tr>
    										<th>Nama File</th>
    										<th>Hapus</th>
    									</tr>
  									</thead>
  									<tbody>

  											@forelse ($programKerjaUsulan->present('media') as $data)
  											<tr>
                        					<td>
                        						<a href="{{ $data->getUrl() }} ">{{ $data->name }}</a>
                        					</td>
                        					<td>
                        						<input type="checkbox" name="deletedMedia[]" value="{{ $i }}" />
                        					</td>
                        					</tr>
                   				{{--*/ $i++ /*--}}
                        					@empty
            									<tr>
                									<td colspan="4" class="warning center aligned" style="font-size: 1.5rem;padding:40px;font-style: italic">Tidak ada lampiran</td>
            									</tr>
                        					@endforelse
   										</tbody>
   								</table>
                        </div>

                        <div class="field">
                            <label for="">Dokumen Terkait</label>
                            <input type="file" name="file[]"><br>
                            <input type="file" name="file[]"><br>
                            <input type="file" name="file[]"><br>
                            <input type="file" name="file[]"><br>
                            <input type="file" name="file[]">
                        </div>

                        <div class="field">
                        	 {!! SemanticForm::submit('Simpan') !!}
                        </div>

 						 <div class="descriptionText" style="display: none;">
                       		{{ $programKerjaUsulan->present('description') }}
                       	</div>


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
              
              @foreach ($programKerjaUsulan->present('programKerja') as $data)
                  {!! $arrayId[] = $data->id !!}
                  {!! $arrayName[] = $data->name !!}  
              @endforeach

              @foreach ($programKerja as $data)
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
						
            @foreach($programKerjaUsulan->present('programKerja') as $data)
              
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

