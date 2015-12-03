<div class="ui list horizontal link right floated" style="margin-top: 5px">
    <div class="item"><strong>Urut berdasar:</strong></div>
    <a href="{{ route($route, ['orderBy' => 'created_at', 'sortedBy' => 'desc']) }}" class="item">Terbaru</a>
    <a href="{{ route($route, ['orderBy' => 'vote_up', 'sortedBy' => 'desc']) }}" class="item">Dukungan</a>
    <a href="{{ route($route, ['orderBy' => 'comment', 'sortedBy' => 'desc']) }}" class="item">Komentar</a>
</div>


<form class="ui top attached menu borderless">
    <div class="item">
        <div class="ui action input">
          <input type="text" name="nama" value="{{ request('nama') }}" placeholder="Nama...">
          {!!  Form::select('category_id', $category, request('category_id'), ['class' => 'ui compact selection dropdown']) !!}
          {!!  Form::select('satker_id', $satker, request('satker_id'), ['class' => 'ui compact selection dropdown']) !!}
          {!!  Form::select('fase', $fase, request('fase'), ['class' => 'ui compact selection dropdown']) !!}
          {!!  Form::select('tahun', $year, request('tahun'), ['class' => 'ui compact selection dropdown']) !!}
          <button type="submit" class="ui button primary" tabindex="0">Cari</button>
        </div>
    </div>
</form>

<div class="ui segment attached padded">
    <div class="cards ui three doubling stackable">
        @foreach($programKerja as $item)
            @include('program_kerja.card')
        @endforeach
    </div>

    {{--<table class="ui table bottom small padded">--}}
        {{--<thead>--}}
        {{--<tr>--}}
            {{--<th>Nama</th>--}}
            {{--<th>Satker</th>--}}
            {{--<th>Fase</th>--}}
            {{--<th>Tahun</th>--}}
        {{--</tr>--}}
        {{--</thead>--}}
        {{--<tbody>--}}
        {{--@forelse($programKerja as $item)--}}
            {{--<tr>--}}
                {{--<td><a href="{{ $item->present('url') }}"><h5>{{ $item->present('name') }}</h5></a></td>--}}
                {{--<td>{{ $item->present('satker') }}</td>--}}
                {{--<td>{!! $item->present('label') !!}</td>--}}
                {{--<td>{{ $item->present('tahun') }}</td>--}}
            {{--</tr>--}}
        {{--@empty--}}
            {{--<tr>--}}
                {{--<td colspan="4" class="warning center aligned" style="font-size: 1.5rem;padding:40px;font-style: italic">Data tidak tersedia</td>--}}
            {{--</tr>--}}
        {{--@endforelse--}}
        {{--</tbody>--}}
    {{--</table>--}}
</div>
<div class="ui menu bottom attached">
    <div class="item borderless">
        <small>{!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($programKerja))->summary() !!}</small>
    </div>
    {!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($programKerja))->render('attached bottom right') !!}
</div>
