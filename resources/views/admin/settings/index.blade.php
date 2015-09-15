@extends('admin.layouts.base')
@section('content')
    <div class="ui container">
        <div class="ui segment very padded">
            <h2 class="ui header">Application Setting</h2>
            <form action="{{ route('admin.settings.store') }}" class="ui form large" method="POST">
                {{ csrf_field() }}
                <div class="field">
                    <label>Application Name</label>
                    <input type="text" name="name" value="{{ settings('app.name') }}" placeholder="Application Name">
                </div>

                <button class="ui button">Save</button>
            </form>
        </div>
    </div>
@endsection
