@extends('admin.users.edit')

@section('content-user-edit')
    {!! Form::open([
        'method' => 'put',
        'route' => ['admin.account.update', $user['id']],
        'class' => 'ui form'
    ]) !!}

    <div class="field">
        <label>@lang('users.name')</label>
        {!! Form::text('name', old('name', $user['name'])) !!}
    </div>
    <div class="field">
        <label>@lang('users.email')</label>
        {!! Form::text('email', old('email', $user['email'])) !!}
    </div>
    <div class="field">
        <label>@lang('users.status')</label>
        {!! Form::select('status', \App\Enum\UserStatus::values(), old('status', $user['status']), ['class' => 'ui dropdown']) !!}
    </div>

    <div class="ui divider hidden"></div>
    <button class="ui button primary" type="submit" name="submit" value="1">@lang('button.save')</button>
    <a href="{{ route('admin.users.index') }}" class="ui button">@lang('button.cancel')</a>
    {!! Form::close() !!}
@endsection
