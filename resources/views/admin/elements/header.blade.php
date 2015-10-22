<div class="ui divider hidden"></div>
<div class="ui menu borderless" style="box-shadow: none; border: 0 none">
    <div class="ui container">
        <a class="item item-browse-menu">
            <i class="sidebar icon"></i>
            Menu
        </a>
        <div class="ui flowing popup popup-menu-admin vertical menu">
            @foreach(Menu::get('admin')->roots() as $item)
            <a class="item" href="{{ $item->url() }}">{!!  $item->title !!}</a>
            @endforeach
        </div>
        {{--<div href="#" class="header item">--}}
            {{--<img class="logo" src="{{ asset('img/logo-laravolt.png') }}">--}}
            {{--&nbsp;--}}
            {{--&nbsp;--}}
            {{--<a href="{{url('/')}}">{{ settings('app.name') }}</a>--}}
        {{--</div>--}}


        <div class="menu right">
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
        </div>
    </div>
</div>
