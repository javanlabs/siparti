<div class="ui card fluid">
    <div class="content">

        <a class="header" href="{{ $item->present('url') }}">{{ $item->present('name') }}</a>

        <div class="meta">
            <span class="date">{{ $item->present('periode') }}</span>
        </div>

        <div class="description">
            {{ $item->present('excerpt') }}
        </div>
    </div>
    <div class="content">
        <i class="thumbs up icon"></i>
        {{ $item->present('dukungan') }} dukungan
        &nbsp;
        &nbsp;
        <i class="comment icon"></i>
        {{ $item->present('komentar') }} komentar

        <span class="right floated">
            {!! $item->present('label') !!}
        </span>

    </div>
</div>
