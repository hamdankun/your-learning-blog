var _spinnerPopular = $('.spinner-popular-article');
var _popularArticleElm = $('#popularArticle');
var _loadedPopular = false;
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.10&appId=1218744614805599";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

$('.fb-xfbml-parse-ignore').click(function () {
    FB.ui({
        method: 'share',
        display: 'popup',
        href: currentUrl,
    }, function (response) {
    });
});

_Image.lazy();

_elm.ready(function() {
   $('.popular-article').click(function() {
    getPopularArticle();
   });

    $('#ratting').barrating({
        theme: 'fontawesome-stars-o',
        initialRating: 4.5,
        readonly: true
    });
});

function getPopularArticle() {
    if (_loadedPopular) return false;
    _popularArticleElm.html('');
    _spinnerPopular.show();
    _Http._get(_baseUrl + '/ajax/frontend/popular-article', {}, function (response) {
        if (response.status === 'success') {
            _popularArticleContent = '';
            $.each(response.data, function (key, val) {
                _popularArticleContent += '<div class="card horizontal custom-card-horizontal">';
                _popularArticleContent += '<div class="card-image">';
                    _popularArticleContent += '<img data-original="' + _baseUrlImgPath + '/article-images/100x100/' + val.image + '" class="lazy img-related">';
                _popularArticleContent += '</div>';
                _popularArticleContent += '<div class="card-stacked">';
                         _popularArticleContent += '<div class="card-content p-15">';
                            _popularArticleContent += '<p class="left-align"><a href="' + urlDetailArticle.replace(':category', val.category_slug).replace(':article', val.article_slug) + '" class="text-black">' + val.title + '</a></p>';
                        _popularArticleContent += '</div>';
                    _popularArticleContent += '</div>';
                _popularArticleContent += '</div>';
            });
            _loadedPopular = true;
            _popularArticleElm.append(_popularArticleContent);
            setFalseLoadedPopular();

            _Image.lazy();
            _spinnerPopular.hide();
        }

    }, function (error) {
        _spinnerPopular.hide();
    });
}

function setFalseLoadedPopular() {
    setTimeout(function () {
        _loadedPopular = false;
    }, 1000 * 300);
}