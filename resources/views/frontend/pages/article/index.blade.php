@extends('frontend.layouts.main')

@section('content')
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
            <div class="section">
                <div class="row">
                    <form class="col s12 m5 right article-filter">
                      <div class="row">
                        <div class="input-field col s8 m8">
                          <input id="first_name" maxlength="100" type="text" value="{{ $q ? $q . ' ' : '' }}" class="validate autocomplete" >
                          <label for="search">Search Article On This Category</label>
                        </div>
                        <div class="input-field col s4 m4">
                            <select name="sortby" class="sort-by">
                                <option value="">Sort By</option>
                                <option {{ $sortBy === 'popular' ? 'selected': ''  }} value="popular">Popular</option>
                                <option {{ $sortBy === 'recent' ? 'selected': ''  }} value="recent">Recent</option>
                                <option {{ $sortBy === 'old' ? 'selected': ''  }} value="old">Old</option>
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
    var _urlAutoComplete = '{{ route('frontend.ajax.article.search') }}' + '?category=' + _slugCategory;
    var _q = '{{ $q }}';
    var _sortBy = '{{ $sortBy }}';
@endsection

@section('scripts')
    <script src="{{ env('DIST_PATH') }}/js/jquery-lazyload/jquery.lazyload.min.js"></script>
    <script src="{{ env('DIST_PATH') }}/js/jquery-lazyload/jquery.scrollstop.min.js"></script>
    <script src="{{ env('DIST_PATH') }}/js/materialize-pagination.min.js"></script>
    <script src="{{ env('DIST_PATH') }}/js/jquery.autocomplete.min.js"></script>
    <script src="{{ env('DIST_PATH') . mix('/js/article-factory.js') }}"></script>
    <script src="{{ env('DIST_PATH') . mix('/js/article-frontend.js') }}"></script>
@endsection