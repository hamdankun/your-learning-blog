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
/******/ 	return __webpack_require__(__webpack_require__.s = 44);
/******/ })
/************************************************************************/
/******/ ({

/***/ 44:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(8);


/***/ }),

/***/ 8:
/***/ (function(module, exports) {

var AppModule = {
    index: function index() {
        var _columns = [{ data: null, orderable: false, searchable: false, width: '5%' }, { data: 'title', name: 'title' }, { data: 'id', name: 'id', orderable: false, searchable: false, render: function render(id) {
                return _BtnDatatable.create(id);
            } }];
        _DatatableFactory.build($('#article'), _urlAjaxDatatable, _columns);
        _elm = $(document);

        _elm.on('click', '.dt-delete', function (e) {
            e.preventDefault();
            if (confirm('Are you sure ?')) {
                $(this).html('<i class="fa fa-spinner fa-spin"></i>');
                $(this).parent().find('form.action-delete').submit();
            }
        });
    },
    updateOrCreate: function updateOrCreate() {
        $(document).ready(function () {
            tinymce.init({
                selector: '#content-article',
                height: 800,
                plugins: ['advlist autolink lists link image charmap print preview anchor', 'searchreplace visualblocks code fullscreen', 'insertdatetime media table contextmenu paste code'],
                toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright'
            });
            $('#category').selectize();
            $('#label').selectize({
                create: function create(input) {
                    return {
                        value: input,
                        text: input
                    };
                }
            });
        });

        $("#upload-image").fileinput({
            showUpload: false,
            allowedFileTypes: ['image'],
            initialPreview: typeof images !== 'undefined' ? images : [],
            initialPreviewAsData: true
        });
    }
};

if (mode === 'update' || mode === 'create') {
    AppModule.updateOrCreate();
} else if (mode === 'index') {
    AppModule.index();
}

/***/ })

/******/ });