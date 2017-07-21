_BtnDatatable = (function($, prefixUrl) {
    create = function(id) {
         var _button = '<a href="'+prefixUrl+'/'+id+'/edit" class="btn btn-primary btn-sm dt-edit"><i class="fa fa-edit"></i> Edit</a>&nbsp;';
        _button += '<a href="'+prefixUrl+'/'+id+'" class="btn btn-danger btn-sm dt-delete"> <i class="fa fa-trash"></i> Delete</a>';
        _button += '<form action="'+prefixUrl+'/'+id+'" method="POST" class="action-delete">'+_methodFieldDelete+''+_csrfToken+'</form>'
        return _button;
    }

    return {
        create: create
    }
})(jQuery, typeof _prefixUrl !== 'undefined' ? _prefixUrl : '');