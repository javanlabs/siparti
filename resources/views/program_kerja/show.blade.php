@extends('layouts.frontend')

@section('content')
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script>
$(document).ready(function() {
	(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=1495074717480968";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

	!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
});
</script>
    <section class="ui container page">
        <div class="ui grid">
            <div class="column sixteen wide">
                <h2 class="">{!! $programKerja->present('name') !!}</h2>
            </div>
            <div class="column ten wide">
                <table class="ui definition table small">
                    <tbody>
                    <tr><td style="width: 150px">Fase Sekarang</td><td>{!! $programKerja->present('label') !!}</td></tr>
                    <tr><td>Periode</td><td>{{ $programKerja->present('periode') }}</td></tr>
                    <tr><td>Instansi Terkait</td><td>{{ $programKerja->present('instansi_terkait') }}</td></tr>
                    <tr><td>Deskripsi</td><td>{{ $programKerja->present('description') }}</td></tr>
                    <tr>
                        <td>Fase Terkait</td>
                        <td>
                            <div class="ui list divided middle aligned relaxed">
                                @foreach($related as $item)
                                    <div class="item">
                                        {!! $item->present('label') !!}
                                        <a href="{{ $item->present('url') }}">{{ $item->present('periode') }}</a>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>
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
                <ul>
                	<li style="display: inline;">
                		<div class="fb-share-button" data-href="http://localhost:8000/proker/43" data-layout="button_count"></div>
                	</li>
                	<li style="display: inline;">
                		<div>
                			<a href="https://twitter.com/share" class="twitter-share-button"{count}>Tweet</a>
                		</div>
                	</li>
                	<li style="display: inline;">
                		<g:plus action="share"></g:plus>
                		
                	</li>
                	
                </ul>
                    <p>
                        Bagaimana pendapat Anda tentang program kerja ini?<br>
                        Berikan penilaian setuju atau tidak setuju, dan jangan lupa memberikan komentar yang membangun.
                    </p>
                    {!! Votee::render($programKerja, ['class' => 'basic fluid']) !!}
                </div>

                @if($programKerja->present('show_comment'))
                {!! Mural::render($programKerja, 'default', ['class' => 'very padded', 'readonly' => $programKerja->present('lock_comment')]) !!}
                @endif

            </div>
            <div class="column six wide">
                <div class="ui segments">
                    <div class="ui segment"><h3>Program Kerja Terkait</h3></div>
                    <div class="ui segment">
                        @foreach($related as $item)
                            @include('program_kerja.card')
                        @endforeach
                    </div>
                </div>
                <div class="ui segments">
                    <div class="ui segment"><h3>Program Kerja Terpopuler</h3></div>
                    <div class="ui segment">
                        @foreach($terpopuler as $item)
                            @include('program_kerja.card')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
