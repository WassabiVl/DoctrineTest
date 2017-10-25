+function ($) {

    $(document).ready(function() {
        // language=JQuery-CSS
        $('.js-header-search-toggle').on('click', function() {
            $('.search-bar').slideToggle();
        });
    });

}(jQuery);
