
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


$(function(){
    $('#js-tag li').click(function(){
        window.scroll({
        top: 0,
        behavior: "smooth",
        });
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

//PC スクロールするとコンテンツ表示

$(function(){
    $(window).scroll(function (){
        $('.view').each(function(){
            var elemPos = $(this).offset().top;
            var scroll = $(window).scrollTop();
            var windowHeight = $(window).height();
            if (scroll > elemPos - windowHeight + 200){
                $(this).addClass('scrollin');
            }
        });
    });
});

/*==================================================================================
　プルダウンリスト
==================================================================================*/
$('.js-nabi-drop').on('click', function () {
    $(this).toggleClass('open');
    $(this).find('.drop__txt').slideToggle(350);
})

/*==================================================================================
  タブ切り替え
==================================================================================*/

$(function () {
 $(".tab").click(function () {
     var index = $(".tab").index(this);
     $(".tab, .show-content").removeClass("active");
     $(this).addClass("active");
     $(".show-content").eq(index).addClass("active");
 });
});


$(function () {
    //タブへダイレクトリンクの実装
    //リンクからハッシュを取得
    var hash = location.hash;
    hash = (hash.match(/^#tab_panel-\d+$/) || [])[0];
    //リンクにハッシュが入っていればtabnameに格納
    if ($(hash).length) {
        var tabname = hash.slice(1);
    } else {
        var tabname = "tab_panel-1";
    }
    //コンテンツ非表示・タブを非アクティブ
    $(".tab").removeClass("active");
    $(".show-content").removeClass("active");
    //何番目のタブかを格納
    var tabno = $(".show-content#" + tabname).index();
    //コンテンツ表示
    $(".show-content").eq(tabno).addClass("active");
    //タブのアクティブ化
    $(".tab").eq(tabno).addClass("active");
});


$(function () {
    $("#js-sp-header-tab .sp-tab").click(function () {
        var index = $(".sp-tab").index(this);
        $(".tab, .show-content").removeClass("active");
        $(".tab").eq(index).addClass("active");
        $(".show-content").eq(index).addClass("active");
    });
   });

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


/*==================================================================================
　表示領域に入ると表示
==================================================================================*/

window.onload = function () {
        $('#js-mv h1').addClass('img-blur');
};