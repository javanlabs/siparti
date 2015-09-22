@extends('my.settings')

@section('content-my')
    {!! Form::open([
         'method' => 'put',
         'url' => 'my/password',
         'class' => 'ui form'
     ]) !!}

    <div class="field">
        <label>@lang('users.password')</label>
        {!! Form::password('password', old('password')) !!}
    </div>
    <div class="field">
        <label>@lang('users.password_confirmation')</label>
        {!! Form::password('password_confirmation', old('password_confirmation')) !!}
    </div>

    <button class="ui button primary" type="submit" name="submit" value="1">@lang('button.save')</button>
    {!! Form::close() !!}
@endsection
