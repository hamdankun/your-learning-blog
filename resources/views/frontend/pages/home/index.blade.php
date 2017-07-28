@extends('frontend.layouts.main')

@section('content')
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center custom-orange-text">Starter Template</h1>
            <div class="row center">
            <h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>
            </div>
            <div class="row center">
            <a href="http://materializecss.com/getting-started.html" id="download-button" class="btn-large waves-effect waves-light custom-orange-color">Get Started</a>
            </div>
            <br><br>

        </div>
    </div>
    <div class="container">
        <div class="section list-article">
            <!--   Icon Section   -->
                @foreach($articles->chunk(5) as $key => $article)
                    <div class="row custom-row">
                        @foreach($article as $key => $article)
                            <div class="col s6 m3">
                                <div class="card">
                                    <div class="card-image">
                                        <img data-original="{{ env('BASE_PATH_STORAGE') }}/article-images/300x300/{{ $article->image }}"
                                        onerror="this.onerror=null;this.src='{{ env('BASE_PATH_STORAGE') }}/article-images/default.png'"
                                        class="lazy">
                                        <span class="card-title custom-orange-color custom-cart-title">{{ build_label($article->label) }}</span>
                                    </div>
                                    <div class="card-content custom-card-content">
                                        <h6>{{ $article->title }}</h6>
                                        <p>
                                            {{ str_limit(strip_tags($article->content), 120) }}
                                        </p>
                                    </div>
                                    <div class="card-action">
                                        <a href="{{ route('frontend.article.show', [$article->slug]) }}" class="custom-orange-text">Learn More..</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
        </div>
        <br><br>
    </div>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <div class="row center">
                <button class="load-more waves-effect waves-light btn custom-orange-color">Load More</button>
                <div class="preloader-wrapper active">
                <div class="spinner-layer spinner-red-only" hidden>
                  <div class="circle-clipper left">
                    <div class="circle"></div>
                  </div><div class="gap-patch">
                    <div class="circle"></div>
                  </div><div class="circle-clipper right">
                    <div class="circle"></div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <br />
    <br />
@endsection

@section('js-var')
    var nextPage = {{ $articles->currentPage() }} + 1;
    var urlDetailArticle = '{{ route('frontend.article.show') }}';
@endsection

@section('scripts')
    <script src="/js/jquery-lazyload/jquery.lazyload.min.js"></script>
    <script src="/js/jquery-lazyload/jquery.scrollstop.min.js"></script>
    <script src="/js/home-frontend.js"></script>
@endsection