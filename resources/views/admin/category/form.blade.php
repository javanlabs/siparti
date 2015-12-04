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
                    <h2 class="ui header text centered"><span>Membuat</span> Kategori</h2>
        					@else
        					<h2 class="ui header text centered"><span>Edit</span> Kategori</h2>
        					@endif

                  <form class="ui form" action="{{ $route }}" class="ui form large" method="POST" enctype="multipart/form-data">
                  @if ($action == "create")    
                      {{ csrf_field() }}

                      {!! SemanticForm::text('name', 'Nama Kategori') !!}
                      <div class="field">
                            <label>Parent</label>
                          <div class="ui fluid search selection dropdown">
                            <input name="parent_id" type="hidden" value="{{ old('parent_id') }}">
                            <i class="dropdown icon"></i>
                            <div class="default text">Parent</div>
                              <div class="menu">
                                <div class="item" data-value="">Sebagai Parent</div>
                                @foreach($parent as $cat)
                                    <div class="item" data-value="{!! $cat->id !!}">{!! $cat->name !!}</div>
                                @endforeach
                              </div>
                          </div>
                      </div>
                    	{!! SemanticForm::submit('Simpan') !!}
                  @else
                  	{{ csrf_field() }}
                      <input type="hidden" name="_method" value="PUT">
                    
                      <div class="field">
                      	<label>Nama Kategori</label>
                      	<input name="name" value="{{ $category->present('name') }}">
                      </div>

       				        <div class="field">
                        <label>Parent</label>
                        <div class="ui fluid search selection dropdown">
                            <input name="parent_id" type="hidden" value="{{ $child }}">
                            <i class="dropdown icon"></i>
                            <div class="default text">Parent</div>
                            <div class="menu">
                              <div class="item" data-value="">Sebagai Parent</div>
                              @foreach($listparent as $cat)
                                  <div class="item" data-value="{!! $cat->id !!}">{!! $cat->name !!}</div>
                              @endforeach
                            </div>
                          </div>    
                      </div>     

                      <div class="field">
                        <label>Fase</label>
                          <div class="ui selection dropdown">
                  <input name="status" type="hidden" value="{{ $category->present('status') }}">
                  <i class="dropdown icon"></i>
                  <div class="default text">Gender</div>
                  <div class="menu">
                    <div class="item" data-value="ACTIVE">ACTIVE</div>
                    <div class="item" data-value="INCATIVE">INACTIVE</div>
                  </div>
              </div>
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

