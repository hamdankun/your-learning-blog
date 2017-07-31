@php
    $navbarFixed = isset($current_route) && $current_route !== 'frontend.root' ? '' : 'navbar-fixed';
    $current_route = isset($current_route) ? $current_route : '';
    $categories = isset($categories) ? $categories : [];
@endphp
<div class="{{ $navbarFixed }}">
    <nav class="light-red lighten-1 custom-nav {{ isset($current_route) && $current_route !== 'frontend.root' ? 'nav-extended' : '' }}" role="navigation">
        <div class="nav-wrapper container">
        <a id="logo-container" href="{{ route('frontend.root') }}" class="brand-logo">Your Learning</a>
            <ul class="right hide-on-med-and-down">
                <li class="{{ is_active($current_route, 'frontend.root') }}"><a href="{{ route('frontend.root') }}">Home</a></li>
                <li class="{{ is_active($current_route, 'frontend.article.index') }}"><a href="{{ route('frontend.article.index', ['all']) }}">Article</a></li>
                <li class="{{ is_active($current_route, 'frontend.your.site-map') }}"><a href="#">Site Map</a></li>
                <li class="{{ is_active($current_route, 'frontend.your.privacy-policy') }}"><a href="#">Privacy Policy</a></li>
                <li class="{{ is_active($current_route, 'frontend.your.contact-us') }}"><a href="#">Contact Us</a></li>
                <li class="{{ is_active($current_route, 'frontend.your.about-us') }}"><a href="{{ route('frontend.your.about-us') }}">About Us</a></li>
            </ul>

            <ul id="nav-mobile" class="side-nav">
                <li class="{{ is_active($current_route, 'frontend.root') }}">><a href="{{ route('frontend.root') }}">Home</a></li>
                <li class="{{ is_active($current_route, 'frontend.article.index') }}"><a href="{{ route('frontend.article.index', ['all']) }}">Article</a></li>
                <li class="{{ is_active($current_route, 'frontend.your.site-map') }}"><a href="#">Site Map</a></li>
                <li class="{{ is_active($current_route, 'frontend.your.privacy-policy') }}"><a href="#">Privacy Policy</a></li>
                <li class="{{ is_active($current_route, 'frontend.your.contact-us') }}"><a href="#">Contact Us</a></li>
                <li class="{{ is_active($current_route, 'frontend.your.about-us') }}"><a href="{{ route('frontend.your.about-us') }}">About Us</a></li>
            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        </div>
        @if(isset($current_route) && $current_route === 'frontend.article.index')
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