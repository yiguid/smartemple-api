var cur_slider = 0;
function next(){
    if(cur_slider == $('.slider-nav').children().length)
        cur_slider = 0;
    pre_slider = cur_slider - 1;
    if(pre_slider == -1)
        pre_slider = 10;
    var pre_nav = $(".slider-nav").find("div").eq(pre_slider);
    var cur_nav = $(".slider-nav").find("div").eq(cur_slider);
    cur_nav.addClass("active").siblings().removeClass("active");
    cur_nav.animate({
          opacity: 0.5
        }, 1 );
    cur_nav.animate({
          opacity: 1
        }, 1000 );
    cur_slider += 1;
}


$(document).ready(function(){
    $('.slider-nav-item').mouseover(function(){
        //$(this).addClass("active").siblings().removeClass("active");
        $(this).animate({
          opacity: 0.8
        }, 500 );
        $(this).addClass("active").siblings().removeClass("active");
        $(this).animate({
          opacity: 1
        }, 500 );
    });
    $('.slider-nav-item').mouseout(function(){
        $(this).removeClass("active");
    });
    $('.list-item').mouseover(function(){
        $(this).addClass("active").siblings().removeClass("active");
    });
    $('.list-item').mouseout(function(){
        $(this).removeClass("active");
    });

    clearInterval(inervalID);  //清理一次，下面再执行
    var inervalID = setInterval(next,2000);
});
