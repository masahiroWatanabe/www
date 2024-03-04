
/*==================================================================================
　Aタグページスクロール
==================================================================================*/

$(function(){
    $('a[href^="#"]').click(function(){
      var speed = 500;
      var href= $(this).attr("href");
      var target = $(href == "#" || href == "" ? 'html' : href);
      var position = target.offset().top;
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
    })
})

$(function () {
    $('.sp-navi-item a').on('click', function () {
        if ($('.header-sp').hasClass('open')) {
            $('.header-sp').removeClass('open');
            $('.header .sp-navi').fadeOut();
            
        } else {
            $('.header-sp').addClass('open');
            $('.header .sp-navi').fadeIn();

        }
    })
});


/*==================================================================================
　スクロールすると表示
==================================================================================*/


//PC スクロールするとヘッダー固定
var _window = $(window),
    _header = $('#header'),
    winScrollTop;
 
if (window.matchMedia('(min-width: 1001px)').matches){
$(window).on('scroll',function(){
    winScrollTop = $(this).scrollTop();
    if(winScrollTop >= 10){
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
　プルダウンリスト
==================================================================================*/
$('.questions__item').on('click', function () {
    $(this).toggleClass('open');
    $(this).find('.qanda__txt').slideToggle(350);
  })
