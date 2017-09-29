@extends('frontend.layouts.main')

@section('content')
    <div class="section no-pad-bot grey lighten-4" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center custom-orange-text">{{ env('APP_NAME') }}</h1>
            <div class="row center">
            <h5 class="header col s12 light">Belajar Tentang Apa Yang Anda <b>Belum Tahu</b> & Share Tentang Apa Yang <b>Anda Tahu</b></h5>
            </div>
            <br><br>
        </div>
    </div>
    <div class="section white">
        <div class="row container">
          <h2 class="header">Apa Itu {{ env('APP_NAME') }} ?</h2>
          <p class="grey-text text-darken-3 lighten-3">
              Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.
          </p>
        </div>
    </div>
    <div class="parallax-container">
        <div class="parallax"><img class="lazy" data-original="{{ env('BASE_PATH_STORAGE') }}/your-images/parallax/05.png"></div>
    </div>
    <div class="section white">
        <div class="row container">
          <h2 class="header">Hal Apa Yang Anda Bisa Dapat ?</h2>
          <p class="grey-text text-darken-3 lighten-3">
              Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.
          </p>
        </div>
    </div>
    <div class="parallax-container">
        <div class="parallax"><img class="lazy" data-original="{{ env('BASE_PATH_STORAGE') }}/your-images/parallax/02.png"></div>
    </div>
    <div class="section white">
        <div class="row container">
          <h2 class="header">Manfaat Membuat Coding Bagi Anda ?</h2>
          <p class="grey-text text-darken-3 lighten-3">
              Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.
          </p>
          <div class="col s4 m4">
              <div class="card">
                <div class="card-image">
                  <img class="lazy" data-original="{{ env('BASE_PATH_STORAGE') }}/your-images/icons/01.png">
                </div>
              </div>
          </div>
          <div class="col s4 m4">
              <div class="card">
                <div class="card-image">
                  <img class="lazy" data-original="{{ env('BASE_PATH_STORAGE') }}/your-images/icons/02.png">
                </div>
              </div>
          </div>
          <div class="col s4 m4">
              <div class="card">
                <div class="card-image">
                  <img class="lazy" data-original="{{ env('BASE_PATH_STORAGE') }}/your-images/icons/03.png">
                </div>
              </div>
          </div>
        </div>
    </div>
    <div class="parallax-container">
        <div class="parallax"><img class="lazy" data-original="{{ env('BASE_PATH_STORAGE') }}/your-images/parallax/04.jpg"></div>
    </div>
    <div class="section white">
        <div class="row container">
          <h2 class="header">Share Yang Anda Ketahui</h2>
          <p class="grey-text text-darken-3 lighten-3">
              Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.
          </p>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/dist/js/jquery-lazyload/jquery.lazyload.min.js"></script>
    <script src="/dist/js/jquery-lazyload/jquery.scrollstop.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
          _Image.lazy();
          $('.parallax').parallax();
        });
    </script>
@endsection