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
/******/ 	return __webpack_require__(__webpack_require__.s = 52);
/******/ })
/************************************************************************/
/******/ ({

/***/ 12:
/***/ (function(module, exports) {

var _spinnerPopular = $('.spinner-popular-article');
var _popularArticleElm = $('#popularArticle');
var _loadedPopular = false;
(function (d, s, id) {
    var js,
        fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.10&appId=1218744614805599";
    fjs.parentNode.insertBefore(js, fjs);
})(document, 'script', 'facebook-jssdk');

$('.fb-xfbml-parse-ignore').click(function () {
    FB.ui({
        method: 'share',
        display: 'popup',
        href: currentUrl
    }, function (response) {});
});

_Image.lazy();

_elm.ready(function () {
    $('.popular-article').click(function () {
        getPopularArticle();
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

/***/ }),

/***/ 52:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(12);


/***/ })

/******/ });