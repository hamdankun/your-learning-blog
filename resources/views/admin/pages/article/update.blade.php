@extends('admin.layouts.main')

@section('styles')
    <link href="/js/selectize/dist/css/selectize.bootstrap3.css" rel="stylesheet">
@endsection

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Artile Update</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @if($article)
                    <form action="{{ route('admin.article.update', $article->id) }}" method="POST" class="form-horizontal disabled-when-submit">
                        {{ method_field('PUT') }}
                        @include('admin.pages.article.form')
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js-var')

@endsection

@section('scripts')
    <script src="/js/tinymce/js/tinymce/tinymce.min.js"></script>
    <script src="/js/selectize/dist/js/standalone/selectize.min.js"></script>
    <script src="/dist/js/sb-admin-2.js"></script>
    <script>

        $(document).ready(function() {
            tinymce.init({
                selector:'textarea',
                height: 800,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table contextmenu paste code'
                ],
                toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright',
            });
            $('#category').selectize();
            $('#label').selectize({
                create: function(input) {
                    return {
                        value: input,
                        text: input
                    }
                }
            })
        });
    </script>
@endsection