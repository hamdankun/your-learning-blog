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
                            <form class="col s12" method="POST" action="{{ route('frontend.your.contact-us-post') }}">
                                <div class="row">
                                    {{ csrf_field() }}
                                    <div class="input-field col s12">
                                        <input id="name" autocomplete="off" type="text" name="name" required>
                                        <label for="name">Nama</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                    <input type="text" autocomplete="off" name="email" required>
                                    <label for="disabled">Email</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <textarea name="message" autocomplete="off" class="materialize-textarea" required></textarea>
                                        <label for="password">Pesan</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button type="submit" class="waves-effect waves-light btn">Kirim</button>
                                        <button type="reset" class="waves-effect waves-light btn red">Ulangi</button>
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
    <script type="text/javascript">
        @if(session()->has('notification.type'))
            Materialize.toast('{{ session()->get('notification.message') }}', 5000);
        @endif                
    </script>
@endsection