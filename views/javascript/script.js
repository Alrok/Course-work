
$(document).ready(function () {
    var hideBanner=function(){
        var pathname=window.location.pathname;
        if(pathname=="/"||pathname=="/main"){
            $('.banner').css('display','block');
        }

    };
    hideBanner();
    //active-menu
    $('header #main-navbar .main-nav a').each(function () {
        var location = window.location.pathname;
        var link = this.pathname;
        var result = location.match(link);

        if(result!==null) {
            $(this).addClass('active-menu');
        }
    });

    $.ajax({
        url: "/main/checklogin",
        type: "POST",
        success: function (data) {
            if(data){
                $('#signup_btn').css('display','none');
                $('#login_btn').css('display','none');
                $('#logout_btn').css('display','inline-block');
                var user_id=data;
                if(window.location.pathname.match('/resources')){
                    console.log(user_id);
                }
                
            }
            else{
                $('#signup_btn').css('display','inline-block');
                $('#login_btn').css('display','inline-block');
                $('#logout_btn').css('display','none');
            }
        }
    });

});