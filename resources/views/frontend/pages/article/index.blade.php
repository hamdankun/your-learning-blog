@extends('frontend.layouts.main')

@section('content')
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
            <div class="section">
                <div class="row">
                    <form class="col s4 right">
                      <div class="row">
                        <div class="input-field col s8">
                          <input id="first_name" maxlength="100" type="text" class="validate autocomplete">
                          <label for="first_name">Search Article</label>
                        </div>
                        <div class="input-field col s4">
                            <select>
                                <option value="">Sort By</option>
                                <option value="1">Popular Article</option>
                                <option value="2">New Article</option>
                                <option value="3">Old Article</option>
                            </select>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="section list-article"></div>
        <br><br>
    </div>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <div class="row center">
                <div id="pagination"></div>
            </div>
        </div>
    </div>
    <br />
    <br />
@endsection

@section('js-var')
    var nextPage = {{ $articles->currentPage() }} + 1;
    var urlDetailArticle = '{{ route('frontend.article.show', [':category', ':article']) }}';
    var _paginator = {
        lastPage : {{ $articles->lastPage() }}
    }
    var _firstLoad = true;
    var _slugCategory = '{{ $active_category }}';
    var _urlAutoComplete = '{{ route('frontend.ajax.article.search') }}';
@endsection

@section('scripts')
    <script src="/js/jquery-lazyload/jquery.lazyload.min.js"></script>
    <script src="/js/jquery-lazyload/jquery.scrollstop.min.js"></script>
    <script src="/js/materialize-pagination.min.js"></script>
    <script src="/js/jquery.autocomplete.min.js"></script>
    <script src="{{ mix('/js/article-factory.js') }}"></script>
    <script src="{{ mix('/js/article-frontend.js') }}"></script>
@endsection