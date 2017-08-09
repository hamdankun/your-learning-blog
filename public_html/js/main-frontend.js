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
/******/ 	return __webpack_require__(__webpack_require__.s = 56);
/******/ })
/************************************************************************/
/******/ ({

/***/ 16:
/***/ (function(module, exports) {

_Loader = function ($) {
    var _loaderWraper = $('#loader-wrapper');
    show = function show() {
        load(true);
    };

    hide = function hide() {
        load(false);
    };

    load = function load(show) {
        if (show) {
            _loaderWraper.fadeIn();
        } else {
            _loaderWraper.fadeOut();
        }
    };

    return {
        show: show,
        hide: hide,
        load: load
    };
}(jQuery);

_Image = function ($) {
    onError = function onError() {};

    lazy = function lazy() {
        $("img.lazy").lazyload({
            threshold: 200,
            placeholder: _baseUrlImgPath + '/article-images/default.png'
        });
    };

    return {
        onError: onError,
        lazy: lazy
    };
}(jQuery);

_elm = $(document);

_elm.ready(function () {
    $('.button-collapse').sideNav();

    $(".dropdown-button").dropdown();

    _Loader.hide();

    $('.button-collapse').click(function () {
        $('#sidenav-overlay').css({ 'z-index': 0 });
    });

    $('.category-link a').click(function () {
        vm = $(this);
        _Loader.show();
        setTimeout(function () {
            window.location.href = vm.attr('href');
        }, 500);
    });
});

// service ajax
_Http = function () {
    resolve = function resolve(url, method, data, onSuccess, onError, dataType) {

        _method = method;

        if ($.inArray(method, ['PUT', 'DELETE']) >= 0) {
            method = 'POST';
        }

        if (method === 'POST') {
            data['_token'] = $('meta[name="csrf-token"]').attr('content');
            data['_method'] = _method;
        }

        $.ajax({
            type: method,
            url: url,
            dataType: dataType === undefined ? 'json' : dataType,
            data: data,
            success: onSuccess,
            error: onError
        });
    };

    _get = function _get(url, parameters, onSuccess, onError, dataType) {
        return resolve(url, 'GET', parameters, onSuccess, onError, dataType);
    };

    _post = function _post(url, data, onSuccess, onError, dataType) {
        return resolve(url, 'POST', data, onSuccess, onError, dataType);
    };

    _put = function _put(url, data, onSuccess, onError, dataType) {
        return resolve(url, 'PUT', data, onSuccess, onError, dataType);
    };

    _delete = function _delete(url, parameters, onSuccess, onError, dataType) {
        return resolve(url, 'DELETE', parameters, onSuccess, onError, dataType);
    };

    return {
        resolve: resolve,
        _get: _get,
        _post: _post,
        _put: _put,
        _delete: _delete
    };
}();

_Scroll = function ($) {

    to = function to(selector, duration) {

        if (!duration) {
            duration = 1000;
        }

        $('html, body').animate({
            scrollTop: selector.offset().top
        }, duration);
    };

    return {
        to: to
    };
}(jQuery);

Object.defineProperty(Array.prototype, 'chunk', {
    value: function value(chunkSize) {
        return this.reduce(function (previous, current) {
            var chunk;
            if (previous.length === 0 || previous[previous.length - 1].length === chunkSize) {
                chunk = [];
                previous.push(chunk);
            } else {
                chunk = previous[previous.length - 1];
            }
            chunk.push(current);
            return previous;
        }, []);
    }
});

/***/ }),

/***/ 56:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(16);


/***/ })

/******/ });