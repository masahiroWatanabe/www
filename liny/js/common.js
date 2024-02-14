
/*==================================================================================
　Aタグページスクロール
==================================================================================*/

$(function(){
    $('.page-top').click(function(){
      var speed = 1000;
      var href= $(this).attr("href");
      var target = $(href == "#" || href == "" ? 'html' : href);
      var position = target.offset().top;
      $("html, body").animate({scrollTop:position}, speed, "swing");
      return false;
    });
});

$(function(){
    $('.header a').click(function(){
    var headerHight = 66;
      var speed = 1000;
      var href= $(this).attr("href");
      var target = $(href == "#" || href == "" ? 'html' : href);
      var position = target.offset().top-headerHight;
      $("html, body").animate({scrollTop:position}, speed, "swing");
      return false;
    });
});

$(function () {
    //スマホメニュー
    $('.header-sp').on('click', function () {
        if ($(this).hasClass('open')) {
            $(this).removeClass('open');
            $('.header .sp-navi').fadeOut();
        } else {
            $(this).addClass('open');
            $('.header .sp-navi').fadeIn();
        }
    });
});

$(function () {
    //スマホメニュー
    $('.sp-navi-item').on('click', function () {
        $('.header-sp').removeClass('open');
        $('.header .sp-navi').fadeOut();
    });
})





$(function () {
    //スマホメニュー
    $('#spMenuWrap').on('click', function () {
        if ($(this).children().hasClass('open')) {
            $(this).children().removeClass('open');
            $('.index').removeClass('blur');
            $('.header .sp-navi').fadeOut();
        } else {
            $(this).children().addClass('open');
            $('.index').addClass('blur');
            $('.header .sp-navi').fadeIn();

        }
    })
})

$(function () {
    $('.sp-navi-item a').on('click', function () {
        if ($('.sp-menu').hasClass('open')) {
            $('.sp-menu').removeClass('open');
            $('.index').removeClass('blur');
            $('.header .sp-navi').fadeOut();
        } else {
            $('.sp-menu').addClass('open');
            $('.index').addClass('blur');
            $('.header .sp-navi').fadeIn();
        }
    })
})





/*==================================================================================
　スクロールすると表示
==================================================================================*/


//PC スクロールするとヘッダー固定
var _window = $(window),
    _header = $('#header'),
    winScrollTop;
 
if (window.matchMedia('(min-width: 751px)').matches){
$(window).on('scroll',function(){
    winScrollTop = $(this).scrollTop();
    if(winScrollTop >= 1000){
        _header.addClass('UpMove');
        _header.removeClass('DownMove');
    } else {
        _header.removeClass('UpMove');
        _header.addClass('DownMove');
    }
})
};
 
_window.trigger('scroll');




/*==================================================================================
　よくある質問
==================================================================================*/
$('.sec05__item').on('click', function () {
  $(this).toggleClass('open');
  $(this).find('.qanda__txt').slideToggle(350);
})

