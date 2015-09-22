@extends('my.settings')

@section('content-my')
    {!! Form::open([
        'method' => 'put',
        'url' => 'my/email',
        'class' => 'ui form'
    ]) !!}

    <div class="field">
        <label>@lang('users.email')</label>
        {!! Form::text('email', old('email', $user['email'])) !!}
    </div>

    <button class="ui button primary" type="submit" name="submit" value="1">@lang('button.save')</button>
    {!! Form::close() !!}

@endsection
