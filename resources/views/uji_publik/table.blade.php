<form class="ui form top attached menu borderless">
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
