<div class="ui attached menu inverted stackable borderless">
    <div class="ui container">
        <div href="#" class="header item">
            <img class="logo" src="{{ asset('img/logo-laravolt.png') }}">
            &nbsp;
            &nbsp;
            <a href="{{url('/')}}">{{ settings('app.name') }}</a>
        </div>

        <div class="ui dropdown item">
            Components <i class="dropdown icon"></i>
            <div class="menu">
                <a class="item" href="{{ url('components/mural') }}">
                    <h4 style="margin-bottom: 0">Mural</h4>
                    <p>Comment stream</p>
                </a>
                <div href="" class="divider"></div>
                <a class="item" href="{{ url('components/star') }}">
                    <h4 style="margin-bottom: 0">Star</h4>
                    <p>5 star rating</p>
                </a>
                <div href="" class="divider"></div>
                <a class="item" href="{{ url('components/votee') }}">
                    <h4 style="margin-bottom: 0">Votee</h4>
                    <p>Like dislike, upvote downvote</p>
                </a>
                <div href="" class="divider"></div>
                <a class="item" href="{{ url('components/senarai') }}">
                    <h4 style="margin-bottom: 0">Senarai</h4>
                    <p>Add any content to any list</p>
                </a>
                <div href="" class="divider"></div>
                <a class="item" href="{{ url('components/multilog') }}">
                    <h4 style="margin-bottom: 0">Multilog</h4>
                    <p>Multi file log for Laravel</p>
                </a>
            </div>
        </div>


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
