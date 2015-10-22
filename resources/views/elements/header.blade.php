<div class="ui attached menu stackable borderless">
    <div class="ui container">
        <div href="#" class="header item">
            <a href="{{url('/')}}">{{ settings('app.name') }}</a>
        </div>

        <div class="menu right">
            @if(auth()->check())
                <div class="ui pointing dropdown item">
                    <a href="">
                        <img src="{{ auth()->user()->getAvatar() }}" alt="" class="ui image avatar">
                        {{ auth()->user()->name }} <i class="dropdown icon"></i>
                    </a>
                    <div class="menu small">
                        @foreach(Menu::get('member')->roots() as $item)
                            <a class="item" href="{{ $item->url() }}">{!!  $item->title !!}</a>
                            @if($item->divider)
                                <div class="ui divider"></div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @else
                <div class="item">
                    <div class="ui buttons basic small">
                        <a href="{{ url('auth/login') }}" class="ui button">Login</a>
                        <a href="{{ url('auth/register') }}" class="ui button">Daftar</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
