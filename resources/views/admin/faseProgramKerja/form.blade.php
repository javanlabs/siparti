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
                    <h2 class="ui header text centered"><span>Membuat</span> Fase Program Kerja</h2>
					@else
					<h2 class="ui header text centered"><span>Edit</span> Program Kerja</h2>
					@endif
                    <form class="ui form" action="{{ $route }}" class="ui form large" method="POST" enctype="multipart/form-data">
                    @if ($action == "create")    
                        {{ csrf_field() }}
                        
                      	<div class="field">
                      	    <label>Nama Program Kerja</label>
                      		<div class="ui fluid search selection dropdown">
  							<input name="proker_id" type="hidden" value="16">
  							<i class="dropdown icon"></i>
  							<div class="default text">Nama Program Kerja</div>
  								<div class="menu">
  									@foreach($programKerja as $data)
		 								  <div class="item" data-value="{!! $data->present('id') !!}">{!! $data->present('name') !!}</div>
		 							@endforeach
  								</div>
							</div>
                      	</div>
                      	<div class="field">
                      	<label>Fase</label>
                      		<div class="ui selection dropdown">
  								<input name="type" type="hidden">
  								<i class="dropdown icon"></i>
  								<div class="default text">Fase</div>
  								<div class="menu">
    								<div class="item" data-value="PENGAWASAN">Pengawasan</div>
    								<div class="item" data-value="PELAKSANAAN">Pelaksanaan</div>
    								<div class="item" data-value="PERENCANAAN">Perencanaan</div>
    							</div>
							</div>
                      	</div>
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
                        
                         <div class="field">
                        	<label>Scope</label>
                        	<input name="scope" type="text"  />
                        </div>
                        
                        {!! SemanticForm::text('target', 'Target') !!}
                        {!! SemanticForm::text('progress', 'Progress') !!}
                       	{!! SemanticForm::text('kendala', 'Kendala') !!}
                        {!! SemanticForm::text('instansi_terkait', 'Instansi Terkait') !!}
                        
                        <div class="field">
                        	<label>Tanggal Mulai</label>
                        	<input name="start_date" type="text" class="dateInput" data-beatpicker-module="icon,today,clear" data-beatpicker="true" />
                        </div>
                       	<div class="field">
                        	<label>Tanggal Selesai</label>
                        	<input name="end_date" type="text" class="dateInput" data-beatpicker-module="icon,today,clear" data-beatpicker="true" />
                        </div>
                        <div class="field">
                        	<label>Penjelasan Program Kerja</label>
                        	<textarea rows="50" class="textRedactor" name="description"></textarea>
                        </div>
                        
                        {!! SemanticForm::text('pic', 'Pic') !!}
  						{!! SemanticForm::text('pagu', 'Pagu') !!}
  						
  						<div class="field">
                            <label for="">Dokumen Terkait</label>
                            <input type="file" name="file[]"><br>
                            <input type="file" name="file[]"><br>
                            <input type="file" name="file[]"><br>
                            <input type="file" name="file[]"><br>
                            <input type="file" name="file[]">
                        </div>
                        
                        <div class="inline fields">
    						<label>Mode Komentar</label>
                        	<div class="field">
      							<div class="ui radio checkbox">
        							<input name="comment_mode" value="show" checked="checked" type="radio">
        							<label>Tampilkan</label>
      							</div>
    						</div>
    						<div class="field">
      							<div class="ui radio checkbox">
        							<input name="comment_mode" value="hide" type="radio">
        							<label>Sembunyikan</label>
      							</div>
    						</div>
    						<div class="field">
      							<div class="ui radio checkbox">
        							<input name="comment_mode" value="lock" type="radio">
        							<label>Kunci</label>
      							</div>
    						</div>
  						</div>
                        
                       
                      	{!! SemanticForm::submit('Simpan') !!}
                    @else
                    	{{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                      	<div class="field">
                      	    <label>Nama Program Kerja</label>
                      		<div class="ui fluid search selection dropdown">
  							<input name="proker_id" type="hidden" value="{{ $fase->present('proker_id') }}">
  							<i class="dropdown icon"></i>
  							<div class="default text">Nama Program Kerja</div>
  								<div class="menu">
  									@foreach($programKerja as $data)
		 								  <div class="item" data-value="{!! $data->present('id') !!}">{!! $data->present('name') !!}</div>
		 							@endforeach
  								</div>
							</div>
                      	</div>
                      	<div class="field">
                      	<label>Fase</label>
                      		<div class="ui selection dropdown">
  								<input name="type" type="hidden" value="{{ $fase->present('fase') }}">
  								<i class="dropdown icon"></i>
  								<div class="default text">Gender</div>
  								<div class="menu">
    								<div class="item" data-value="PENGAWASAN">Pengawasan</div>
    								<div class="item" data-value="PELAKSANAAN">Pelaksanaan</div>
    								<div class="item" data-value="PERENCANAAN">Perencanaan</div>
    							</div>
							</div>
                      	</div>
                        <div class="field">
                      	    <label>Satuan Kerja</label>
                      		<div class="ui fluid search selection dropdown">
  							<input name="satker_id" type="hidden" value="{{ $fase->present('satker_id') }}">
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
                        	<label>Scope</label>
                        	<input name="scope" type="text" value="{{ $fase->present('scope') }}" />
                        </div>
                        
                        <div class="field">
                        	<label>Target</label>
                        	<input name="target" value="{{ $fase->present('target') }}">
                        </div>
                        
                        <div class="field">
                        	<label>Progress</label>
                        	<input name="progress" value="{{ $fase->present('progress') }}">
                        </div>
                        
                        <div class="field">
                        	<label>Kendala</label>
                        	<input name="kendala" value="{{ $fase->present('kendala') }}">
                        </div>
                        
                        <div class="field">
                        	<label>Instansi Terkait</label>
                        	<input name="instansi_terkait" value="{{ $fase->present('instansi_terkait') }}">
                        </div>
                        
           				 <div class="field">
                        	<label>Tanggal Mulai</label>
                        	<input value="{{ $fase->present('start_date') }}" name="start_date" type="text" class="dateInput" data-beatpicker-module="icon,today,clear" data-beatpicker="true" />
                        </div>
                       	<div class="field">
                        	<label>Tanggal Selesai</label>
                        	<input value="{{ $fase->present('end_date') }}" name="end_date" type="text" class="dateInput" data-beatpicker-module="icon,today,clear" data-beatpicker="true" />
                        </div>
                        <div class="field">
                        	<label>Penjelasan Program Kerja</label>
                        	<textarea rows="50" class="textRedactor" name="description">
                        		
                        	</textarea>
                        </div>
                        
                        <div class="field">
                        	<label>Pagu</label>
                        	<input name="pagu" value="{{ $fase->present('pagu') }}">
                        </div>
                        
                        <div class="field">
                        	<label>Pic</label>
                        	<input name="pic" value="{{ $fase->present('pic') }}">
                        </div>
                                               	
                       <!-- Table file lampiran -->      	
                        
                        <div class="field" >
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
  										
  											@forelse ($fase->present('media') as $data)
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
                        
                       <!-- /Table file lampiran -->      	
                        
                        <div class="field">
                            <label for="">Dokumen Terkait</label>
                            <input type="file" name="file[]"><br>
                            <input type="file" name="file[]"><br>
                            <input type="file" name="file[]"><br>
                            <input type="file" name="file[]"><br>
                            <input type="file" name="file[]">
                        </div>
                         
                         <div class="inline fields">
    						<label>Mode Komentar</label>
                        	<div class="field">
      							<div class="ui radio checkbox">
        							<input name="comment_mode" value="show" 
        							@if ($fase->present('comment_mode') == "show")
        								checked="checked"
        							@endif
        							type="radio">
        							<label>Tampilkan</label>
      							</div>
    						</div>
    						<div class="field">
      							<div class="ui radio checkbox">
        							<input name="comment_mode" value="hide" 
        							@if ($fase->present('comment_mode') == "hide")
        								checked="checked"
        							@endif
        							type="radio">
        							<label>Sembunyikan</label>
      							</div>
    						</div>
    						<div class="field">
      							<div class="ui radio checkbox">
        							<input name="comment_mode" value="lock" 
        							@if ($fase->present('comment_mode') == "lock")
        								checked="checked"
        							@endif
        							type="radio">
        							<label>Kunci</label>
      							</div>
    						</div>
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

