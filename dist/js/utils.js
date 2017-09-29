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
/******/ 	return __webpack_require__(__webpack_require__.s = 60);
/******/ })
/************************************************************************/
/******/ ({

/***/ 19:
/***/ (function(module, exports) {

_BtnDatatable = function ($, prefixUrl) {
    create = function create(id) {
        var _button = '<a href="' + prefixUrl + '/' + id + '/edit" class="btn btn-primary btn-sm dt-edit"><i class="fa fa-edit"></i> Edit</a>&nbsp;';
        _button += '<a href="' + prefixUrl + '/' + id + '" class="btn btn-danger btn-sm dt-delete"> <i class="fa fa-trash"></i> Delete</a>';
        _button += '<form action="' + prefixUrl + '/' + id + '" method="POST" class="action-delete">' + _methodFieldDelete + '' + _csrfToken + '</form>';
        return _button;
    };

    return {
        create: create
    };
}(jQuery, typeof _prefixUrl !== 'undefined' ? _prefixUrl : '');

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

_Dom = function ($) {
    _baseElm = $(document);

    onClick = function onClick(selector, callback, dynamic) {

        if (dynamic) {
            _baseElm.on('click', selector, callback);
        } else {
            $(selector).on('click', callback);
        }
    };

    onDblClick = function onDblClick(selector, callback, dynamic) {
        if (dynamic) {
            _baseElm.on('dblclick', selector, callback);
        } else {
            $(selector).on('dblclick', callback);
        }
    };

    onInput = function onInput(selector, callback, dynamic) {
        if (dynamic) {
            _baseElm.on('input', selector, callback);
        } else {
            $(selector).on('input', callback);
        }
    };

    return {
        onClick: onClick,
        onDblClick: onDblClick,
        onInput: onInput
    };
}(jQuery);

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

        return $.ajax({
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

/***/ }),

/***/ 60:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(19);


/***/ })

/******/ });