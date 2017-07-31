_elm.ready(function() {

    _Image.lazy();

    $('#pagination').materializePagination({
        align: 'center',
        lastPage:  _paginator.lastPage,
        firstPage:  1,
        urlParameter: 'page',
        useUrlParameter: true,
        onClickCallback: function(requestedPage){
            _Loader.show();
            getArticle(requestedPage, _q);
        }
    });

    $('select').material_select();

    $(".autocomplete").devbridgeAutocomplete({
        serviceUrl: _urlAutoComplete,
        type: 'GET',
        onSelect: function (suggestion) {
            search(1, suggestion.value);
        },
        showNoSuggestionNotice: true,
        noSuggestionNotice: 'Sorry, no matching results',
    });

    $('.autocomplete').on('keyup', function (e) {
        if (e.keyCode == 13) {
            search(1, $(this).val());
        }
    });
});

function search(page, value) {
    _Loader.show();
    window.location.href = _baseUrl + window.location.pathname + '?q=' + value;
}

function getArticle(requestedPage, query) {
    _Http._get(_baseUrl+'/ajax/frontend/article/' + _slugCategory, {page: requestedPage, query: query}, function(response) {

        if (response.status === 'success') {
            _ArticleFactory.renderToHtml(response.data.data, true);

            if (!_firstLoad) {
                _Scroll.to($('.list-article'));
            } else {
                _firstLoad = false;
            }
        }

        _Loader.hide();
    }, function(error) {
        _Loader.hide();
    });
}

