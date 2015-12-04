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
                	@if ($action == "create")
                    <h2 class="ui header text centered"><span>Membuat</span> Satuan Kerja</h2>
        					@else
        					<h2 class="ui header text centered"><span>Edit</span> Satuan Kerja</h2>
        					@endif

                  <form class="ui form" action="{{ $route }}" class="ui form large" method="POST" enctype="multipart/form-data">
                  @if ($action == "create")    
                      {{ csrf_field() }}

                      {!! SemanticForm::text('name', 'Nama Satuan Kerja', old('name')) !!}

                    	{!! SemanticForm::submit('Simpan') !!}
                  @else
                  	{{ csrf_field() }}
                      <input type="hidden" name="_method" value="PUT">
                    
                      <div class="field">
                      	<label>Nama Satuan Kerja</label>
                      	<input name="name" value="{{ (old('name')) ? old('name') : $satker->present('name') }}">
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

