@if (count($errors) > 0)
    <div class="ui error message attached">
        <i class="close icon"></i>
        <div class="ui container">
            <div class="header">
                {{ trans('flash.form_validation_failed') }}
            </div>
            <ul class="list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@if (Session::has('flash_notification.message'))

    <?php
    $level = Session::get('flash_notification.level');
    if($level == 'danger') {
        $level = 'error';
    }
    ?>
    <div class="ui message attached {{ $level }}" style="text-align: center;">
        <i class="close icon"></i>
        <div class="ui container">
            {!! Session::get('flash_notification.message') !!}
        </div>
    </div>
@endif
