
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
    if (window.matchMedia('(max-width: 1000px)').matches){
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

$(function() {
    if (window.matchMedia('(min-width: 1001px)').matches){
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
    _mv = $('.swiper-container-main').height(),
    winScrollTop;
 
if (window.matchMedia('(min-width: 1001px)').matches){
$(window).on('scroll',function(){
    winScrollTop = $(this).scrollTop();
    if(winScrollTop >= 500){
        _header.addClass('UpMove');
        _header.removeClass('DownMove');
    } else {
        _header.removeClass('UpMove');
        _header.addClass('DownMove');
    }
})
};
 
_window.trigger('scroll');


$(function(){
    $(".js-fadeUp").on("inview", function (event, isInView) {
      if (isInView) {
        $(this).stop().addClass("is-inview");
      }
    });
});



/*==================================================================================
　アニメーション
==================================================================================*/

new WOW().init();

function wowFadeInFunc(num, initialDelay, step) {
    const items = document.querySelectorAll('.item' + num);

    if (items.length === 0) {
        return; 
    }

    let delay = initialDelay;

    items.forEach((item, index) => {
        item.dataset.wowDelay = `${delay}s`;
        delay += step;
    });
}

document.addEventListener('DOMContentLoaded',()=>{
    wowFadeInFunc(1,0.2,0.2);
})