var _modalGallery = $('#modalGallery');
var _fieldUploadName;
var _lengthGalleryPaginator = 0;
var _currentGalleryPaginator = 0;
var AppModule = {
    index: function() {
        var _columns = [
            { data: null, orderable: false, searchable: false, width: '5%' },
            { data: 'title', name: 'title' },
            { data: 'visitor', name: 'visitor', orderable: false, searchable: false, render: function(visitor) {
                return visitor ? visitor.total : 0;
            } },
            { data: 'id', name: 'id', orderable: false, searchable: false, render: function(id) {
                return _BtnDatatable.create(id);
            } },
        ]
        _DatatableFactory.build($('#article'), _urlAjaxDatatable, _columns);
        _elm = $(document);

        _elm.on('click', '.dt-delete', function(e) {
            e.preventDefault();
            if (confirm('Are you sure ?')) {
                $(this).html('<i class="fa fa-spinner fa-spin"></i>')
                $(this).parent().find('form.action-delete').submit();
            }
        });
    },
    updateOrCreate: function() {
        $(document).ready(function() {
            tinymce.init({
                selector: '#content-article',
                height: 800,
                relative_urls : false,
                remove_script_host : false,
                convert_urls : true,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor emoticons codesample',
                    'searchreplace visualblocks code',
                    'insertdatetime media table contextmenu paste code'
                ],
                codesample_languages: [
                    {text: 'HTML/XML', value: 'markup'},
                    {text: 'JavaScript', value: 'javascript'},
                    {text: 'CSS', value: 'css'},
                    {text: 'PHP', value: 'php'},
                    {text: 'Ruby', value: 'ruby'},
                    {text: 'Python', value: 'python'},
                    {text: 'Java', value: 'java'},
                    {text: 'C', value: 'c'},
                    {text: 'C#', value: 'csharp'},
                    {text: 'C++', value: 'cpp'}
                ],
                toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright | emoticons | codesample',
                file_browser_callback: function(field_name, url, type, win) {
                    // win.document.getElementById(field_name).value = 'my browser value';
                    _fieldUploadName = field_name;
                    getImgGallery(1);
                    _modalGallery.modal('show');

                }
            });
            $('#category').selectize();
            $('#label').selectize({
                create: function(input) {
                    return {
                        value: input,
                        text: input
                    }
                }
            })
        });

        $('#upload-image, #upload-gallery').fileinput({
            showUpload: false,
            allowedFileTypes: ['image'],
            initialPreview: typeof images !== 'undefined' ? images : [],
            initialPreviewAsData: true
        });

        $('.upload-gallery').click(function() {
            var formData = new FormData();
            var images = [];

            $.each($('#upload-gallery')[0].files, function (key, val) {
                formData.append('gallery[images-' + key + ']', val);
            });

            $.ajax({
                url : _baseUrl+'/admin/ajax/upload-image-gallery',
                type : 'POST',
                data : formData,
                processData: false,
                contentType: false,
                success : function(response) {
                    if (response.status === 'success') {
                        getImgGallery(1);
                        $('.fileinput-remove-button').trigger('click');
                    }
                },
                error: function (errors) {
                    console.log(errors);
                }
            });
        });
    }
}

if (mode === 'update' || mode === 'create') {
    AppModule.updateOrCreate();
} else if (mode === 'index') {
    AppModule.index();
}


_Dom.onClick('.append', function() {
   _dataType = $(this).attr('data-type');
   _nameFormClass = _dataType +'-base-form-meta';
   _baseForm = $('.' + _nameFormClass).clone();
   _baseForm.removeClass(_nameFormClass);
   _baseForm.children('.invisible-area')
        .find('input.attribute_value')
        .remove();
   _baseForm.children('.control-label')
        .html(buildTextField());
   _baseForm.children('.input-group')
        .children('textarea')
        .attr('placeholder', 'Enter Content');
   _baseForm.children('.invisible-area')
        .find('input[name="seo[placeholder][]"]')
        .val('Enter Content');
   _btn = _baseForm.children('.btn-area').children('button');
   _btn.removeClass('append btn-primary')
     .addClass('btn-danger remove')
     .removeClass('data-type');
   _btn.children('i')
     .removeClass('fa-plus-circle')
     .addClass('fa-trash');
   _baseForm.hide();
   $('.' + _dataType + '-meta-content').append(_baseForm);
   _baseForm.slideDown();
});

_Dom.onClick('.remove', function() {
    $(this).parent().parent().slideUp(function() {
        $(this).remove();
    });
}, true)

_Dom.onClick('.img-gallery', function () {
    _imgGalleryContents = $('.img-gallery');

    _imgGalleryContents.each(function() {
       $(this).removeClass('img-gallery-active');
    });

    $(this).addClass('img-gallery-active');
}, true);

_Dom.onDblClick('.img-gallery', function () {
   // $('.choose-image').trigger('click');
});

_Dom.onClick('.gallery-paginator', function (e) {
    e.preventDefault();
    var vm = $(this);
    var pageTarget = _currentGalleryPaginator;

    if (vm.attr('data-ref') === 'prev') {
        pageTarget -= 1;
    } else {
        pageTarget += 1;
    }

    getImgGallery(pageTarget);
});

_Dom.onClick('.choose-image', function () {
   _activeGalleryImg = $('.img-gallery.img-gallery-active').children('img');
   $('#' + _fieldUploadName).val(_activeGalleryImg.attr('src')).trigger('input');
   _modalGallery.modal('hide');
});

_Dom.onInput('.title', function (e) {
    var vm = $(this);
    var _googleSeoName = $('.google-name');
    var _ogSeoName = $('.og-title');
    var _twitterSeoName = $('.twitter-title');

    _googleSeoName.attr('placeholder', vm.val());
    _ogSeoName.attr('placeholder', vm.val());
    _twitterSeoName.attr('placeholder', vm.val());
}, true);

_Dom.onInput('.dynamic-attribute-value', function() {
    _this = $(this);
    _val = _this.val();
    _this.parent().parent()
        .find('.invisible-area')
        .find('input[name="seo[placeholder][]"]')
        .val(_val);
}, true);

function paginatorListener(currentGalleryPaginator, lengthGalleryPaginator) {
    
    var _prevPagination = $('.gallery-paginator[data-ref="prev"]');
    var _nextPagination = $('.gallery-paginator[data-ref="next"]');

    if (currentGalleryPaginator === 1) {
        _prevPagination.hide();
    } else {
        _prevPagination.show();
    }

    if (currentGalleryPaginator === lengthGalleryPaginator) {
        _nextPagination.hide();
    } else {
        _nextPagination.show();
    }
}

function buildTextField() {
    return '<input type="text" name="seo[attribute_value][]" maxlength="50" placeholder="Enter Attribute" class="form-control dynamic-attribute-value">';
}

function renderImages(images) {
    _imgGalleryElm = $('.image-gallery');
    _imgGalleryContent = '';
    _lengthGalleryPaginator = images.last_page;
    _currentGalleryPaginator = images.current_page;
    var _imgGallery = [];

    if (images.data.length > 0) {
        _imgGallery = images.data.chunk(5);
    }

    $.each(_imgGallery, function (key, images) {
        _imgGalleryContent += '<div class="row col-sm-12">';
        $.each(images, function (key, val) {
            _imgGalleryContent += '<div class="col-sm-2 col-xs-6 img-gallery">'
                +'<img src="'+ _resourceUrl + '/' + val.filename + '" alt="Article Image" class="img-responsive">'
                +'</div>';
        });
        _imgGallery += '</div>';
    });
    paginatorListener(_currentGalleryPaginator, _lengthGalleryPaginator);
    _imgGalleryElm.html(_imgGalleryContent);
}

function getImgGallery(page) {
    $.ajax({
        url : _baseUrl+'/admin/ajax/image-gallery?page=' + page,
        type : 'GET',
        contentType: 'json',
        success : function(response) {
            if (response.status === 'success') {
                renderImages(response.data);
            }
        },
        error: function (errors) {
            console.log(errors);
        }
    });
}


Object.defineProperty(Array.prototype, 'chunk', {
    value: function(chunkSize) {
        return this.reduce(function(previous, current) {
            var chunk;
            if (previous.length === 0 ||
                previous[previous.length -1].length === chunkSize) {
                chunk = [];
                previous.push(chunk);
            }
            else {
                chunk = previous[previous.length -1];
            }
            chunk.push(current);
            return previous;
        }, []);
    }
});