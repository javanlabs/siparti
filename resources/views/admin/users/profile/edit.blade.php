@extends('admin.users.edit')

@section('content-user-edit')
    {!! Form::open([
        'method' => 'put',
        'route' => ['admin.profile.update', $user['id']],
        'class' => 'ui form'
    ]) !!}

    <div class="field">
        <label>@lang('users.bio')</label>
        {!! Form::textarea('bio', old('bio', $profile['bio']), ['rows' => 3]) !!}
    </div>

    <div class="field">
        <label>@lang('users.timezone')</label>
        {!! Form::select('timezone', $timezones, old('timezone', $profile['timezone']), ['class' => 'ui dropdown']) !!}
    </div>

    <div class="ui divider hidden"></div>
    <button class="ui button primary" type="submit" name="submit" value="1">@lang('button.save')</button>
    <a href="{{ route('admin.users.index') }}" class="ui button">@lang('button.cancel')</a>
    {!! Form::close() !!}
@endsection
