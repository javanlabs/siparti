@extends('layouts.frontend')

@section('content')
    <div class="ui segment basic center aligned" style="background: #1b1c1d; padding: 100px 0;">
        <div class="ui container">
            <h1 class="ui inverted header" style="font-size: 3em; font-weight: 300">
                LARAVOLT
            </h1>
            <div class="ui divider"></div>
            <h2 class="ui inverted header" style=" font-weight: 300">
                Laravel base application template to speed up your development flow.
            </h2>
            <div class="ui header purple">10 ready for use components included, and counting...</div>
            <br>
            <br>
            <div class="ui huge violet button">Download <i class="right download icon"></i></div>
            <div class="ui huge inverted violet button">Get Started <i class="right arrow icon"></i></div>
        </div>
    </div>

    <div class="ui container">
        <h2 class="ui header center aligned" style="margin: 40px 0">Inside Laravolt</h2>
        <div class="ui internally celled grid very relaxed equal width stackable" style="border: 1px solid #ddd">
            <div class="column">
                <h3>Authentication</h3>
                <p>Memanfaatkan fitur autentikasi bawaan Laravel yang sudah teruji.</p>
            </div>
            <div class="column">
                <h3>User Management</h3>
                <p>Fitur penanganan pengguna yang lengkap dan mudah untuk dimodifikasi, termasuk pengaturan profil pengguna.</p>
            </div>
            <div class="column">
                <h3>Password Management</h3>
                <p>Pengaturan password yang lebih aman dan canggih, memastikan pengguna tetap aman selaman dalam aplikasi.</p>
            </div>
            <div class="equal width row">
                <div class="column">
                    <h3>User Profile</h3>
                    <p>Setiap pengguna memiliki profil yang berbeda. Fitur ini sudah tersedia dan siap digunakan.</p>
                </div>
                <div class="column">
                    <h3>Application Settings</h3>
                    <p>Admin bisa mengatur konfigurasi aplikasi lewat halaman web, tanpa harus mengubah file konfigurasi secara langsung. Jika terjadi kesalahan, maka "Reset To Default" tetap bisa dilakukan.</p>
                </div>
                <div class="column">
                    <h3>ACL & Menu Management</h3>
                    <p>Atur siapa boleh mengakses apa. Setup menu secara dinamis berdasar role.</p>
                </div>
            </div>
            <div class="equal width row">
                <div class="column">
                    <h3>Responsive Design</h3>
                </div>
                <div class="column">
                    <h3>CRUD Builder</h3>
                </div>
                <div class="column">
                    <h3>Media Manager</h3>
                </div>
            </div>
        </div>
    </div>

@endsection
