<div class="ui card fluid">
    <div class="content body">
        <a class="header" href="{{ $item->present('url') }}">{{ str_limit($item->present('name'), 150) }}</a>
        <div class="description">{{ $item->present('excerpt') }}</div>
    </div>
    <div class="content">
        <i class="thumbs up icon"></i>
        {{ $item->present('dukungan') }}
        &nbsp;
        &nbsp;
        <i class="comment icon"></i>
        {{ $item->present('komentar') }}


    </div>

</div>
