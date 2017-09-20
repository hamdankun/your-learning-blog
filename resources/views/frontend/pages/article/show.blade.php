@extends('frontend.layouts.main')

@section('styles')
    <link rel="stylesheet" type="text/css" href="/css/plugins/prism.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/plugins/materialize-social.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/js/jquery-bar-rating/dist/themes/fontawesome-stars-o.css">
@endsection

@section('content')
    <div class="section no-pad-bot margin-top-medium">
        <div class="container">
            <div class="row">
                <div class="col s12 m12">
                    <nav>
                        <div class="nav-wrapper">
                            <div class="col s12 custom-breadcrumb">
                                <a href="{{ route('frontend.root') }}" class="breadcrumb">Home</a>
                                <a href="#!" class="breadcrumb">{{ $article->category->name }}</a>
                                <a href="#!" class="breadcrumb">{{ $article->title }}</a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="section">
            <div class="row">
                <div class="col s12 m8">
                    <div class="card">
                        <div class="card-image">
                            <img data-original="{{ env('BASE_PATH_STORAGE') }}/article-images/640x480/{{ $article->image }}"
                                 class="lazy">
                            <span class="card-title custom-orange-color custom-cart-title">
                                <h5>{{ $article->title }}</h5>
                            </span>
                        </div>
                        <div class="card-content">
                            {!! $article->content !!}
                        </div>
                        <div class="card-action">
                            <div class="row">
                                <div class="col s12 m1">
                                    Tags
                                </div>
                                <div class="col s12 m11">
                                    {!! build_label($article->label, true, '<div class="chip">:name</div>') !!}
                                </div>
                                <div class="col s12 m12 margin-small">
                                    <div class="divider"></div>
                                </div>
                                <div class="col s12 m1">
                                    Author
                                </div>
                                <div class="col s12 m11">
                                    : {{ $article->user ? $article->user->name : 'admin' }}
                                </div>
                                <!-- <div class="col s12 m12 margin-small">
                                    <div class="divider"></div>
                                </div> -->
                                <!-- <div class="col s12 m1">
                                    Ratting
                                </div>
                                <div class="col s12 m11">
                                    <select id="ratting">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div> -->
                                <div class="col s12 m12 margin-small">
                                    <div class="divider"></div>
                                </div>
                                <div class="col s12 m1 valign-wrapper sharer-label">
                                    Share
                                </div>
                                <div class="col s12 m11">
                                    <a class="waves-effect waves-light btn-floating social google">
                                        <i class="fa fa-google"></i></a>


                                    <a class="fb-xfbml-parse-ignore waves-effect waves-light btn-floating social facebook"
                                       target="_blank"
                                       href="https://developers.facebook.com/docs/sharing/reference/share-dialog"><i
                                                class="fa fa-facebook"></i></a>

                                    <a class="waves-effect waves-light btn-floating social twitter">
                                        <i class="fa fa-twitter"></i></a>
                                </div>
                            </div>
                            <!-- share to link here -->
                        </div>
                    </div>
                </div>
                <div class="col s12 m4">
                    <nav>
                        <div class="nav-wrapper">
                            <a href="#!" class="brand-logo">Side Menu</a>
                        </div>
                    </nav>
                    <div class="row">
                        <div class="col s12 m12">
                            <ul class="tabs">
                                <li class="tab col s6"><a href="#recentArticle" class="active custom-orange-text">Recent
                                        Article</a></li>
                                <li class="tab col s6"><a href="#popularArticle" class="custom-orange-text popular-article">Popular Article</a>
                                </li>
                            </ul>
                        </div>
                        <div id="recentArticle" class="col s12">
                            @foreach($recentArticle as $key => $article)
                                <div class="card horizontal custom-card-horizontal">
                                    <div class="card-image">
                                        <img data-original="/storage/article-images/100x100/{{ $article->image  }}" class="lazy img-related">
                                    </div>
                                    <div class="card-stacked">
                                        <div class="card-content p-15">
                                            <p><a href="{{ route('frontend.article.show', [$article->category->slug, $article->slug]) }}" class="text-black">{{ $article->title }}</a></p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div id="popularArticle" class="col s12 center">
                            <div class="preloader-wrapper active margin-top-medium spinner-popular-article">
                                <div class="spinner-layer spinner-red-only">
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
                    <div class="row">
                        <div class="col s12 m12">
                            <ul class="tabs">
                                <li class="tab col s6"><a href="#test1" class="active custom-orange-text">Label</a></li>
                            </ul>
                        </div>
                        <div id="test1" class="col s12">
                            <div class="collection">
                                @foreach($labels as $key => $label)
                                    <a href="#!" class="collection-item custom-orange-text">{{ $label  }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12">
                            <ul class="tabs">
                                <li class="tab col s6">
                                    <a href="#test1" class="active custom-orange-text">Next/previous</a>
                                </li>
                            </ul>
                        </div>
                        <div id="test1" class="col s12">
                            @if($relatedArticle['next'])
                                <div class="card horizontal custom-card-horizontal">
                                    <div class="card-image">
                                        <img data-original="/storage/article-images/100x100/{{ $relatedArticle['next']->image }}" class="lazy img-related">
                                    </div>
                                    <div class="card-stacked">
                                        <div class="card-content p-15">
                                            <p>{{ $relatedArticle['next']->title }}</p>
                                        </div>
                                    </div>
                                    <div class="card-image mt-20">
                                        <a href="{{ route('frontend.article.show', [$relatedArticle['next']->category->slug, $relatedArticle['next']->slug]) }}" class="black-color pt-15"><i
                                                    class="material-icons medium">chevron_right</i></a>
                                    </div>
                                </div>
                            @endif
                            @if($relatedArticle['prev'])
                                <div class="card horizontal custom-card-horizontal">
                                    <div class="card-image mt-20">
                                        <a href="{{ route('frontend.article.show', [$relatedArticle['prev']->category->slug, $relatedArticle['prev']->slug]) }}" class="black-color pt-15"><i
                                                    class="material-icons medium">chevron_left</i></a>
                                    </div>
                                    <div class="card-stacked">
                                        <div class="card-content p-15 text-right">
                                            <p>{{ $relatedArticle['prev']->title }}</p>
                                        </div>
                                    </div>
                                    <div class="card-image">
                                        <img data-original="/storage/article-images/100x100/{{ $relatedArticle['prev']->image }}" class="lazy img-related">
                                    </div>

                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </div>
@endsection

@section('js-var')
    var currentUrl = '{{ url()->current() }}';
    var urlDetailArticle = '{{ route('frontend.article.show', [':category', ':article']) }}';
@endsection

@section('scripts')
    <script src="/js/prism.js"></script>
    <script src="/js/jquery-lazyload/jquery.lazyload.min.js"></script>
    <script src="/js/jquery-lazyload/jquery.scrollstop.min.js"></script>
    <script src="/js/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
    <script src="/js/article-detail.js"></script>
@endsection