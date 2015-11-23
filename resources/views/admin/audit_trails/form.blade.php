@extends('admin.layouts.base')
@section('content')

	<div class="ui container">
	<section class="ui container page" id="page-program-kerja-usulan-create">
        <div class="ui centered grid">
            <div class="ten wide column">
                <div class="ui segment very padded">
                	<h2 class="ui header text centered"><span>Edit</span> Audit Trails</h2>
                    <form class="ui form" action="{{ $route }}" class="ui form large" method="POST" enctype="multipart/form-data">
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
                   
                    </form>
                    
                    
                </div>
            </div>
        </div>
    </section>		
    </div>
    
@endsection

