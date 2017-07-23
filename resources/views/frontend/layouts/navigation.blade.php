<div class="navbar-fixed">
    <nav class="light-red lighten-1 custom-nav {{ $current_route !== 'frontend.root' ? 'nav-extended' : '' }}" role="navigation">
        <div class="nav-wrapper container">
        <a id="logo-container" href="{{ route('frontend.root') }}" class="brand-logo">Your Learning</a>

            <ul class="right hide-on-med-and-down">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Article</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Site Map</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">About Us</a></li>
            </ul>

            <ul id="nav-mobile" class="side-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Article</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Site Map</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">About Us</a></li>
            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        </div>
        @if($current_route !== 'frontend.root')
            <div class="nav-content">
              <ul class="tabs tabs-transparent">
                <li class="tab"><a href="#">All</a></li>
                <li class="tab"><a href="#">PHP</a></li>
                <li class="tab"><a href="#">CSS</a></li>
                <li class="tab"><a href="#">Javascript</a></li>
                <li class="tab"><a href="#">Linux</a></li>
              </ul>
            </div>
        @endif
    </nav>
</div>