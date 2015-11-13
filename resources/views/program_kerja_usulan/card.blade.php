<div class="ui card fluid">
    <div class="content">
        <a href=""><img src="{{ $item->present('creator_avatar') }}" class="ui avatar image" alt=""> {{ $item->present('creator_name') }}</a>
        <span class="right floated meta">{{ $item->present('created_for_human') }}</span>
    </div>

    <div class="content body">
        <a class="header" href="{{ $item->present('url') }}">{{ str_limit($item->present('name'), 150) }}</a>
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
