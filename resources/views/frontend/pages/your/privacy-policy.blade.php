@extends('frontend.layouts.main')

@section('content')
    <div class="section no-pad-bot grey lighten-4" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center custom-orange-text">Privacy Policy</h1>
            <div class="row center">
                <h5 class="header col s12 light">
                    <i class="material-icons large">warning</i>
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
                        <h5>Kebijakan Privasi untuk <b>{{ config('your.app.name') }}</b></h5>
                        <p>
                            Privasi Anda sebagai pengunjung {{ config('your.app.name') }} adalah hal yang sangat penting bagi kami.
                        </p> <br />

                        <p>
                          Di {{ config('your.app.name') }} kami menganggap bahwa privasi dari informasi pribadi Anda adalah hal yang penting. 
                          Dan inilah keterangan mengenai informasi apa saja yang kami terima dan kami kumpulkan pada saat Anda mengunjungi {{ config('your.app.name') }} 
                          dan bagaimana kami menyimpan serta menjaga informasi tersebut.
                          Kami tegaskan bahwa kami tidak akan pernah memberikan informasi tersebut kepada pihak ketiga.      
                        </p>
                        <br />
                        <h5>Tentang file log</h5>
                        <p>
                            Seperti kebanyakan situs lain, kami mengumpulkan dan menggunakan data yang terdapat pada file log. 
                            Informasi yang terdapat pada file log termasuk alamat IP (Internet Protocol) Anda, ISP (Internet Service Provider), 
                            browser yang Anda gunakan, waktu pada saat Anda berkunjung dan halaman mana saja yang Anda buka selama berkunjung
                            di {{ config('your.app.name') }}.
                        </p>
                        <br />
                        <h5>Tentang cookies</h5>
                        <p>
                            Situs kami menggunakan cookies untuk menaruh informasi, 
                            seperti informasi preferensi pribadi Anda pada saat mengunjungi situs kami. 
                            Ini juga mungkin termasuk untuk menampilkan jendela pop up untuk kunjungan pertama Anda, 
                            atau juga untuk menyimpan informasi login Anda di situs kami.
                        </p>
                        <br />
                        <p>
                            {{ config('your.app.name') }} juga menggunakan iklan dari pihak ketiga untuk mendukung situs kami. 
                            Beberapa penayang iklan ini mungkin menggunakan cookies ketika menampilkan iklan di situs kami, 
                            yang juga mengirimkan kepada pemasang iklan (seperti Google melalui program Adsense) 
                            informasi seperti alamat IP (Internet Protocol) Anda, 
                            ISP (Internet Servide Provider), browser internet yang Anda gunakan dan sebagainya.
                        </p>
                        <br />
                        <p>
                            Hal ini biasanya digunakan untuk tujuan penargetan iklan berdasarkan lokasi 
                            (seperti menampilkan iklan properti di Jakarta, misalnya) atau menampilkan iklan yang sesuai berdasarkan situs-situs yang telah Anda 
                            kunjungi (seperti menampilkan iklan gadget bagi Anda yang kerap mengunjungi situs-situs gadget, misalnya).
                        </p>
                        <br />
                        <p>
                            Anda dapat memilih untuk men-disable cookies melalui setelan pada browser Anda, atau melalui 
                            setting pada program semacam Norton Internet Security atau yang lainnya. Namun demikian, 
                            hal ini dapat mempengaruhi pengalaman Anda dalam berinteraksi dengan situs kami sebagaimana juga dengan situs lainnya.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection