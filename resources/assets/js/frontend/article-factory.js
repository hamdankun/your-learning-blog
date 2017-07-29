_ArticleFactory = (function($) {

    renderToHtml = function renderToHtml(articles, removeExisting) {
        articles = articles.chunk(5);
        _template = '';

        $.each(articles, function(key, values) {
            _template += '<div class="row custom-row">';
            _template += buildCardHtml(values);
            _template += '</div>';
        });

        _elm = $('.list-article');

        if (!removeExisting) {
            _elm.append(_template);
        } else {
            _elm.html(_template);
        }

        _Image.lazy();
    }

    buildCardHtml = function buildCardHtml(articles) {
        _childTemplate = '';
        $.each(articles, function(key, value) {
            _childTemplate += buildHeadCard();
            _childTemplate += buildImgCard(value);
            _childTemplate += buildBodyCard(value);
            _childTemplate += buildActionCard(value);
            _childTemplate += buildClosingTagCard();
        });
        return _childTemplate;

    }

    buildHeadCard = function buildHeadCard() {
        return '<div class="col s6 m3"><div class="card">';
    }

    buildImgCard = function buildImgCard(article) {
        var urlImg = _baseUrlImgPath + '/article-images/300x300/' + article.image;
        return '<div class="card-image">'
            +'<img data-original="' + urlImg + '" class="lazy">'
                +'<span class="card-title custom-orange-color custom-cart-title">'
                    + buildCardLabel(article.label)
                +'</span>'
            +'</div>';
    }

    buildCardLabel = function buildCardLabel(labels) {
        var tags = '';
        labels = labels.slice(0, 3);
        if (labels.length > 0) {
            $.each(labels, function(key, value) {
                tags += '#'+ value +' ';
            })
        } else {
            tags = '#NoTag';
        }

        return tags;
    }

    buildBodyCard = function buildBodyCard(article) {
        return '<div class="card-content custom-card-content">'
            +'<h6>' + article.title + '</h6>'
            +'<p>'
                + strLimit(article.content.replace(/<\/?[^>]+>/gi, ''), 12)
            +'</p>'
        +'</div>'
    }

    buildActionCard = function buildActionCard(article) {
        return '<div class="card-action">'
            +'<a href="' + urlDetailArticle.replace(':category', article.category_slug).replace(':article', article.article_slug) + '" class="custom-orange-text">Learn More..</a>'
        +'</div>';
    }

    buildClosingTagCard = function buildClosingTagCard() {
        return '</div></div>';
    }

    strLimit = function strLimit(text, limit){
      var wordsToCut = limit;
      var wordsArray = text.split(" ");
      if(wordsArray.length>wordsToCut){
          var strShort = "";
          for(i = 0; i < wordsToCut; i++){
              strShort += wordsArray[i] + " ";
          }
          return strShort+"...";
      }else{
          return text;
      }
    };

    return {
        renderToHtml: renderToHtml,
        strLimit: strLimit
    }

})(jQuery);