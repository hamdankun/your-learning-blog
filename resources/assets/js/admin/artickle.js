var AppModule = {
    index: function() {
        var _columns = [
            { data: null, orderable: false, searchable: false, width: '5%' },
            { data: 'title', name: 'title' },
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

        $("#upload-image").fileinput({
            showUpload: false,
            allowedFileTypes: ['image'],
            initialPreview: typeof images !== 'undefined' ? images : [],
            initialPreviewAsData: true
        });
    }
}

if (mode === 'update' || mode === 'create') {
    AppModule.updateOrCreate();
} else if (mode === 'index') {
    AppModule.index();
}

_Dom.onClick('.add-keyword', function() {
   _formKeyword = $('.base-form-keyword').first().clone();
   _formKeyword.removeClass('base-form-keyword')
            .addClass('form-keyword')
            .attr('data-type', 'form-keyword')
            .hide()
            .find('.control-label')
            .html('keyword ' + ($('.form-keyword').length + 2));
    _formKeyword.find('.btn-area')
            .children('button')
            .removeClass('btn-primary')
            .addClass('btn-danger')
            .addClass('remove keyword')
            .removeClass('add-keyword')
            .children('i')
            .removeClass('fa-plus-circle')
            .addClass('fa-trash')
   $('.keyword-content').append(_formKeyword);
   _formKeyword.show('slow');
});

_Dom.onClick('.remove', function() {
    _formType = $(this).parent().parent().attr('data-type');
    $(this).parent().parent().hide('slow', function() {
        $(this).remove();

        if (_formType === 'form-keyword') {
            reloadIndex('.form-keyword', 'keyword');
        }
    });
}, true);

_Dom.onClick('.add-meta', function() {
    _formMeta = $('.base-form-meta').first().clone();
    _formMeta.removeClass('base-form-meta').addClass('form-meta')
        .attr('data-type', 'form-keyword');
    _formMeta.find('input[type=hidden].meta').remove();
    _formMeta.find('label')
        .removeClass('control-label')
        .html('<select class="form-control" name="seo[type][]"><option>Awesome</option></select>');
    _formMeta = changeBtnAddToRemove(_formMeta.find('.btn-area'), { remove: 'add-meta', add: 'meta remove' });
    _formMeta.hide();
    $('.meta-content').append(_formMeta);
    _formMeta.show('slow');
});

_Dom.onClick('.add-property', function() {
    _formProperty = $('.base-form-property').first().clone();
    _formProperty.removeClass('base-form-property').addClass('form-property')
        .attr('data-type', 'form-property');
    _formProperty.find('input[type=hidden].property').remove();
    _formProperty.find('label')
        .removeClass('control-label')
        .html('<select class="form-control" name="seo[type][]"><option>Property</option></select>');
    _formProperty = changeBtnAddToRemove(_formProperty.find('.btn-area'), { remove: 'add-property', add: 'property remove' });
    _formProperty.hide();
    // console.log(_formProperty);
    $('.property-content').append(_formProperty);
    _formProperty.show('slow');
});

function reloadIndex(selector, key) {
   $(selector).each(function(i) {
        $(this).find('.control-label').html(key+' '+ (i + 2));
   });
}

function changeBtnAddToRemove(elm, modify) {
    elm.children('button')
      .removeClass('btn-primary')
      .addClass('btn-danger')
      .removeClass(modify['remove'])
      .addClass(modify['add'])
      .children('i')
      .removeClass('fa-plus-circle')
      .addClass('fa-trash');
    return elm.parent();
}