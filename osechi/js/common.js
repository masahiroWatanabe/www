
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

$(function () {
    $('.navi a').on('click', function () {
        if ($('#js-header-menu').hasClass('open')) {
            $('#js-header-menu').removeClass('open');
            $('.navi').fadeOut();
            
        } else {
            $('#js-header-menu').addClass('open');
            $('.navi').fadeIn();

        }
    })
});



/*==================================================================================
　スクロール関係
==================================================================================*/


//SP スクロールするとページTOPに戻るボタン表示
$(function() {
    if (window.matchMedia('(max-width: 768px)').matches){
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
    if (window.matchMedia('(min-width: 769px)').matches){
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



