<div class="ui black inverted vertical footer segment very padded">
    <div class="ui container">
        <div class="ui stackable inverted grid">
            <div class="four wide column">
                @include('elements.footer.address')
            </div>
            <div class="four wide column">
                @include('elements.footer.links')
            </div>
            <div class="four wide column">
                @include('elements.footer.sites')
            </div>
            <div class="four wide right floated column">
                @include('elements.footer.social')
            </div>
        </div>
        <div class="ui horizontal divider header">
            <img src="{{ asset('img/logo-white.png') }}" alt="" class="ui image">
        </div>
        <div class="ui segment basic inverted center aligned">
            <div class="ui horizontal small divided list">
                <div class="item">Hak Cipta © {{ date('Y') }} Kementerian Komunikasi dan Informatika</div>
            </div>
        </div>
    </div>
</div>
