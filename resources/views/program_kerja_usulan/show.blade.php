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

                {!! Votee::render($usulanProker, ['class' => 'fluid']) !!}
                {!! Mural::render($usulanProker, 'default') !!}

            </div>
            <div class="column six wide">

            </div>
        </div>

    </section>
@endsection
