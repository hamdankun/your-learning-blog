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
            _Http._get(_baseUrl+'/ajax/frontend/article/' + _slugCategory, {page: requestedPage}, function(response) {

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
    });

    $('select').material_select();

    $(".autocomplete").devbridgeAutocomplete({
        serviceUrl: _urlAutoComplete,
        type: 'GET',
        onSelect: function (suggestion) {
            console.log(suggestion);
        },
        showNoSuggestionNotice: true,
        noSuggestionNotice: 'Sorry, no matching results',
    });
});

