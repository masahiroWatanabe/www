<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>お問い合わせ|川口市の葬儀・家族葬・お葬式は【南彩会館】</title>
	<meta name="description" content="葬儀のプランや流れに関しての内容についてのご質問やご予約について、是非ともお問い合わせページよりご連絡ください。">
	<meta name="keywords" content="">
	<meta name="format-detection" content="telephone=no">
	<link type="text/css" rel="stylesheet" href="../css/reset.css">
	<link type="text/css" rel="stylesheet" href="../css/styles.css?202401161320">
	<link rel="icon" type="image/x-icon" href="../img/common/favicon.ico">
</head>

<body>

<!-- ーーーーーーーーーーーーーーーヘッダーーーーーーーーーーーーーーーー -->
<header id="header" class="header">
	<div class="header-logo-area">
		<p class="header-logo">
			<a href="/"><img src="/img/common/header-logo.png" alt="ロゴ画像"></a>
		</p>
		<p class="header-logo-funeral">
			<a href="https://www.eranda.jp/sogi/sogijo/nansaikaikan" target="_blank"><img src="/img/common/header-funeral.png" alt="ロゴ画像"></a>
		</p>
		<div class="tel-box">
			<p class="tel-box-text1">シキュウイチバンゴクヨー</p>
			<a class="tel-box-link" href="tel:0120-491-594">0120-491-594</a>
			<p class="tel-box-text2">株式会社市民葬祭ホール</p>
		</div>
		<a href="/contact/" class="header-contact">
			<i></i>
			<p>お問い合わせ</p>
		</a>
	</div>
	<div class="header-list-area">
		<ul class="header-list">
			<li class=""><a href="/plan/">葬儀費用・プラン</a></li>
			<li class=""><a href="/about/">南彩会館の特徴</a></li>
			<li class=""><a href="/service/">葬祭用品・サービス</a></li>
			<li class="blank"><a href="http://www.kawaguchishi-megurinomori.jp/" target="_blank">川口市めぐりの森</a></li>
			<li class="blank"><a href="https://www.nansai-pet.jp/" target="_blank">ペット火葬</a></li>
			<li class=""><a href="/company/">会社概要</a></li>
		</ul>
	</div>
	<div class="sp-menu header-sp sp-only">
		<div class="sp-menu-inner">
		<span></span>
		<span></span>
		<span></span>
		</div>
	</div>
	<div class="sp">
		<div class="sp-navi sp-only">
			<div class="sp-navi-inner">
				<ul class="sp-navi-list">
					<li class="sp-navi-item js-nabi-drop">
						<dl class="sp-navi-list-dl">
							<dt class="">葬儀費用・プラン</dt>
							<dd class="drop__txt" id="js-sp-header-tab">
								<a class="sp-tab" href="/plan/#tab_panel-1">
									<span>シンプル葬(直葬)</span><span>108,900円(税込)</span>
								</a>
								<a class="sp-tab" href="/plan/#tab_panel-2">
									<span>火葬式</span><span>173,800円(税込)</span>
								</a>
								<a class="sp-tab" href="/plan/#tab_panel-3">
									<span>1日葬</span><span>261,800円(税込)</span>
								</a>
								<a class="sp-tab" href="/plan/#tab_panel-4">
									<span>家族葬</span><span>327,800円(税込)</span>
								</a>
							</dd>
						</dl>
					</li>
					<li class="sp-navi-item"><a href="/about/">南彩会館の特徴</a></li>
					<li class="sp-navi-item"><a href="/service/">葬祭用品・サービス</a></li>
					<li class="sp-navi-item blank"><a href="http://www.kawaguchishi-megurinomori.jp/" target="_blank">川口市めぐりの森</a></li>
					<li class="sp-navi-item blank"><a href="https://www.nansai-pet.jp/" target="_blank">ペット火葬</a></li>
					<li class="sp-navi-item"><a href="/company/">会社概要</a></li>
					<li class="sp-navi-item"><a href="/contact/">お問い合わせ</a></li>
				</ul>
			</div>
		</div>
	</div>

</header>


<div class="contents contact">


	<!-- ------------------------lead------------------------ -->

	<h1>お問い合わせ</h1>

	<!-- ------------------------form------------------------ -->

	<div class="contact-wrap" id="form">

	<?php
				
			// エラーメッセージと不正アクセスフラグ
			$error_mes = "";
			$noindexaccess = true;

			// メアドに表示する名前
			define('WEBMST_NAME', '株式会社市民葬祭ホール 南彩会館');

			// お問い合わせ用メアド
			// define('WEBMST_MAIL', 'xxx@xxx.com');
			$domain = $_SERVER['HTTP_HOST'];
			// 本番と開発のメールアドレス振り分け
			if(strstr($domain,'nan-sai.com')==true) {
					define('WEBMST_MAIL', 'nansai0731@yahoo.co.jp');
			} else {
					// define('WEBMST_MAIL', 'nan-sai@test-adop.com');
					define('WEBMST_MAIL', 'nansai0731@yahoo.co.jp');
			}

			// 送信先メールアドレス
			$mailto = WEBMST_MAIL;
			
			#--------------------------------------------------------------
			# 全体のコントロール
			#--------------------------------------------------------------
			switch($_POST["action"]):
			
			case "thanks":
			/////////////////////////////////////////////////////////////////////////////
			//　メール送信処理と完了画面を表示
					
					include('check.php');
					if(!$error_mes){
							include('sendmail.php');
							include('thanks.php');
					}
					else{
							die("<p>エラーが発生しました。<br />もう一度送信しなおしてください。</p>");
					}
					break;
			case "confirm":
			/////////////////////////////////////////////////////////////////////////////
			// エラーがあれば再入力、なければ確認画面表示
					
					include('check.php');
					if($error_mes):
							include('input.php');
					else:
							include('confirm.php');
					endif;
			
					break;
			default:
			/////////////////////////////////////////////////////////////////////////////
			// 新規入力画面を表示
					include('input.php');
			
			endswitch;

	?>
	</div>

	<div class="contact-bottom">
		<div class="contact-bottom-box1">
			<div class="left">
				お急ぎの方は電話でのお問い合わせを<br>
				おすすめします。
			</div>
			<div class="right">
				<p class="tel-box-text1">シキュウイチバンゴクヨー</p>
				<a class="tel-box-link" href="tel:0120-491-594">0120-491-594</a>
			</div>
		</div>
		<div class="contact-bottom-box2">
			<p>お電話の際お知らせ頂く事</p>
			<ul>
				<li>●亡くなられた方のお名前</li>
				<li>●お迎えに伺う場所と時間</li>
				<li>●お話をくださった方のお名前</li>
				<li>●携帯電話など連絡のとれる電話番号</li>
				<li>●ご遺体を搬送する場所</li>
			</ul>
		</div>
	</div>

	<div class="contact-bottom2">
		<p>セルフセレモニー</p>
		<ul>
			<li>●持ち込み自由のホール</li>
			<li>●布団・毛布などの寝具用品</li>
			<li>●ドリンク・お菓子・サンドイッチ・おにぎり・お弁当など・出前も可
		</ul>
		<p>コスト削減しましょう。</p>
	</div>

	<div class="breadcrumb">
		<ul>
			<li><a href="/">TOP</a></li>
			<li>お問い合わせ</li>
		</ul>
	</div>

</div><!-- .contents閉じタグ -->	

	<!-- ーーーーーーーーーーーーーーーフッターーーーーーーーーーーーーーーー -->

	<footer class="footer">
		<div class="footer-inner">
			<div class="footer-logo-area">
				<p class="footer-logo"><a href="/"><img src="/img/common/footer-logo.png" alt="ロゴ画像"></a></p>
				<p class="footer-logo-funeral">
					<a href="https://www.eranda.jp/sogi/sogijo/nansaikaikan" target="_blank"><img src="/img/common/header-funeral.png" alt="ロゴ画像"></a>
				</p>
			</div>
			<ul class="footer-link">
				<li class=""><a href="/plan/">葬儀費用・プラン</a></li>
				<li class=""><a href="/about/">南彩会館の特徴</a></li>
				<li class=""><a href="/service/">葬祭用品・サービス</a></li>
				<li class="blank"><a href="http://www.kawaguchishi-megurinomori.jp/" target="_blank">川口市めぐりの森</a></li>
				<li class="blank"><a href="https://www.nansai-pet.jp/" target="_blank">ペット火葬</a></li>
				<li class=""><a href="/company/">会社概要</a></li>
				<li class=""><a href="/contact/">お問い合わせ</a></li>
			</ul>
			<div class="footer-copyright">
				<a class="privacy" href="/privacy/">プライバシーポリシー</a>
				<p class="copyright">© 2023 NANSAI</p>
			</div>
		</div>
		<a href="tel:0120-491-594" class="sp-tel">
			<div class="sp-tel-inner">
				<p class="tel-box-text1">シキュウイチバンゴクヨー</p>
				<p class="tel-box-link">0120-491-594</p>
				<p class="tel-box-text2">株式会社市民葬祭ホール</p>
			</div>
		</a>
	</footer>



	<script src="../js/jquery-3.3.1.min.js"></script>
	<script src="../js/common.js"></script>

</body>
</html>

