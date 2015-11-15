<div class="ui attached menu inverted blue stackable" id="menu-navbar">
    <div class="ui container">
        <a href="{{ url('/') }}" class="item">
            <img src="{{ asset('img/logo-white.png') }}">
        </a>
        <a href="{{ url('/') }}" class="item">
            {{ settings('app.name') }}
        </a>
        <a class="item browse-proker">
            Program Kerja
            <i class="angle down icon"></i>
        </a>
        <div class="ui flowing popup inverted vertical menu" id="popup-proker">
            <a class="item" href="{{ url('program-kerja/arsip') }}">Arsip</a>
            <a class="item" href="{{ url('program-kerja/berjalan') }}">Sedang Berjalan</a>
            <a class="item" href="{{ route('proker-usulan.index') }}">Usulan Masyarakat</a>
        </div>
        <a href="{{ route('uji-publik.index') }}" class="item">Uji Publik</a>
        @if(auth()->check())
        <div class="item">
            <div class="ui buttons">
                <a href="{{ route('proker-usulan.create') }}" class="ui button primary"><i class="icon file text"></i> Usulkan Program Kerja</a>
                <a href="{{ route('uji-publik.create') }}" class="ui button teal"><i class="icon file text"></i> Uji Publik Baru</a>
            </div>
        </div>
        @endif
        {{--<div class="item">--}}
            {{--<div class="ui search">--}}
                {{--<div class="ui icon input">--}}
                    {{--<input class="prompt" type="text" placeholder="Pencarian...">--}}
                    {{--<i class="search icon"></i>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="menu right">
            {{--<a href="{{ url('site/tentang') }}" class="item">--}}
                {{--<h4 class="header">Tentang <i class="meta">{{ settings('app.name') }}</i></h4>--}}
            {{--</a>--}}
            {{--<a href="{{ url('site/kontak') }}" class="item">--}}
                {{--<h4 class="header">Hubungi <i class="meta">Pengelola Aplikasi</i></h4>--}}
            {{--</a>--}}
            @if(auth()->check())
                <a href="#" class="item" id="browse-user-menu">
                    <img src="{{ auth()->user()->getAvatar() }}" alt="" class="ui image avatar">
                    {{ auth()->user()->name }} <i class="angle down icon"></i>
                </a>
                <div class="ui flowing popup inverted vertical menu" id="popup-user-menu">
                    @foreach(Menu::get('member')->roots() as $item)
                        <a class="item" href="{{ $item->url() }}">{!!  $item->title !!}</a>
                    @endforeach
                </div>
            @else
                <a class="item" href="{{ url('auth/login') }}">
                    <h4 class="header">Masuk <i class="meta">Sebagai Anggota</i></h4>
                </a>
            @endif
        </div>
    </div>
</div>
