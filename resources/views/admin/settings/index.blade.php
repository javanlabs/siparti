@extends('admin.layouts.base')

@section('style-head')
    
    <link rel="stylesheet" type="text/css" href="{{ asset('css/redactor.css') }}">

@endsection

@section('script-head')
        
        <script src="{{ asset('js/redactor.min.js')}}"></script>

        <script>
             

             $(document).ready(function() {

                $("#textRedactor").redactor({
                    minHeight: 300,
                    imageUpload: '/image/upload',
                    plugins : ['imageManager'],
                    buttons: ['html', 'bold', 'italic', 'deleted', 'link', 'unorderedlist', 'orderedlist', 
                    'outdent', 'indent', 'image', 'link', 'alignment', 'horizontalrule'],
                    
                    modalClosedCallback : function()
                    {

                        $("html, body").animate({ scrollTop: 1000 }, 1); 
                    },
                    
                    imageUploadErrorCallback: function()
                    {

                        alert("Tidak bisa upload gambar, periksa koneksi internet")
                    }
                });
  
                $("#welcomeRedactor").redactor({
                    minHeight: 300,
                    imageUpload: '/image/upload',
                    plugins : ['imageManager'],
                    buttons: ['formatting', 'html', 'bold', 'italic', 'deleted', 'link', 'unorderedlist', 'orderedlist', 
                    'outdent', 'indent', 'image', 'link', 'alignment', 'horizontalrule'],
                    
                    modalClosedCallback: function()
                    {
                        $("html, body").animate({ scrollTop: 600 }, 1); 
                    },
                    
                    imageUploadErrorCallback: function()
                    {

                        alert("Tidak bisa upload gambar, periksa koneksi internet")
                    }
                });
                
                var textWelcome = $("#welcomeText").text();
                
                var textTentang = $("#descriptionText").text();
        
                $(".redactor-editor").text("");   
                
                $("#textRedactor").redactor('code.set', textTentang);
                $("#welcomeRedactor").redactor('code.set', textWelcome);

            });
        
        </script>


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
                    <label>Welcome Message</label>
                    &nbsp;
                    <textarea name="welcome" id="welcomeRedactor" rows="50"></textarea>
                </div>

                <div class="field">
                    <label>Tentang</label>
                    &nbsp;
                    <textarea name="tentang" id="textRedactor" rows="50"></textarea>
                </div>

                 <div id="welcomeText" style="display: none;">
                    {{ settings('app.welcome') }}
                </div>
                
                <div id="descriptionText" style="display: none;">
                    {{ settings('app.tentang') }}
                </div>

               
                
                <button class="ui button primary">Simpan</button>
            </form>
        </div>
         
            
    </div>

   
@endsection
