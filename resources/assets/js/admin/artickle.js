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

_Dom.onClick('.append', function() {
   _dataType = $(this).attr('data-type');
   _nameFormClass = _dataType +'-base-form-meta';
   _baseForm = $('.' + _nameFormClass).clone();
   _baseForm.removeClass(_nameFormClass);
   _baseForm.children('.invisible-area').find('input.attribute_value').remove();
   _baseForm.children('.control-label').html(buildTextField());
   _baseForm.children('.input-group')
        .children('textarea')
        .attr('placeholder', 'Enter Content')
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

_Dom.onClick('.article', function() {
    $(this).parent().parent().slideUp(function() {
        $(this).remove();
    });
}, true)

function buildTextField() {
    return '<input type="text" name="seo[attribute_value][]" maxlength="50" placeholder="Enter Attribute" class="form-control">';
}