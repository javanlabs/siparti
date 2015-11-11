<div class="ui attached menu inverted blue stackable" id="menu-navbar">
    <div class="ui container">
        <div class="item">
            <img src="{{ asset('img/logo-white.png') }}">
        </div>
        <a href="{{ url('/') }}" class="item">
            {{ settings('app.name') }}
        </a>
        <a class="item item-browse-menu">
            Program Kerja
            <i class="angle down icon"></i>
        </a>
        <div class="ui flowing popup popup-menu-admin inverted vertical menu">
            <a class="item" href="{{ url('program-kerja/arsip') }}">Arsip</a>
            <a class="item" href="{{ url('program-kerja/berjalan') }}">Sedang Berjalan</a>
            <a class="item" href="{{ url('program-kerja/usulan') }}">Usulan Masyarakat</a>
        </div>
        <div class="item">
            <div class="ui search">
                <div class="ui icon input">
                    <input class="prompt" type="text" placeholder="Pencarian...">
                    <i class="search icon"></i>
                </div>
            </div>
        </div>

        <div class="menu right">
            <a href="{{ url('site/tentang') }}" class="item">
                <h4 class="header">Tentang <i class="meta">{{ settings('app.name') }}</i></h4>
            </a>
            <a href="{{ url('site/kontak') }}" class="item">
                <h4 class="header">Kontak <i class="meta">Pengelola Aplikasi</i></h4>
            </a>
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
                <a class="item" href="{{ url('auth/login') }}">
                    <h4 class="header">Masuk <i class="meta">Sebagai Anggota</i></h4>
                </a>
            @endif
        </div>
    </div>
</div>
