@extends('admin.users.edit')

@section('content-user-edit')
    {!! Form::open([
        'method' => 'put',
        'route' => ['admin.role.update', $user['id']],
        'class' => 'ui form'
    ]) !!}

    <div class="grouped fields">
        <label for="fruit">Role</label>
        @foreach($roles as $role)
        <div class="field">
            <div class="ui checkbox">
                <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ ($user->hasRole($role))?'checked=checked':'' }}>
                <label>{{ $role->name }}</label>
            </div>
        </div>
        @endforeach
    </div>

    <div class="ui divider hidden"></div>
    <button class="ui button primary" type="submit" name="submit" value="1">@lang('button.save')</button>
    <a href="{{ route('admin.users.index') }}" class="ui button">@lang('button.cancel')</a>
    {!! Form::close() !!}
@endsection
