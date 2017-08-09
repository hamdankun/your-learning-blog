var _spinerIcon = '<i class="fa fa-spinner fa-spin"></i>';
$(document).on('submit', '.disabled-when-submit', function() {
    _buttonForm = $(this).find('button').not('[type=reset]');
    _buttonForm.find('button').prop('disabled', true);
    _buttonForm.html(_spinerIcon);
    $(this).submit();
});

$(document).on('click', '.disabled-when-click', function(e) {
    $(this).html(_spinerIcon);
});

$(window).on('load', function() {
    _Loader.hide();
});


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

