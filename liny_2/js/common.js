
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

//PC スクロールするとサブボタン表示
$(function() {
    if (window.matchMedia('(min-width: 751px)').matches){
    var topBtn = $('#sideNav');    
    topBtn.hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 1000) {
            topBtn.fadeIn();
        } else {
            topBtn.fadeOut();
        }
    });
};
});

//SP スクロールするとサブボタン表示
$(function() {
    if (window.matchMedia('(max-width: 750px)').matches){
    var bottomBtn = $('#spBottomTab');    
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



//PC スクロールするとヘッダー固定
var _window = $(window),
    _header = $('#header'),
    winScrollTop;
 
if (window.matchMedia('(min-width: 751px)').matches){
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
$('.drop__item').on('click', function () {
    $(this).toggleClass('open');
    $(this).find('.drop__txt').slideToggle(350);
})


/*==================================================================================
　ポップアップ
==================================================================================*/

function popupImage() {
    var popup = document.getElementById('js-popup');
    if(!popup) return;
  
    var blackBg = document.getElementById('js-black-bg');
    var closeBtn = document.getElementById('js-close-btn');
    var showBtn = document.getElementById('js-show-popup');
    var showBtn2 = document.getElementById('js-show-popup-2');
    var showBtn3 = document.getElementById('js-show-popup-3');
    var showBtn4 = document.getElementById('js-show-popup-4');
    var showBtn5 = document.getElementById('js-show-popup-5');

    closePopUp(blackBg);
    closePopUp(closeBtn);
    closePopUp(showBtn);
    closePopUp(showBtn2);
    closePopUp(showBtn3);
    closePopUp(showBtn4);
    closePopUp(showBtn5);
    function closePopUp(elem) {
      if(!elem) return;
      elem.addEventListener('click', function() {
        popup.classList.toggle('is-show');
      });
    }
  }
  popupImage();


/*==================================================================================
　form チェックボックスと送信ボタンの連動
==================================================================================*/

document.addEventListener('DOMContentLoaded', function(event) {
    const targetButton = document.getElementById('submitButton');
    const triggerCheckbox = document.querySelector('input[name="agree"]');
  
    targetButton.disabled = true;
    targetButton.classList.add('is-inactive');
  
    triggerCheckbox.addEventListener('change', function() {
      if (this.checked) {
        targetButton.disabled = false;
        targetButton.classList.remove('is-inactive');
        targetButton.classList.add('is-active');
      } else {
        targetButton.disabled = true;
        targetButton.classList.remove('is-active');
        targetButton.classList.add('is-inactive');
      }
    }, false);
  }, false);