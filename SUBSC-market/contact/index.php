<?php
	// セッションを開始
	session_start();

	// セッションIDを更新して変更（セッションハイジャック対策）
	session_regenerate_id( TRUE );

	// エスケープ処理やデータチェックを行う関数のファイルの読み込み
	require '../libraries/functions.php';

	// フォームに関する定数を記述したファイルの読み込み
	require '../libraries/formvars.php';

	// 初回以外ですでにセッション変数に値が代入されていれば、その値を。そうでなければNULLで初期化
	$type = isset( $_SESSION[ 'type' ] ) ? $_SESSION[ 'type' ] : NULL;
	$name01 = isset( $_SESSION[ 'name01' ] ) ? $_SESSION[ 'name01' ] : NULL;
	$mail = isset( $_SESSION[ 'mail' ] ) ? $_SESSION[ 'mail' ] : NULL;
	$mail_verification = isset( $_SESSION[ 'mail_verification' ] ) ? $_SESSION[ 'mail_verification' ] : NULL;
	$tel = isset( $_SESSION[ 'tel' ] ) ? $_SESSION[ 'tel' ] : NULL;
	$company = isset( $_SESSION[ 'company' ] ) ? $_SESSION[ 'company' ] : NULL;
	$department = isset( $_SESSION[ 'department' ] ) ? $_SESSION[ 'department' ] : NULL;
	$url = isset( $_SESSION[ 'url' ] ) ? $_SESSION[ 'url' ] : NULL;
	$content = isset( $_SESSION[ 'content' ] ) ? $_SESSION[ 'content' ] : NULL;

	// 入力セッションを破棄
	unset( $_SESSION[ 'type' ] );
	unset( $_SESSION[ 'name01' ] );
	unset( $_SESSION[ 'mail' ] );
	unset( $_SESSION[ 'mail_verification' ] );
	unset( $_SESSION[ 'tel' ] );
	unset( $_SESSION[ 'company' ] );
	unset( $_SESSION[ 'department' ] );
	unset( $_SESSION[ 'url' ] );
	unset( $_SESSION[ 'content' ] );

	// エラーを定義
	$error = isset( $_SESSION[ 'error' ] ) ? $_SESSION[ 'error' ] : NULL;
	// エラーのセッションを破棄
	unset( $_SESSION[ 'error' ] );

	// 個々のエラーを初期化（$error は定義されていれば配列）
	$error_type = isset( $error['type'] ) ? $error[ 'type' ] : NULL;
	$error_name01 = isset( $error['name01'] ) ? $error[ 'name01' ] : NULL;
	$error_mail = isset( $error['mail'] ) ? $error[ 'mail' ] : NULL;
	$error_mail_verification = isset( $error['mail_verification'] ) ? $error[ 'mail_verification' ] : NULL;
	$error_tel = isset( $error['tel'] ) ? $error[ 'tel' ] : NULL;
	$error_content = isset( $error['content'] ) ? $error[ 'content' ] : NULL;

	// CSRF対策の固定トークンを生成
	if ( !isset( $_SESSION[ 'ticket' ] ) ) {
		// セッション変数にトークンを代入
		$_SESSION[ 'ticket' ] = sha1( uniqid( mt_rand(), TRUE ) );
	}

	// トークンを変数に代入
	$ticket = $_SESSION[ 'ticket' ];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SUBSC MARKET</title>
	<meta name="description" content="SXで企業価値の最大化と持続可能なモデルを実現。誰もが簡単にSX事業に参入できるマーケットプレイスを提供。既存サービスプロダクトへの変革をもたらし、事業発展を加速させ企業価値の最大化を図ります。">
	<meta name="keywords" content="">
	<meta name="format-detection" content="telephone=no">
	<link type="text/css" rel="stylesheet" href="../css/reset.css">
	<link type="text/css" rel="stylesheet" href="../css/swiper.min.css">
	<link type="text/css" rel="stylesheet" href="../css/style.css">
	<link rel="icon" type="image/x-icon" href="../img/common/favicon.ico">

	<meta property="og:title" content="SUBSC MARKET">
	<meta property="og:url" content="../img/common/OGP_market.png">
	<meta property="og:type" content="website">
	<meta property="og:description" content="SXで企業価値の最大化と持続可能なモデルを実現。誰もが簡単にSX事業に参入できるマーケットプレイスを提供。既存サービスプロダクトへの変革をもたらし、事業発展を加速させ企業価値の最大化を図ります。">
	<meta property="og:image" content="../img/common/OGP_market.png">
	<meta name="twitter:card" content="summary">
	<meta name="twitter:image:src" content="../img/common/OGP_market.png">

	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@400;500;700&family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>

<!-- ーーーーーーーーーーーーーーーヘッダーーーーーーーーーーーーーーーー -->

<header id="header" class="header">
	<h1><a href="../"></a></h1>
	<div id="js-header-menu" class="menu-wrap">
		<div class="menu-wrap-inner">
			<div class="menu">
				<span></span>
				<span></span>
				<span></span>
			</div>
			<div class="menu-text">MENU</div>
		</div>
		
	</div>

	<div class="navi">
		<div class="navi-item">
			<p><a href="../">TOP</a></p>
		</div>
		<div class="navi-item">
			<p><a href="../about/">ABOUT</a></p>
		</div>
		<div class="navi-item">
			<p><a href="../service/">SERVICE</a></p>
		</div>
		<div class="navi-item">
			<p><a href="../company/">COMPANY</a></p>
		</div>
		<div class="navi-item">
			<p><a href="../recruit/">RECRUIT</a></p>
		</div>
		<div class="navi-item">
			<p><a href="../news/">NEWS</a></p>
		</div>
		<div class="navi-btn">
			<a href="../contact/index.php">CONTACT</a>
		</div>
	</div>
</header>

<div class="contents contact">

	<!-- ーーーーーーーーーーーーーーーメインビジュアルーーーーーーーーーーーーーーー -->

	<div class="common-mv contact-mv" title="CONTACT お問い合わせ">
		<div class="common-mv-inner">
			<div class="common-mv-title">
				<h2>CONTACT</h2>
				<small>お問い合わせ</small>
			</div>
		</div>
	</div>


	<!-- ーーーーーーーーーーーーーーーコンテンツーーーーーーーーーーーーーーー -->

	<div class="entry-inner">

		<h3 class="entry-title">お問い合わせフォーム</h3>

		<form action="confirm.php" method="post" class="contact-form">
			<div class="form-block required">
				<div class="form-label">
					<label for="">お問い合わせ種別</label>
				</div>
				<div class="m-form-radio-wrap">
					<?php foreach(CONTACT_TYPE as $contact_type): ?>
						<div class="m-form-radio">
							<label>
								<input type="radio" name="type" value="<?php echo $contact_type; ?>" <?php echo (h($type) == $contact_type)? 'checked' : '' ?> required="">
								<span class="m-form-radio-name">
									<span class="m-form-radio-text"><?php echo $contact_type; ?></span>
								</span>
							</label>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

			<div class="form-block required">
				<div class="form-label">
					<label for="name01">氏名</label>
				</div>
				<div class="form-input half">
					<input type="text" placeholder="例）山田太郎" name="name01" id="name01" value="<?php echo h($name01); ?>" required="">
					<span class="error"></span>
				</div>
			</div>

			<!-- <div class="form-block required">
				<div class="form-label">
					<label for="">ふりがな</label>
				</div>
				<div class="form-input half">
					<input type="text" placeholder="" name="name02" value="" required="">
					<span class="error"></span>
				</div>
			</div> -->

			<div class="form-block required">
				<div class="form-label">
					<label for="mail">メールアドレス</label>
				</div>
				<div class="form-input half">
					<input type="email" placeholder="例）sample@email.com" name="mail" id="mail" value="<?php echo h($mail); ?>" required="">
					<span class="error"></span>
				</div>
			</div>

			<div class="form-block required">
				<div class="form-label">
					<label for="mail_verification">メールアドレス(確認)</label>
				</div>
				<div class="form-input half">
					<input type="email" placeholder="" name="mail_verification" id="mail_verification" value="<?php echo h($mail_verification); ?>" required="">
					<span class="error"></span>
				</div>
			</div>

			<div class="form-block required">
				<div class="form-label">
					<label for="tel">電話番号</label>
				</div>
				<div class="form-input half">
					<input type="tel" placeholder="例）090-1234-5678" name="tel" id="tel" value="<?php echo h($tel); ?>" required="">
					<span class="error"></span>
				</div>
			</div>

			<div class="form-block">
				<div class="form-label">
					<label for="company">会社名</label>
				</div>
				<div class="form-input half">
					<input type="text" placeholder="例）○○○○株式会社" name="company" id="company" value="<?php echo h($company); ?>">
					<span class="error"></span>
				</div>
			</div>

			<div class="form-block">
				<div class="form-label">
					<label for="department">部署名</label>
				</div>
				<div class="form-input half">
					<input type="text" placeholder="例）○○○○部" name="department" id="department" value="<?php echo h($department); ?>">
					<span class="error"></span>
				</div>
			</div>

			<div class="form-block">
				<div class="form-label">
					<label for="url">URL</label>
				</div>
				<div class="form-input half">
					<input type="url" placeholder="例）https://sample.co.jp" name="url" id="url" value="<?php echo h($url); ?>">
					<span class="error"></span>
				</div>
			</div>

			<div class="form-block required">
				<div class="form-label last-child">
					<label for="content">お問い合わせ内容</label>
				</div>
				<div class="form-input half textarea-box">
					<textarea class="input-txt" rows="10" name="content" id="content" autocorrect="off" autocapitalize="off" placeholder="" required=""><?php echo h($content); ?></textarea>
					<span class="error"></span>
				</div>
			</div>

			<div class="m-form-checkbox">
				<label>
					<input type="checkbox" name="agree" value="agreement"  required="">
					<span class="m-form-checkbox-name">
						<span class="m-form-checkbox-text"><a href="../privacy/">プライバシーポリシー</a>について<br class="sp">同意の上、送信します。</span>
					</span>
				</label>
			</div>

			<div class="form-buttom">
				<div class="confirm-wrap">
					<input type="submit" name="confirm" class="confirm-btn" value="入力内容を確認する">
					<input type="hidden" name="ticket" value="<?php echo h($ticket); ?>">
				</div>
			</div>
		</form>

	</div>

</div>

<!-- ーーーーーーーーーーーーーーーパンくずーーーーーーーーーーーーーーーー -->

<div class="breadcrumb">
	<ul class="breadcrumb-list">
		<li><a href="../"><img src="../img/common/icon-home.png" class="breadcrumb-home" alt="home"></a></li>
		<li>お問い合わせ</li>
	</ul>
</div>

<!-- ーーーーーーーーーーーーーーーCONTACTーーーーーーーーーーーーーーーー -->

<div class="common-contact">
	<div class="common-contact-inner">
		<p class="common-contact-text">お気軽にお問い合わせください。</p>
		<h3>CONTACT</h3>
		<a href="../contact/index.php" class="contact-btn allow">お問い合わせ・ご相談</a>
	</div>
</div>

<!-- ーーーーーーーーーーーーーーーフッターーーーーーーーーーーーーーーー -->

<footer class="footer">
	<div class="footer-inner">
		<p class="footer-logo"><a href="http://subsuc-market.co.jp/" target="_blank"><img src="../img/common/footer-logo-market.png" alt="logo"></a></p>
		<ul class="footer-list">
			<li><a href="../about/">ABOUT</a></li>
			<li><a href="../service/">SERVICE</a></li>
			<li><a href="../company/">COMPANY</a></li>
			<li><a href="../recruit/">RECRUIT</a></li>
			<li><a href="../news/">NEWS</a></li>
			<li class="sp"><a href="../privacy/">PRIVACY POLICY</a></li>
		</ul>

		<ul class="footer-list2">
			<li class="list-01"><a href="http://subsc-studio.co.jp/" target="_blank"><img src="../img/common/footer-list2-studio.png" alt="logo"></a></li>
			<li class="list-02"><a href="http://subsc-bpo.co.jp/" target="_blank"><img src="../img/common/footer-list2-bpo.png" alt="logo"></a></li>
			<li class="list-03"><a href="http://subsc-salespartner.co.jp/" target="_blank"><img src="../img/common/footer-list2-salespartner.png" alt="logo"></a></li>
		</ul>

		<div class="footer-logo-text">
			<p class="footer-logo-text-logo"><a href="https://next-future-holdings.co.jp/" target="_blank"><img src="../img/common/footer-logo.png" alt="logo"></a></p>
			<p class="footer-logo-text-text">
				サブスクリプション型モデルに<br>
				必要なすべての業務を支援します。</p>
		</div>

	</div>
	<a href="#" class="page-top"></a>
</footer>

<div class="copyright">
	<div class="copyright-inner">
		<a href="../privacy/" class="copyright-Privacy pc">PRIVACY POLICY</a>
		<small class="copyright-text">©Next Future Holdings Co., Ltd</small>
	</div>
</div>

<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/common.js"></script>

</body>
</html>

