@extends('frontend.layouts.main')

@section('styles')
    <link rel="stylesheet" type="text/css" href="/css/plugins/prism.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/plugins/materialize-social.css">
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
                            <img data-original="{{ env('BASE_PATH_STORAGE') }}/article-images/640x480/{{ $article->image }}" class="lazy">
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
                                <div class="col s12 m12 margin-small">
                                    <div class="divider"></div>
                                </div>
                                <div class="col s12 m1 valign-wrapper sharer-label">
                                    Share
                                </div>
                                <div class="col s12 m11">
                                    <a class="waves-effect waves-light btn-floating social google">
                                    <i class="fa fa-google"></i></a>


                                    <a class="fb-xfbml-parse-ignore waves-effect waves-light btn-floating social facebook" target="_blank" href="https://developers.facebook.com/docs/sharing/reference/share-dialog"><i class="fa fa-facebook"></i></a>

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
                        <li class="tab col s6"><a href="#test1" class="active custom-orange-text">Recent Article</a></li>
                        <li class="tab col s6"><a href="#test2" class="custom-orange-text">Popular Article</a></li>
                      </ul>
                    </div>
                    <div id="test1" class="col s12">
                        <div class="card horizontal custom-card-horizontal">
                          <div class="card-image">
                            <img src="/storage/article-images/100x100/giphy.gif">
                          </div>
                          <div class="card-stacked">
                            <div class="card-content p-15">
                              <p>{!! str_limit('I am a very simple card. I am good at containing small bits of information.', 50, ' <a href="#" class="custom-orange-text">read more....</a>') !!}</p>
                            </div>
                          </div>
                        </div>
                        <div class="card horizontal custom-card-horizontal">
                          <div class="card-image">
                            <img src="/storage/article-images/100x100/giphy.gif">
                          </div>
                          <div class="card-stacked">
                            <div class="card-content p-15">
                              <p>{!! str_limit('I am a very simple card. I am good at containing small bits of information.', 50, ' <a href="#" class="custom-orange-text">read more....</a>') !!}</p>
                            </div>
                          </div>
                        </div>
                        <div class="card horizontal custom-card-horizontal">
                          <div class="card-image">
                            <img src="/storage/article-images/100x100/giphy.gif">
                          </div>
                          <div class="card-stacked">
                            <div class="card-content p-15">
                              <p>{!! str_limit('I am a very simple card. I am good at containing small bits of information.', 50, ' <a href="#" class="custom-orange-text">read more....</a>') !!}</p>
                            </div>
                          </div>
                        </div>
                        <div class="card horizontal custom-card-horizontal">
                          <div class="card-image">
                            <img src="/storage/article-images/100x100/giphy.gif">
                          </div>
                          <div class="card-stacked">
                            <div class="card-content p-15">
                              <p>{!! str_limit('I am a very simple card. I am good at containing small bits of information.', 50, ' <a href="#" class="custom-orange-text">read more....</a>') !!}</p>
                            </div>
                          </div>
                        </div>
                        <div class="card horizontal custom-card-horizontal">
                          <div class="card-image">
                            <img src="/storage/article-images/100x100/giphy.gif">
                          </div>
                          <div class="card-stacked">
                            <div class="card-content p-15">
                              <p>{!! str_limit('I am a very simple card. I am good at containing small bits of information.', 50, ' <a href="#" class="custom-orange-text">read more....</a>') !!}</p>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div id="test2" class="col s12">
                        <div class="card horizontal custom-card-horizontal">
                          <div class="card-image">
                            <img src="/storage/article-images/100x100/giphy.gif">
                          </div>
                          <div class="card-stacked">
                            <div class="card-content p-15">
                              <p>{!! str_limit('I am a very simple card. I am good at containing small bits of information.', 50, ' <a href="#" class="custom-orange-text">read more....</a>') !!}</p>
                            </div>
                          </div>
                        </div>
                        <div class="card horizontal custom-card-horizontal">
                          <div class="card-image">
                            <img src="/storage/article-images/100x100/giphy.gif">
                          </div>
                          <div class="card-stacked">
                            <div class="card-content p-15">
                              <p>{!! str_limit('I am a very simple card. I am good at containing small bits of information.', 50, ' <a href="#" class="custom-orange-text">read more....</a>') !!}</p>
                            </div>
                          </div>
                        </div>
                        <div class="card horizontal custom-card-horizontal">
                          <div class="card-image">
                            <img src="/storage/article-images/100x100/giphy.gif">
                          </div>
                          <div class="card-stacked">
                            <div class="card-content p-15">
                              <p>{!! str_limit('I am a very simple card. I am good at containing small bits of information.', 50, ' <a href="#" class="custom-orange-text">read more....</a>') !!}</p>
                            </div>
                          </div>
                        </div>
                        <div class="card horizontal custom-card-horizontal">
                          <div class="card-image">
                            <img src="/storage/article-images/100x100/giphy.gif">
                          </div>
                          <div class="card-stacked">
                            <div class="card-content p-15">
                              <p>{!! str_limit('I am a very simple card. I am good at containing small bits of information.', 50, ' <a href="#" class="custom-orange-text">read more....</a>') !!}</p>
                            </div>
                          </div>
                        </div>
                        <div class="card horizontal custom-card-horizontal">
                          <div class="card-image">
                            <img src="/storage/article-images/100x100/giphy.gif">
                          </div>
                          <div class="card-stacked">
                            <div class="card-content p-15">
                              <p>{!! str_limit('I am a very simple card. I am good at containing small bits of information.', 50, ' <a href="#" class="custom-orange-text">read more....</a>') !!}</p>
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
                            <a href="#!" class="collection-item">Alvin</a>
                            <a href="#!" class="collection-item active">Alvin</a>
                            <a href="#!" class="collection-item">Alvin</a>
                            <a href="#!" class="collection-item">Alvin</a>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col s12 m12">
                      <ul class="tabs">
                        <li class="tab col s6"><a href="#test1" class="active custom-orange-text">Next/previous</a></li>
                      </ul>
                    </div>
                    <div id="test1" class="col s12">
                        <div class="card horizontal custom-card-horizontal">
                          <div class="card-image">
                            <img src="/storage/article-images/100x100/giphy.gif">
                          </div>
                          <div class="card-stacked">
                            <div class="card-content p-15">
                              <p>{!! str_limit('I am a very simple card. I am good at containing small bits of information.', 50, ' <a href="#" class="custom-orange-text">read more....</a>') !!}</p>
                            </div>
                          </div>
                          <div class="card-image mt-20">
                            <a href="#" class="black-color pt-15"><i class="material-icons medium">chevron_right</i></a>
                          </div>
                        </div>
                        <div class="card horizontal custom-card-horizontal">
                          <div class="card-image mt-20">
                            <a href="#" class="black-color pt-15"><i class="material-icons medium">chevron_left</i></a>
                          </div>
                          <div class="card-stacked">
                            <div class="card-content p-15">
                              <p>{!! str_limit('I am a very simple card. I am good at containing small bits of information.', 50, ' <a href="#" class="custom-orange-text">read more....</a>') !!}</p>
                            </div>
                          </div>
                          <div class="card-image">
                            <img src="/storage/article-images/100x100/giphy.gif">
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <br><br>
    </div>
@endsection

@section('scripts')
    <script src="/js/prism.js"></script>
    <script src="/js/jquery-lazyload/jquery.lazyload.min.js"></script>
    <script src="/js/jquery-lazyload/jquery.scrollstop.min.js"></script>
    <script>
        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.10&appId=1218744614805599";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <script>
        $('.fb-xfbml-parse-ignore').click(function() {
            FB.ui({
              method: 'share',
              display: 'popup',
              href: '{{ url()->current() }}',
            }, function(response){});
        })
    </script>

    <script type="text/javascript">
        _Image.lazy();
    </script>
@endsection