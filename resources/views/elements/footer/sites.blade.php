<h4 class="ui inverted header">Pranala Situs</h4>

<div class="ui inverted link list">
    <a href="{{ url('auth/login') }}" class="item">Masuk</a>
    <a href="{{ url('auth/register') }}" class="item">Daftar</a>
    <a href="{{ url('site/tentang') }}" class="item">Tentang {{ settings('app.name') }}</a>
    <a href="{{ url('site/kontak') }}" class="item">Hubungi Kami</a>
</div>
