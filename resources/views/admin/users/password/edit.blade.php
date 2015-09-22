@extends('admin.users.edit')

@section('content-user-edit')

    <h4>Manual</h4>
    <p>User akan mendapat email yang berisi link untuk melakukan reset password. User harus mengisi sendiri password barunya.</p>
    {!! Form::open(['route' => ['admin.password.reset', $user['id']], 'method' => 'POST']) !!}
    {{ csrf_field() }}
    <button type="submit" class="ui button" href="">Send email reset password</button>
    {!! Form::close() !!}

    <div class="ui divider"></div>

    <h4>Otomatis</h4>
    <p>Generate password baru, dan kirim password tersebut via email. User bisa langsung login menggunakan password baru tersebut.</p>
    {!! Form::open(['route' => ['admin.password.generate', $user['id']], 'method' => 'POST']) !!}
    {{ csrf_field() }}
    <button type="submit" class="ui button" href="">Send email reset password</button>
    {!! Form::close() !!}
@endsection
