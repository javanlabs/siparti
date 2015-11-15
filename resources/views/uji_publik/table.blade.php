<div class="ui list horizontal link right floated" style="margin-top: 5px">
    <div class="item"><strong>Urut berdasar:</strong></div>
    <a href="{{ route('uji-publik.index', ['orderBy' => 'created_at', 'sortedBy' => 'desc']) }}" class="item">Terbaru</a>
    <a href="{{ route('uji-publik.index', ['orderBy' => 'vote_up', 'sortedBy' => 'desc']) }}" class="item">Dukungan</a>
    <a href="{{ route('uji-publik.index', ['orderBy' => 'comment', 'sortedBy' => 'desc']) }}" class="item">Komentar</a>
</div>

<form class="ui form top attached menu borderless">
    <input type="hidden" name="orderBy" value="{{ request('orderBy', 'created_at') }}">
    <input type="hidden" name="sortedBy" value="{{ request('sortedBy', 'desc') }}">
    <div class="item">
        <input type="text" name="nama" value="{{ request('nama') }}" placeholder="Nama...">
    </div>
    <div class="item">
        {!!  Form::select('tahun', $year, request('tahun'), ['class' => 'ui dropdown']) !!}
    </div>
    <div class="item">
        <button type="submit" class="ui button primary">Cari</button>
    </div>
</form>
<div class="ui segment attached">
    <div class="ui cards three">
        @forelse($ujiPublik as $item)
            @include('uji_publik.card')
        @empty

        @endforelse
    </div>
</div>
<div class="ui menu bottom attached">
    <div class="item borderless">
        <small>{!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($ujiPublik))->summary() !!}</small>
    </div>
    {!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($ujiPublik))->render('attached bottom right') !!}
</div>
