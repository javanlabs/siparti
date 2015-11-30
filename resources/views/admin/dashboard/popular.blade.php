<h3 class="ui horizontal divider header section">
    Paling Populer
</h3>

<div class="ui three column grid">
    <div class="column">
        <div class="ui header block">Program Kerja</div>
        <div class="ui ordered list">

            @foreach($popularData[2] as $data)

            <div class="item">
                <div class="header"><a href="{{ $data->present('url') }}">{{ $data->present('name') }}</a></div>
                <span class="ui label mini green basic">{{ $data->present('status') }}</span>
            </div>

            @endforeach

        </div>
    </div>
    <div class="column">
        <div class="ui header block">Uji Publik</div>
        <div class="ui ordered list">

            @foreach($popularData[1] as $data)
                <div class="item">
                    <div class="header"><a href="{{ $data->present('url') }}">{{ $data->present('name') }}</a></div>
                    {{ $data->present('materi') }}
                </div>
            @endforeach

        </div>
    </div>
    <div class="column">
        <div class="ui header block">Usulan Masyarakat</div>
        <div class="ui ordered list">

            @foreach($popularData[0] as $data)
            <div class="item">
                <div class="header"><a href="{{ $data->present('url') }}">{{ $data->present('name') }}</a></div>
                oleh {{ $data->present('creator_name') }}
            </div>
            @endforeach

        </div>
    </div>
</div>
