<h3 class="ui horizontal divider header section">
    Paling Populer
</h3>


<div class="ui three column grid">
    <div class="column">
        <div class="ui header block">Program Kerja</div>
        <div class="ui ordered list">
            
            @foreach($popularData['popularFase'] as $data)
            
            <div class="item">
                <div class="header"><a href="{{ $data['url'] }}">{{ $data['name'] }}</a></div>
                {!! $data['status'] !!}
            </div>

            @endforeach

        </div>
    </div>
    <div class="column">
        <div class="ui header block">Uji Publik</div>
        <div class="ui ordered list">

            @foreach($popularData['popularUjiPublik'] as $data)
                <div class="item">
                    <div class="header"><a href="{{ $data['url'] }}">{{ $data['name'] }}</a></div>
                    {{ $data['creator_name'] }}
                </div>
            @endforeach

        </div>
    </div>
    <div class="column">
        <div class="ui header block">Usulan Masyarakat</div>
        <div class="ui ordered list">

            @foreach($popularData['popularUsulan'] as $data)
            
            <div class="item">
                <div class="header"><a href="{{ $data['url'] }}">{{ $data['name'] }}</a></div>
                oleh {{ $data['creator_name'] }}
            </div>  

            @endforeach

        </div>
    </div>
</div>
