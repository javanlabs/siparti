@extends('layouts.frontend')

@section('content')
    <section class="ui container page">
        <h2 class="ui header"><span>Tentang</span> {{ settings('app.name') }}</h2>
        <div class="ui centered grid">
            <div class="ten wide column">
                <div class="ui segment very padded">
                    <p>{{ settings('app.name') }}</p>{!! settings('app.tentang') !!}
            </div>
        </div>
    </section>
@endsection
