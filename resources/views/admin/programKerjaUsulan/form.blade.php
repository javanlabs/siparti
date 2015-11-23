@extends('admin.layouts.base')
@section('content')

	<div class="ui container">
	<section class="ui container page" id="page-program-kerja-usulan-create">
        <div class="ui centered grid">
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
        </div>
    </section>		
    </div>
    
@endsection

