<!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
        
      <meta http-equiv="X-UA-Compatible" content="IE=edge">  
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>  
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="/materialize/css/materialize.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="{{ mix('/css/custom.css') }}"/>

      @yield('styles')
    </head>
    
    <script>
        @yield('js-var')
    </script>

    <body>
      @include('frontend.layouts.navigation')

      @yield('content')
      
      <footer class="page-footer orange custom-footer">
        <div class="container">
          <div class="row">
            <div class="col l6 s12">
              <h5 class="white-text">Company Bio</h5>
              <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


            </div>
            <div class="col l3 s12">
              <h5 class="white-text">Settings</h5>
              <ul>
                <li><a class="white-text" href="#!">Link 1</a></li>
                <li><a class="white-text" href="#!">Link 2</a></li>
                <li><a class="white-text" href="#!">Link 3</a></li>
                <li><a class="white-text" href="#!">Link 4</a></li>
              </ul>
            </div>
            <div class="col l3 s12">
              <h5 class="white-text">Connect</h5>
              <ul>
                <li><a class="white-text" href="#!">Link 1</a></li>
                <li><a class="white-text" href="#!">Link 2</a></li>
                <li><a class="white-text" href="#!">Link 3</a></li>
                <li><a class="white-text" href="#!">Link 4</a></li>
              </ul>
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
      <script type="text/javascript" src="/vendor/jquery/jquery.min.js"></script>
      <script type="text/javascript" src="/materialize/js/materialize.min.js"></script>
      <script type="text/javascript" src="{{ mix('/js/main-frontend.js') }}"></script>
      @yield('scripts')
    </body>
  </html>