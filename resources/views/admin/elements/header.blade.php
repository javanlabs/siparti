<div class="ui divider hidden"></div>
<div class="ui menu borderless" style="box-shadow: none; border: 0 none">
    <div class="ui container">

        <a href="{{ route('admin.home') }}" class="item"><i class="icon dashboard big"></i></a>

        @if(Menu::get('admin-content')->roots()->count() > 0)
        <a class="item item-popup" data-target="#popup-content">
            Konten
            <i class="angle down icon"></i>
        </a>
        <div class="ui flowing popup popup-menu-admin vertical menu" id="popup-content">
            @foreach(Menu::get('admin-content')->roots() as $item)
            <a class="item" href="{{ $item->url() }}">{!!  $item->title !!}</a>
            @endforeach
        </div>
        @endif

        @if(Menu::get('admin-master')->roots()->count() > 0)
        <a class="item item-popup" data-target="#popup-master">
            Data Master
            <i class="angle down icon"></i>
        </a>
        <div class="ui flowing popup popup-menu-admin vertical menu" id="popup-master">
            @foreach(Menu::get('admin-master')->roots() as $item)
            <a class="item" href="{{ $item->url() }}">{!!  $item->title !!}</a>
            @endforeach
        </div>
        @endif

        @if(Menu::get('admin-administration')->roots()->count() > 0)
        <a class="item item-popup" data-target="#popup-administration">
            Administrasi
            <i class="angle down icon"></i>
        </a>
        <div class="ui flowing popup popup-menu-admin vertical menu" id="popup-administration">
            @foreach(Menu::get('admin-administration')->roots() as $item)
            <a class="item" href="{{ $item->url() }}">{!!  $item->title !!}</a>
            @endforeach
        </div>
        @endif

        <div class="menu right">

            <a class="item item-popup" data-target="#popup-user">
                <img src="{{ auth()->user()->getAvatar() }}" alt="" class="ui image avatar">
                {{ auth()->user()->name }} <i class="dropdown icon"></i>
            </a>
            <div class="ui flowing popup popup-menu-admin vertical menu" id="popup-user">
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
