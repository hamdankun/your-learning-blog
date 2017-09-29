<!DOCTYPE html>
  <html lang="id">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      {!! SEO::generate() !!} <!-- true for minified -->

      <meta name="geo.position" content="-6.9034443; 107.5729458">
      <meta name="geo.placename" content="bandung">
      <meta name="geo.region" content="west java">

      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="/dist/materialize/css/materialize.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="{{ '/dist' . mix('/css/custom.css') }}"/>

      @yield('styles')
    </head>

    <script>
        @yield('js-var')
        var _baseUrlImgPath = '{{ env('BASE_PATH_STORAGE') }}';
        var _baseUrl = '{{ url('/') }}';
    </script>

    <body>
      @include('frontend.layouts.navigation')

      @yield('content')

      <footer class="page-footer orange custom-footer">
        <div class="container">
          <div class="row">
            <div class="col l5 s12">
              <h5 class="white-text">Blog Bio</h5>
              <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


            </div>
            <div class="col l3 s12">
              <h5 class="white-text">Web Tools</h5>
              <ul>
                <li><a class="white-text" href="#">Home</a></li>
                <li><a class="white-text" href="#">Blog</a></li>
                <li><a class="white-text" href="#">Privacy Policy</a></li>
                <li><a class="white-text" href="#">Site Map</a></li>
                <li><a class="white-text" href="#">Contact Us</a></li>
                <li><a class="white-text" href="#">About Us</a></li>
              </ul>
            </div>
            <div class="col l4 s12">
              <h5 class="white-text">Newsletter</h5>
              <div class="row">
                <div class="col s12 m12">
                  <p class="grey-text text-lighten-4">Let's get more info with subscribe this blog via email</p>
                </div>
                <div class="input-field col s12 m8">
                  <input id="first_name2" type="text" class="validate">
                  <label class="active" for="first_name2">Email Address</label>
                </div>
                <div class="input-field col s12 m3  padding-x-small">
                  <button class="waves-effect waves-light btn custom-orange-color">Submit</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="footer-copyright">
          <div class="container">
          Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
          </div>
        </div>
      </footer>
      <div id="loader-wrapper">
        <div id="loader"></div>
      </div>
      <!--Import jQuery before materialize.js-->
      <!-- jQuery -->
      <script type="text/javascript" src="/dist/vendor/jquery/jquery.min.js"></script>
      <script type="text/javascript" src="/dist/materialize/js/materialize.min.js"></script>
      <script type="text/javascript" src="{{ '/dist' . mix('/js/main-frontend.js') }}"></script>
      @yield('scripts')
    </body>
  </html>