_elm.ready(function () {

    _Image.lazy();

    $('#pagination').materializePagination({
        align: 'center',
        lastPage: _paginator.lastPage,
        firstPage: 1,
        urlParameter: 'page',
        useUrlParameter: true,
        onClickCallback: function (requestedPage) {
            _Loader.show();
            getArticle(requestedPage, _q, _sortBy);
        }
    });


    $('select').material_select();

    $(".autocomplete").devbridgeAutocomplete({
        serviceUrl: _urlAutoComplete,
        type: 'GET',
        onSelect: function (suggestion) {
            search(1, suggestion.value, 'default');
        },
        showNoSuggestionNotice: true,
        noSuggestionNotice: 'Sorry, no matching results',
    });

    $('.autocomplete').on('keyup', function (e) {
        if (e.keyCode == 13) {
            search(1, $(this).val(), 'default');
        }
    });

    $(".sort-by").on('change', function () {
        var vm = $(this);
        if (vm.val() !== '') {
            search(1, _q, vm.val());
        }
    });
});

function search(page, value, sortBy) {
    _Loader.show();
    window.location.href = _baseUrl + window.location.pathname + '?q=' + value + '&sortby=' + sortBy;
}

function getArticle(requestedPage, query, sortBy) {
    _Http._get(_baseUrl + '/ajax/frontend/article/' + _slugCategory, {
        page: requestedPage,
        query: query,
        sortby: sortBy
    }, function (response) {

        if (response.status === 'success') {
            _ArticleFactory.renderToHtml(response.data.data, true);

            if (!_firstLoad) {
                _Scroll.to($('.list-article'));
            } else {
                _firstLoad = false;
            }
        }

        _Loader.hide();
    }, function (error) {
        _Loader.hide();
    });
}

