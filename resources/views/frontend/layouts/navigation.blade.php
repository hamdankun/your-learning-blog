@php
    $navbarFixed = isset($current_route) && $current_route !== 'frontend.root' ? '' : 'navbar-fixed'
@endphp
<div class="{{ $navbarFixed }}">
    <nav class="light-red lighten-1 custom-nav {{ isset($current_route) && $current_route !== 'frontend.root' ? 'nav-extended' : '' }}" role="navigation">
        <div class="nav-wrapper container">
        <a id="logo-container" href="{{ route('frontend.root') }}" class="brand-logo">Your Learning</a>

            <ul class="right hide-on-med-and-down">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="{{ route('frontend.article.index', ['all']) }}">Article</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Site Map</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">About Us</a></li>
            </ul>

            <ul id="nav-mobile" class="side-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="{{ route('frontend.article.index', ['all']) }}">Article</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Site Map</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">About Us</a></li>
            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        </div>
        @if(isset($current_route) && $current_route !== 'frontend.root')
            <div class="nav-content">
                  <ul class="tabs tabs-transparent">
                      @foreach($categories as $key => $category)
                            @if ($key === 0)
                                <li class="tab category-link">
                                    <a href="{{ route('frontend.article.index', ['all']) }}"
                                    class="{{ $active_category === 'all' ? 'active' : '' }}">all</a>
                                </li>
                            @endif

                            <li class="tab category-link">
                                <a href="{{ route('frontend.article.index', [$category->slug]) }}"
                                class="{{ $active_category === $category->slug ? 'active' : '' }}">{{ $category->name }}</a>
                            </li>
                      @endforeach
                  </ul>
            </div>
        @endif
    </nav>
</div>