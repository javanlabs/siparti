@extends('admin.layouts.base')

@section('style-head')
    
    <link rel="stylesheet" type="text/css" href="{{ asset('css/redactor.css') }}">

@endsection

@section('script-head')
        <script src="{{ asset('js/redactor.min.js')}}"></script>
        <script src="{{ asset('js/kominfo.redactor.js')}}"></script>
@endsection

@section('content')
    <div class="ui container">
        <div class="ui segment very padded">
            <h2 class="ui header">Pengaturan Sistem</h2>
            <form action="{{ route('admin.settings.store') }}" class="ui form large" method="POST">
                {{ csrf_field() }}
                <div class="field">
                    <label>Nama Aplikasi</label>
                    <input type="text" name="name" value="{{ settings('app.name') }}">
                </div>

                <h4 class="ui subheader">Kontak</h4>
                <div class="field">
                    <label>Alamat</label>
                    <input type="text" name="contact_address" value="{{ settings('app.contact_address') }}">
                </div>
                <div class="field">
                    <label>Telepon</label>
                    <input type="text" name="contact_phone" value="{{ settings('app.contact_phone') }}">
                </div>
                <div class="field">
                    <label>Email</label>
                    <input type="email" name="contact_email" value="{{ settings('app.contact_email') }}">
                </div>

                <h4 class="ui subheader">URL</h4>
                <div class="field">
                    <label>Facebook</label>
                    <input type="text" name="url_facebook" value="{{ settings('app.url_facebook') }}">
                </div>
                <div class="field">
                    <label>Twitter</label>
                    <input type="text" name="url_twitter" value="{{ settings('app.url_twitter') }}">
                </div>

                <div class="field">
                    <label>Tentang</label>
                    
                    <textarea name="tentang" class="textRedactor" rows="50"></textarea>
                </div>

                
                <div class="descriptionText" style="display: none;">
                    {{ settings('app.tentang') }}
                </div>
                
                <button class="ui button primary">Simpan</button>
            </form>
        </div>
         
            
    </div>

   
@endsection
