_Loader = (function() {
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

_elm = $(document);

_elm.ready(function() {
    $('.button-collapse').sideNav(); 

    $(".dropdown-button").dropdown();
    
    _Loader.hide();   

    $('.button-collapse').click(function() {
        $('#sidenav-overlay').css({'z-index': 0});
    });
});

