<form class="ui form top attached menu borderless">
    <div class="item">
        <input type="text" name="nama" value="{{ request('nama') }}" placeholder="Nama...">
    </div>
    <div class="item">
        {!!  Form::select('satker_id', $satker, request('satker_id'), ['class' => 'ui dropdown']) !!}
    </div>
    <div class="item">
        {!!  Form::select('fase', $fase, request('fase'), ['class' => 'ui dropdown']) !!}
    </div>
    <div class="item">
        {!!  Form::select('tahun', $year, request('tahun'), ['class' => 'ui dropdown']) !!}
    </div>
    <div class="item">
        <button type="submit" class="ui button primary">Cari</button>
    </div>
</form>
<div class="ui segment attached fitted">
    <table class="ui table bottom small padded">
        <thead>
        <tr>
            <th>Nama</th>
            <th>Satker</th>
            <th>Fase</th>
            <th>Tahun</th>
        </tr>
        </thead>
        <tbody>
        @forelse($programKerja as $item)
            <tr>
                <td><a href="{{ $item->present('url') }}"><h5>{{ $item->present('name') }}</h5></a></td>
                <td>{{ $item->present('satker') }}</td>
                <td>{!! $item->present('label') !!}</td>
                <td>{{ $item->present('tahun') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="warning center aligned" style="font-size: 1.5rem;padding:40px;font-style: italic">Data tidak tersedia</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
<div class="ui menu bottom attached">
    <div class="item borderless">
        <small>{!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($programKerja))->summary() !!}</small>
    </div>
    {!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($programKerja))->render('attached bottom right') !!}
</div>
