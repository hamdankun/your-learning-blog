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

_Loader = (function($) {
    var _loaderWraper = $('#loader-wrapper');
    show = function() {
        load(true);
    }

    hide = function() {
        load(false);
    }

    load = function(show) {
        if (show) {
            _loaderWraper.fadeIn();
        } else {
            _loaderWraper.fadeOut();
        }
    }

    return {
        show: show,
        hide: hide,
        load: load
    }
})(jQuery);

_Dom = (function($) {
    _baseElm = $(document);

    onClick = function(selector, callback, dynamic) {

        if(dynamic) {
            _baseElm.on('click', selector,callback);
        } else {
            $(selector).on('click', callback);
        }
    }

    onDblClick = function (selector, callback, dynamic) {
        if(dynamic) {
            _baseElm.on('dblclick', selector,callback);
        } else {
            $(selector).on('dblclick', callback);
        }
    }

    onInput = function (selector, callback, dynamic) {
        if(dynamic) {
            _baseElm.on('input', selector,callback);
        } else {
            $(selector).on('input', callback);
        }
    }

    return {
        onClick: onClick,
        onDblClick: onDblClick,
        onInput: onInput
    }
})(jQuery);


_Http = (function() {
  resolve = function(url, method, data, onSuccess, onError, dataType) {

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
  }

  _get = function(url, parameters, onSuccess, onError, dataType) {
    return resolve(url, 'GET', parameters, onSuccess, onError, dataType);
  }

  _post = function(url, data, onSuccess, onError, dataType) {
    return resolve(url, 'POST', data, onSuccess, onError, dataType);
  }

  _put = function(url, data, onSuccess, onError, dataType) {
    return resolve(url, 'PUT', data, onSuccess, onError, dataType);
  }

  _delete = function(url, parameters, onSuccess, onError, dataType) {
    return resolve(url, 'DELETE', parameters, onSuccess, onError, dataType);
  }

  return {
    resolve: resolve,
    _get: _get,
    _post: _post,
    _put: _put,
    _delete: _delete
  }
})();