_elm.ready(function() {

    _Image.lazy();

    $('.load-more').click(function() {
        var vm = $(this);
        var _spinner = $('.spinner-layer');
        vm.hide();
        _spinner.show();
        _Http._get(_baseUrl+'/ajax/frontend/article', {page: nextPage}, function(response) {
            if (response.status === 'success') {
                _spinner.hide();
                _ArticleFactory.renderToHtml(response.data.data);
                if (response.data.next_page_url) {
                    nextPage += 1;
                    vm.show();
                }
            }
        });
    });
});
