/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 49);
/******/ })
/************************************************************************/
/******/ ({

/***/ 12:
/***/ (function(module, exports) {

_elm.ready(function () {

    _Image.lazy();

    $('.load-more').click(function () {
        var vm = $(this);
        var _spinner = $('.spinner-layer');
        vm.hide();
        _spinner.show();
        _Http._get(_baseUrl + '/ajax/frontend/article', { page: nextPage }, function (response) {
            if (response.status === 'success') {
                _spinner.hide();
                renderToHtml(response.data.data);
                if (response.data.next_page_url) {
                    nextPage += 1;
                    vm.show();
                }
            }
        });
    });
});

function renderToHtml(articles) {
    articles = articles.chunk(5);
    _template = '';
    $.each(articles, function (key, values) {
        _template += '<div class="row custom-row">';
        _template += buildCardHtml(values);
        _template += '</div>';
    });
    $('.list-article').append(_template);
    _Image.lazy();
}

function buildCardHtml(articles) {
    _childTemplate = '';
    $.each(articles, function (key, value) {
        _childTemplate += buildHeadCard();
        _childTemplate += buildImgCard(value);
        _childTemplate += buildBodyCard(value);
        _childTemplate += buildActionCard(value);
        _childTemplate += buildClosingTagCard();
    });
    return _childTemplate;
}

function buildHeadCard() {
    return '<div class="col s6 m3"><div class="card">';
}

function buildImgCard(article) {
    var urlImg = _baseUrlImgPath + '/article-images/300x300/' + article.image;
    return '<div class="card-image">' + '<img data-original="' + urlImg + '" class="lazy">' + '<span class="card-title custom-orange-color custom-cart-title">' + buildCardLabel(article.label) + '</span>' + '</div>';
}

function buildCardLabel(labels) {
    var tags = '';
    labels = labels.slice(0, 3);
    if (labels.length > 0) {
        $.each(labels, function (key, value) {
            tags += '#' + value + ' ';
        });
    } else {
        tags = '#NoTag';
    }

    return tags;
}

function buildBodyCard(article) {
    return '<div class="card-content custom-card-content">' + '<h6>' + article.title + '</h6>' + '<p>' + strLimit(article.content.replace(/<\/?[^>]+>/gi, ''), 12) + '</p>' + '</div>';
}

function buildActionCard(article) {
    return '<div class="card-action">' + '<a href="' + urlDetailArticle + '/' + article.slug + '" class="custom-orange-text">Learn More..</a>' + '</div>';
}

function buildClosingTagCard() {
    return '</div></div>';
}

function strLimit(text, limit) {
    var wordsToCut = limit;
    var wordsArray = text.split(" ");
    if (wordsArray.length > wordsToCut) {
        var strShort = "";
        for (i = 0; i < wordsToCut; i++) {
            strShort += wordsArray[i] + " ";
        }
        return strShort + "...";
    } else {
        return text;
    }
};

/***/ }),

/***/ 49:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(12);


/***/ })

/******/ });