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
