@extends('admin.layouts.base')
@section('content')
    <div class="ui container">
        <div class="ui segment very padded">

            {!! Form::open([
                'method' => 'put',
                'route' => ['admin.roles.update', $role['id']],
                'class' => 'ui form'
            ]) !!}

            <div class="field required">
                <label>@lang('roles.name')</label>
                {!! Form::text('name', old('name', $role['name'])) !!}
            </div>

            <div class="grouped fields">
                <label for="fruit">Permission</label>
                @foreach($permissions as $permission)
                    <div class="field">
                        <div class="ui checkbox">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{ (in_array($permission->id, $assignedPermissions))?'checked=checked':'' }}>
                            <label>{{ $permission->name }}</label>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="ui divider hidden"></div>

            <button class="ui button primary" type="submit" name="submit" value="1">@lang('button.save')</button>
            <a href="{{ route('admin.roles.index') }}" class="ui button">@lang('button.cancel')</a>
            {!! Form::close() !!}

        </div>
    </div>
@endsection
