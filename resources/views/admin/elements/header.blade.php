<div class="ui attached menu stackable borderless">
    <div class="ui container">
        <div href="#" class="header item">
            <img class="logo" src="{{ asset('img/logo-laravolt.png') }}">
            &nbsp;
            &nbsp;
            <a href="{{url('/')}}">{{ settings('app.name') }}</a>
        </div>
        <a href="{{ route('admin.users.index') }}" class="item">Users</a>
        <a href="{{ route('admin.settings.index') }}" class="item">Settings</a>


        <div class="menu right">
            @if(auth()->check())
                <div class="ui pointing dropdown item">
                    <a href="">
                        {{ auth()->user()->name }} <i class="dropdown icon"></i>
                    </a>
                    <div class="menu small">
                        <a href="{{ url('auth/logout') }}" class="item">Logout</a>
                    </div>
                </div>
            @else
                <div class="item">
                    <div class="ui buttons small">
                        <a href="{{ url('auth/login') }}" class="ui button violet">Login</a>
                        <a href="{{ url('auth/register') }}" class="ui button purple">Daftar</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
