@extends('frontend.layouts.main')

@section('content')
    <div class="section no-pad-bot grey lighten-4" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center custom-orange-text">Site Map</h1>
            <div class="row center">
                <h5 class="header col s12 light">
                    <i class="material-icons large">map</i>
                </h5>
            </div>
            <br><br>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col s12 m12">
                <div class="card">
                    <div class="card-content">
                        <ul class="collapsible popout" data-collapsible="accordion">
                            <li>
                                <div class="collapsible-header active"><i class="material-icons">home</i>Home</div>
                                <div class="collapsible-body">
                                    <span>
                                        Halaman Home adalah halaman yang menampilkan article terbaru atau terpopuler, semua orang yang mengunjungin home page akan bisa melihat article terbaru dan bisa memilih article mana yang akan mereka baca di halaman home page yang tersedia dihalaman.
                                    </span>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header"><i class="material-icons">format_list_bulleted</i>Article</div>
                                <div class="collapsible-body">
                                    <span>
                                        Halaman Article adalah halaman yang menampilan article bersama category yang tersedia pada blog, user bisa memilih article nya berdasarkan category yang tersedia dihalaman article tersebut, lalu user bisa mencari article yang mereka inginkan dengan menggunakan fitur pencarian yang ada di halaman itu.
                                    </span>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header"><i class="material-icons">map</i>Site Map</div>
                                <div class="collapsible-body">
                                    <span>
                                        Halaman Site Map adalah halaman yang berisi peta situs atau halaman yang tersedia didalama website blog, user bisa mengetahui apa saja halaman yang tersedia di blog atau website dengan mengunjungi halaman site map.
                                    </span>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header"><i class="material-icons">warning</i>Privacy Police</div>
                                <div class="collapsible-body">
                                    <span>
                                        Halaman Pricacy Police berisi tentang syarat dan ketentuan website atau disclamer yang berlaku pada website atau blog tersebut.
                                    </span>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header"><i class="material-icons">contact_mail</i>Contact Us</div>
                                <div class="collapsible-body">
                                    <span>
                                        Halaman Contact Us adalah halaman yang bisa di gunakan user untuk mengirim pesan-pesan baik pesan suggesti, kritikan atau saran untuk pembuat article atau website, user bisa mengisi email, name dan message lalu mengirimkannya ke admin pemilik website atau author.
                                    </span>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header"><i class="material-icons">face</i>Abous Us</div>
                                <div class="collapsible-body">
                                    <span>
                                        Halaman About Us berisi tentang website atau blog your learning, tentang apa saja yang bisa dilakukan di your learning, hal apa saya yang bisa didapat dari website your learning.
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
