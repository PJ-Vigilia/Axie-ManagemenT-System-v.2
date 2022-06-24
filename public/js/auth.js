$(document).ready(function(){
    $(window).resize(function(){
        if($(window).width() <= 600){
            $('.login').toggleClass('shadow');
            $('.register').toggleClass('shadow');
        }
    });
    if($(window).width() <= 600){
        $('.login').toggleClass('shadow');
        $('.register').toggleClass('shadow');
    }
})
