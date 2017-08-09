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
/******/ 	return __webpack_require__(__webpack_require__.s = 48);
/******/ })
/************************************************************************/
/******/ ({

/***/ 48:
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
                plugins: ['advlist autolink lists link image charmap print preview anchor emoticons codesample', 'searchreplace visualblocks code', 'insertdatetime media table contextmenu paste code'],
                codesample_languages: [{ text: 'HTML/XML', value: 'markup' }, { text: 'JavaScript', value: 'javascript' }, { text: 'CSS', value: 'css' }, { text: 'PHP', value: 'php' }, { text: 'Ruby', value: 'ruby' }, { text: 'Python', value: 'python' }, { text: 'Java', value: 'java' }, { text: 'C', value: 'c' }, { text: 'C#', value: 'csharp' }, { text: 'C++', value: 'cpp' }],
                toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright | emoticons | codesample',
                file_browser_callback: function file_browser_callback(field_name, url, type, win) {
                    win.document.getElementById(field_name).value = 'my browser value';
                    console.log(field_name);
                }
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

        $('#upload-image, #upload-gallery').fileinput({
            showUpload: false,
            allowedFileTypes: ['image'],
            initialPreview: typeof images !== 'undefined' ? images : [],
            initialPreviewAsData: true
        });

        $('.upload-gallery').click(function () {
            var formData = new FormData();
            var images = [];

            $.each($('#upload-gallery')[0].files, function (key, val) {
                formData.append('gallery[images-' + key + ']', val);
            });

            $.ajax({
                url: _baseUrl + '/admin/ajax/upload-image-gallery',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function success(response) {
                    if (response.status === 'success') {
                        renderImages(response.data);
                    }
                },
                error: function error(errors) {
                    console.log(errors);
                }
            });
        });
    }
};

if (mode === 'update' || mode === 'create') {
    AppModule.updateOrCreate();
} else if (mode === 'index') {
    AppModule.index();
}

_Dom.onClick('.append', function () {
    _dataType = $(this).attr('data-type');
    _nameFormClass = _dataType + '-base-form-meta';
    _baseForm = $('.' + _nameFormClass).clone();
    _baseForm.removeClass(_nameFormClass);
    _baseForm.children('.invisible-area').find('input.attribute_value').remove();
    _baseForm.children('.control-label').html(buildTextField());
    _baseForm.children('.input-group').children('textarea').attr('placeholder', 'Enter Content');
    _btn = _baseForm.children('.btn-area').children('button');
    _btn.removeClass('append btn-primary').addClass('btn-danger remove').removeClass('data-type');
    _btn.children('i').removeClass('fa-plus-circle').addClass('fa-trash');
    _baseForm.hide();
    $('.' + _dataType + '-meta-content').append(_baseForm);
    _baseForm.slideDown();
});

_Dom.onClick('.article', function () {
    $(this).parent().parent().slideUp(function () {
        $(this).remove();
    });
}, true);

function buildTextField() {
    return '<input type="text" name="seo[attribute_value][]" maxlength="50" placeholder="Enter Attribute" class="form-control">';
}

function renderImages(images) {
    _imgGalleryElm = $('.image-gallery');
    _imgGalleryContent = '';
    $.each(images, function (key, val) {
        _imgGalleryContent += '<div class="col-sm-2 col-xs-12">' + '<img src="/storage/your-images/gallery/' + val.filename + '" alt="Article Image" class="img-responsive">' + '</div>';
    });
    $('.fileinput-remove-button').trigger('click');
    _imgGalleryElm.html(_imgGalleryContent);
}

/***/ })

/******/ });