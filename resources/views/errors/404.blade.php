@extends('frontend.layouts.main')

@section('content')
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
                <div class="row center">
                    <h4 class="header col s12 light">
                        <i class="material-icons large">warning</i> <br />
                        Sorry Your Access Page Is Not Found :(
                    </h4>
                </div>
            <div class="row center">
                <a href="{{ route('frontend.root') }}" id="download-button" class="btn-large waves-effect waves-light custom-orange-color">Back To Home</a>
                </div>
            <br><br>
        </div>
    </div>
@endsection