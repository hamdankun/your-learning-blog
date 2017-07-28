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

_Image = (function($) {
    onError = function() {

    }

    lazy = function() {
      $("img.lazy").lazyload({
          threshold : 200,
          placeholder: _baseUrlImgPath+'/article-images/default.png'
      });
    }

    return {
        onError: onError,
        lazy: lazy
    }
})(jQuery);


_elm = $(document);

_elm.ready(function() {
    $('.button-collapse').sideNav();

    $(".dropdown-button").dropdown();

    _Loader.hide();

    $('.button-collapse').click(function() {
        $('#sidenav-overlay').css({'z-index': 0});
    });
});

// service ajax
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

    $.ajax({
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

