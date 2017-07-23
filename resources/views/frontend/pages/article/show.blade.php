@extends('frontend.layouts.main')

@section('content')
    <div class="section no-pad-bot margin-top-medium">
        <div class="container">
            <div class="row">
                <div class="col s12 m12">
                    <nav>
                        <div class="nav-wrapper">
                            <div class="col s12 custom-breadcrumb">
                                <a href="{{ route('frontend.root') }}" class="breadcrumb">Home</a>
                                <a href="#!" class="breadcrumb">Article</a>
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
                <div class="col s8 m8">
                    <div class="card">
                        <div class="card-image">
                            <img src="/storage/article-images/sample-image-thumbnail.png">
                            <span class="card-title custom-orange-color custom-cart-title">{{ build_label($article->label) }}</span>
                        </div>
                        <div class="card-content">
                            <h6>{{ $article->title }}</h6>
                            <p>
                                {!! $article->content !!}
                            </p>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('frontend.article.show', [$article->slug]) }}" class="custom-orange-text">Learn More..</a>
                        </div>
                    </div>
                </div>
                <div class="col s4 m4">
                    <div class="card">
                        <div class="card-image">
                            <img src="/storage/article-images/sample-image-thumbnail.png">
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
            </div>
        </div>
        <br><br>
    </div>
@endsection