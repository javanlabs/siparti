@extends('layouts.frontend')

@section('content')
    <section class="ui container page">
        <h2 class="ui header"><span>Kontak</span> Kami</h2>
        <div class="ui centered grid">
            <div class="ten wide column">
                <div class="ui segments very padded">
                    <div class="ui embed" data-url="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.668874456198!2d106.81913131435017!3d-6.175065662228888!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0xda9f1f20f2d3c433!2sKementerian+Komunikasi+dan+Informatika!5e0!3m2!1sen!2sid!4v1447227740252"></div>
                    <div class="ui segment">
                        <div class="ui grid three column divided">
                            <div class="row">
                                <div class="column">
                                    <div class="ui list">
                                        <div class="item">
                                            <i class="map marker icon"></i>
                                            <div class="content">
                                                <div class="header">Alamat Kantor</div>
                                                <div class="description">{{ settings('app.contact_address') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="ui list">
                                        <div class="item">
                                            <i class="phone icon"></i>
                                            <div class="content">
                                                <div class="header">Nomor Telepon</div>
                                                <div class="description">{{ settings('app.contact_phone') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="ui list">
                                        <div class="item">
                                            <i class="mail icon"></i>
                                            <div class="content">
                                                <div class="header">Alamat Email</div>
                                                <div class="description">{{ settings('app.contact_email') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
