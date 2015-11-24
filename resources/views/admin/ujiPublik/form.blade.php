@extends('admin.layouts.base')
@section('style-head')
	@include('admin.layouts.style')
@endsection

@section('script-head')
		@include('admin.layouts.script')
@endsection
@section('content')

	<div class="ui container">
	<section class="ui container page" id="page-program-kerja-usulan-create">
        <div class="ui centered grid">
            <div class="ten wide column">
                <div class="ui segment very padded">
                	<h2 class="ui header text centered"><span>Edit</span> Uji Publik</h2>
                    <form action="{{ route('admin.ujiPublik.update', [ 'id' => $ujiPublik->present('id') ]) }}" class="ui form large" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        
                        <input type="hidden" name="_method" value="PUT" />
                      	
                      	<div class="field">
                      	    <label>Nama Uji Publik</label>
                      		<input type="text" name="name" value="{{ $ujiPublik->present('name') }}" />
                      	</div>
                      	
                        <div class="field">
                        	<label>Materi</label>
                        	<input type="text" name="materi" value="{{ $ujiPublik->present('materi') }}" />
                        </div>
                        
                       <div class="field">
                        	<h4>Lampiran</h4>
                        	
                        	{{--*/ $i = 0 /*--}}
                        		<table class="ui celled table">
  									<thead>
    									<tr>
    										<th>Nama File</th>
    										<th>Hapus</th>
    									</tr>
  									</thead>
  									<tbody>
  										
  											@forelse ($ujiPublik->present('media') as $data)
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
                   		
                    </form>
                    
                    
                </div>
            </div>
        </div>
    </section>		
    </div>
    
@endsection

