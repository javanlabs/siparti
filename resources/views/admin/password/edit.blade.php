@extends('admin.layouts.col-3-1')

@section('content-left')
    <div class="ui container">
        <h2 class="ui header">Edit Password</h2>

        <div class="ui tabular menu top attached">
            <a class="item" data-tab="profile"><i class="icon user"></i> {{ $user['name'] }}</a>
            <a class="item active" data-tab="profile">Ganti Password</a>
            <div class="menu right">
                <div class="item"><a href="{{ route('admin.password.edit') }}" class="ui button red"><i class="icon trash"></i> Hapus User</a></div>
            </div>
        </div>
        <div class="ui segment bottom attached" data-tab="first">
            <div class="ui segment basic padded">
                <h4>Manual</h4>
                <p>User akan mendapat email yang berisi link untuk melakukan reset password. User harus mengisi sendiri password barunya.</p>
                <div class="ui list">
                    <a class="item" href="">Send email reset password</a>
                </div>
                <div class="ui divider"></div>
                <h4>Otomatis</h4>
                <p>Generate password baru, dan kirim password tersebut via email. User bisa langsung login menggunakan password baru tersebut.</p>
                <div class="ui list">
                    <a class="item" href="">Generate new password</a>
                </div>
            </div>

        </div>
    </div>
@endsection
