<div class="ui feed timeline">

    @foreach($relatedUsulan as $item)
    <div class="event">
        <div class="label">
            <span class="ui empty circular label"></span>
        </div>

        <div class="content">
            <div class="date">
                {{ $item->present('created_at') }}
            </div>
            <div class="summary">
                <a class="user">
                    {{ $item->present('creator_name') }}
                </a> mengusulkan program kerja:
            </div>
            <a class="extra text">
                {{ $item->present('name') }}
            </a>
        </div>
    </div>
    @endforeach

    @foreach($histories as $item)
        <div class="event">
            <div class="label">
                <span class="ui empty circular label"></span>
            </div>

            <div class="content">
                <div class="date">
                    {{ $item->present('start_date') }}
                    {!! $item->present('label') !!}
                </div>
                <a class="extra text">
                    <small>
                        {{ $item->present('excerpt') }}
                    </small>
                </a>
            </div>
        </div>
    @endforeach

</div>
