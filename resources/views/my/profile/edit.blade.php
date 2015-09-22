@extends('my.settings')

@section('content-my')
    {!! Form::open([
        'method' => 'put',
        'url' => 'my/profile',
        'class' => 'ui form'
    ]) !!}

    <div class="field">
        <label>@lang('users.name')</label>
        {!! Form::text('name', old('name', $user['name'])) !!}
    </div>

    <div class="field">
        <label>@lang('users.bio')</label>
        {!! Form::textarea('bio', old('bio', $profile['bio']), ['rows' => 3]) !!}
    </div>

    <div class="field">
        <label>@lang('users.timezone')</label>
        {!! Form::select('timezone', $timezones, old('timezone', $profile['timezone']), ['class' => 'ui dropdown']) !!}
    </div>
    <button class="ui button primary" type="submit" name="submit" value="1">@lang('button.save')</button>
    {!! Form::close() !!}
@endsection
