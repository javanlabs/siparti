@if (count($errors) > 0)
    <div class="ui error message attached">
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

{!! Notification::showAll() !!}
