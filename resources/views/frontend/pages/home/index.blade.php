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
    <div class="section">
        <!--   Icon Section   -->
        
            @foreach($articles->chunk(5) as $key => $article)
                <div class="row">
                    @foreach($article as $key => $article)
                        <div class="col s6 m3">
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
                    @endforeach
                </div>    
            @endforeach
    </div>
    <br><br>
</div>
@endsection