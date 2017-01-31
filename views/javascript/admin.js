$(document).ready(function () {
    //active-menu
    $('header #main-navbar .main-nav a').each(function () {
        var location = window.location.pathname;
        var link = this.pathname;
        var result = location.match(link);

        if(result!==null) {
            $(this).addClass('active-menu');
        }
    });

});