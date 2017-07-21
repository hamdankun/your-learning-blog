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
