<section class="section-audit-trails">

    <div class="ui menu top attached">
        <div class="item borderless">
            <h4>{!! $title !!}</h4>
        </div>
        <div class="item borderless">
            <small>{!! sui_pagination($collection)->summary() !!}</small>
        </div>
        <div class="right menu">
            <div class="ui right aligned item">
                <form method="GET" action="">
                    <div class="ui transparent icon input">
                        <input class="prompt" name="search" value="{{ request('search') }}" type="text" placeholder="Cari...">
                        <i class="search link icon"></i>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(!$collection->isEmpty() && !empty($toolbars))
        <div class="ui menu attached">
            @foreach($toolbars as $toolbar)
                <div class="item borderless">
                    {!! $toolbar !!}
                </div>
            @endforeach
            <div class="menu right">
            </div>
        </div>
    @endif

    <div class="ui segment attached fitted">
        <table class="ui very compact table bottom small">
            <thead>
            <tr>
                @foreach($headers as $text)
                    <th>{!! $text !!}</th>
                @endforeach
            </tr>
            </thead>
            <tbody class="collection">
            @forelse($collection as $data)
                <tr>
                    @foreach($fields as $field)
                        <td>{!! $builder->renderCell($field, $data) !!}</td>
                    @endforeach

                </tr>

            @empty
                <tr>
                    <td colspan="{{ count($fields) }}" class="warning center aligned" style="font-size: 1.5rem;padding:40px;font-style: italic">Data tidak tersedia</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="ui menu bottom attached">
        <div class="item borderless">
            <small>{!! sui_pagination($collection)->pager() !!}</small>
        </div>
        @if(!$collection->isEmpty())
            {!! sui_pagination($collection)->render('attached bottom right') !!}
        @endif
    </div>
</section>
