@extends('layouts.frontend')

@section('content')
    <section class="ui container page">

        <div class="ui grid">
            <div class="column ten wide">
                <h2 class="">{!! $usulanProker->present('name') !!}</h2>

                <table class="ui definition table small">
                    <tbody>
                    <tr><td>Deskripsi</td><td>{{ $usulanProker->present('description') }}</td></tr>
                    <tr>
                        <td>Dokumen</td>
                        <td>
                            <div class="ui list divided middle aligned relaxed">
                                @foreach($documents as $item)
                                    <div class="item">
                                        <a href="{{ $item->getUrl() }}">{{ $item->file_name }}</a>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>

                    </tbody>
                </table>

                <div class="ui segment very padded">
                    <p>
                        Bagaimana pendapat Anda tentang program kerja ini?<br>
                        Berikan penilaian setuju atau tidak setuju, dan jangan lupa memberikan komentar yang membangun.
                    </p>
                    {!! Votee::render($usulanProker, ['class' => 'basic fluid']) !!}
                </div>

                {!! Mural::render($usulanProker, 'default', ['class' => 'very padded']) !!}


            </div>
            <div class="column six wide">

            </div>
        </div>

    </section>
@endsection
