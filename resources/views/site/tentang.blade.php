@extends('layouts.frontend')

@section('content')
    <section class="ui container page">
        <h2 class="ui header"><span>Tentang</span> {{ settings('app.name') }}</h2>
        <div class="ui centered grid">
            <div class="ten wide column">
                <div class="ui segment very padded">
                    <p>{{ settings('app.name') }} adalah sebuah program dari Kementerian Komunikasi dan Informasi Republik Indonesia untuk memberikan transparansi kepada publik tentang program kerja dari Departemen Komunikasi dan Informasi, baik yang sedang berjalan maupun yang sedang dalam perencanaan.</p>
                    <p>Dengan adanya transparansi ini diiharapkan publik dapat memberikan masukan atau usulan terkait program kerja yang sedang berjalan maupun sedang dalam perencanaan tersebut.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
