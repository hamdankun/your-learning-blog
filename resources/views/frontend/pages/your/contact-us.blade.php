@extends('frontend.layouts.main')

@section('content')
    <div class="section no-pad-bot grey lighten-4" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center custom-orange-text">Contact Me</h1>
            <div class="row center">
                <h5 class="header col s12 light">
                    <i class="material-icons large">face</i>
                </h5>
            </div>
            <br><br>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col s12 m12">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <form class="col s12">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="first_name" type="text">
                                        <label for="first_name">Name</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                    <input type="text">
                                    <label for="disabled">Email</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <textarea class="materialize-textarea"></textarea>
                                        <label for="password">Message</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <a class="waves-effect waves-light btn">Button</a>
                                        <a class="waves-effect waves-light btn red">Reset</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/jquery-lazyload/jquery.lazyload.min.js"></script>
    <script src="/js/jquery-lazyload/jquery.scrollstop.min.js"></script>
@endsection