var dom = $(document);
var btnSaveSeo = $('.save-seo');
var formSeo = $('.form-seo-static');

dom.ready(function() {
    btnSaveSeo.prop('disabled', false);
    _Dom.onClick('.save-seo', function() {
        saveSeo();
    });
    _Dom.onClick('.remove-seo', function() {
        _this = $(this);
        if (confirm('Are You Sure ?')) {
            $(this).parent().parent().hide('normal', function() {
                _dataType = _this.attr('data-type');
                _countLabel = $('span.count-meta-' + _dataType);
                _decrease = (parseInt(_countLabel.attr('data-count')) - 1);
                _countLabel.html(_decrease).attr('data-count', _decrease);
                $(this).remove();
            })
        }
    }, true);
    _Dom.onClick('.add-seo-attribute', function() {
        appendSeoAttribute($(this).attr('data-type'));
    });
});

function saveSeo() {
    inProsessing(true);
    _Http._post(_prefixUrl + '/save', formSeo.serialize())
        .done(function(response) {
            toastr.success('Save Has Been Successfully');    
            inProsessing(false);                   
        })
        .catch(function(errors) {
            errorMessages = '';
            
            if (errors.statusText === 'timeout' || errors.getResponseHeader('Content-Type').indexOf('text/html') !== -1) {
              errorMessages = errors.statusText;
            } else if (errors.status === 500) {
              errorMessages = 'Internal Server Error';
            } else if (errors.status === 422) {
              errorMessages = errors.responseJSON.errors;
              listArray = [];    
              for (key in errorMessages) {
                listArray.push('<li>' + errorMessages[key][0].replace('_', ' ').replace('.', ' ').replace('_', ' ').replace('.', ' ') + '</li>');
              }
              errorMessages = listArray.join(' ');
            } else {
              errorMessages = errors.responseJSON.error;
            }

            toastr.error(errorMessages);
            inProsessing(false);            
        })
}

function inProsessing(status) {
    btnSaveSeo.prop('disabled', status);
    btnSaveSeo.text('Saving...');
    var spinner = btnSaveSeo.find('i.fa-spinner');
    var save = btnSaveSeo.find('i.fa-floppy-o');
    
    if (status) {
        btnSaveSeo.html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Saving...'); 
    } else {
        btnSaveSeo.html('<i class="fa fa-floppy-o" aria-hidden="true"></i> Save'); 
    }
}

function appendSeoAttribute(page) {
    DOMname = page +  '-seo-form-group';    
    contentDOM = '<div class="form-group ' + DOMname + '">'
        + buildAttributeKey(page)
        + buildAttributeName(page)
        + buildAttributeContent(page)
        + buildAttributeButton(page)
    +'</div>';
    $(contentDOM).insertAfter($('.' + DOMname).last());
    _countLabel = $('span.count-meta-' + page);
    _increase = (parseInt(_countLabel.attr('data-count')) + 1);
    _countLabel.html(_increase).attr('data-count', _increase);
}

function buildAttributeKey(page) {
    return '<div class="col-sm-10 col-md-3 col-lg-3 col-xs-12">'
        +'<input type="text" name="' + page + '[attribute_key][]" class="form-control" placeholder="Attribute Key"/>'
    +'</div>';
}

function buildAttributeName(page) {
    return '<div class="col-sm-10 col-md-3 col-lg-3 col-xs-12">'
        +'<input type="text" name="' + page + '[attribute_name][]" class="form-control" placeholder="Attribute Name"/>'
    +'</div>';
}

function buildAttributeContent(page) {
    return '<div class="col-sm-10 col-md-4 col-lg-5 col-xs-12">'
            +'<textarea name="' + page + '[attribute_content][]" class="form-control" placeholder="Attribute Content"></textarea>'                  
    +'</div>'
}

function buildAttributeButton(page) {
    return '<div class="col-sm-10 col-md-3 col-lg-1 col-xs-12">'
        +'<button type="button" class="btn btn-danger btn-sm remove-seo" data-type="' + page + '"><i class="fa fa-trash"></i></button>'
    +'</div>';
}