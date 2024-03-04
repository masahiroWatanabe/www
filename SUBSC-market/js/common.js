
/*==================================================================================
　Aタグページスクロール
==================================================================================*/

$(function(){
  $('.page-top').click(function(){
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
    $('#js-header-menu').on('click', function () {
        if ($('.menu-wrap').hasClass('open')) {
            $('.menu-wrap').removeClass('open');
            $('.header .navi').fadeOut();
        } else {
            $('.menu-wrap').addClass('open');
            $('.header .navi').fadeIn();

        }
    })
})



/*==================================================================================
　スクロール関係
==================================================================================*/

//PC スクロールするとページTOPに戻るボタン表示
$(function() {
    if (window.matchMedia('(max-width: 2000px)').matches){
    var topBtn = $('.page-top');
    topBtn.hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 900) {
            topBtn.fadeIn();
        } else {
            topBtn.fadeOut();
        }
    });
};
});

//SP スクロールするとページTOPに戻るボタン表示
$(function() {
    if (window.matchMedia('(max-width: 750px)').matches){
    var bottomBtn = $('.page-top');    
    bottomBtn.hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 500) {
            bottomBtn.fadeIn();
        } else {
            bottomBtn.fadeOut();
        }
    });
};
});

//PC 画面サイズ2001px 以上　スクロール対応
$(function() {
    if (window.matchMedia('(min-width: 2001px)').matches){
    var topBtn = $('.page-top');
    topBtn.hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            topBtn.fadeIn();
        } else {
            topBtn.fadeOut();
        }
    });
};
});


//PC スクロールするとヘッダー固定
var _window = $(window),
    _header = $('#header'),
    winScrollTop;
 
if (window.matchMedia('(min-width: 751px)').matches){
$(window).on('scroll',function(){
    winScrollTop = $(this).scrollTop();
    if(winScrollTop >= 100){
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
　トップ　アニメーション
==================================================================================*/

$(function(){
    $(window).scroll(function (){
      $('.red, .green, .blue, .yellow, .black').each(function(){
        
        var target = $(this).offset().top;
        
        var scroll = $(window).scrollTop();
        
        var windowHeight = $(window).height();
        
        if (scroll > target - windowHeight + 200){
            $(this).addClass('fade');
        }
      });
    });
  });



