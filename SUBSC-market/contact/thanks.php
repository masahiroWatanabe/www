<?php
	// セッションを開始
	session_start();

	// エスケープ処理やデータチェックを行う関数のファイルの読み込み
	require '../libraries/functions.php';

	// メールアドレス等を記述したファイルの読み込み
	require '../libraries/mailvars.php';

	// お問い合わせ日時を日本時間に
	date_default_timezone_set('Asia/Tokyo');

	// POST されたデータをチェック
	$_POST = checkInput( $_POST );

	// 固定トークンを確認（CSRF対策）
	if ( isset( $_POST[ 'ticket' ], $_SESSION[ 'ticket' ] ) ) {
		$ticket = $_POST[ 'ticket' ];
		if ( $ticket !== $_SESSION[ 'ticket' ] ) {
			// トークンが一致しない場合は処理を中止
			$dirname = dirname( $_SERVER[ 'SCRIPT_NAME' ] );
			$dirname = ($dirname == DIRECTORY_SEPARATOR)? '' : $dirname;
			$url = ( empty( $_SERVER[ 'HTTPS' ] ) ? 'http://' : 'https://' ) . $_SERVER[ 'SERVER_NAME' ] . $dirname;
			header( 'HTTP/1.1 303 See Other' );
			header( 'location: ' . $url );
			exit;
		}
	} else {
		// トークンが存在しない場合は処理を中止（直接このページにアクセスするとエラーになる）
		// die( 'Access Denied（直接このページにはアクセスできません）' );
		$dirname = dirname( $_SERVER[ 'SCRIPT_NAME' ] );
		$dirname = $dirname == DIRECTORY_SEPARATOR ? '' : $dirname;
		$url = ( empty( $_SERVER[ 'HTTPS' ] ) ? 'http://' : 'https://' ) . $_SERVER[ 'SERVER_NAME' ] . $dirname;
		header( 'HTTP/1.1 303 See Other' );
		header( 'location: ' . $url );
		exit;
	}

	// メール本文の組み立て（お問い合わせ者用）
    $mail_body = MakeMailBody();

	//-------- sendmail（mb_send_mail）を使ったメールの送信処理------------

	/* ----- お問い合わせ者向け ----- */
	// メールの宛先（名前<メールアドレス> の形式）。
	$mailTo = mb_encode_mimeheader($_SESSION['name01']) .'<' . $_SESSION['mail'] . '>';

	// 件名
	$subject = MAIL_SUBJECT_CONTACT;

	// mbstringの日本語設定
	mb_language( 'ja' );
	mb_internal_encoding( 'UTF-8' );

	$headers = [
		'Return-Path' => STAFF_EMAIL,
		'From' => mb_encode_mimeheader(STAFF_NAME) .'<' . STAFF_EMAIL . '>',
		'Reply-To' => mb_encode_mimeheader(STAFF_NAME) .'<' . STAFF_EMAIL . '>',
	];
	array_walk( $headers, function( $_val, $_key ) use ( &$header_str ) {
		$header_str .= sprintf( "%s: %s \r\n", trim( $_key ), trim( $_val ) );
	} );

	// メール送信
	$result = mb_send_mail( $mailTo, $subject, $mail_body, $header_str );

	// お問い合わせ者へのメール送信が成功したら、担当者へも送る
	if( $result ) {
		// メール本文の組み立て（担当者用）
        $mail_body = MakeMailBody(1);

		/* ----- 担当者向け ----- */
		// メールの宛先（名前<メールアドレス> の形式）。
		$mailTo = mb_encode_mimeheader(STAFF_NAME) .'<' . STAFF_EMAIL . '>';

		// 件名
		$subject = MAIL_SUBJECT_STAFF;

		// mbstringの日本語設定
		mb_language( 'ja' );
		mb_internal_encoding( 'UTF-8' );

		$headers = [
			'Return-Path' => STAFF_EMAIL,
			'From' => mb_encode_mimeheader(STAFF_NAME) .'<' . STAFF_EMAIL . '>',
			'Reply-To' => mb_encode_mimeheader(STAFF_NAME) .'<' . STAFF_EMAIL . '>',
		];
		array_walk( $headers, function( $_val, $_key ) use ( &$header_str ) {
			$header_str .= sprintf( "%s: %s \r\n", trim( $_key ), trim( $_val ) );
		} );

		// メール送信
		mb_send_mail( $mailTo, $subject, $mail_body, $header_str );
	}

	// セッション破棄
    $_SESSION = array(); // 空の配列を代入し、すべてのセッション変数を消去
    session_destroy(); // セッションを破棄
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

		<h3 class="thanks-title">お問い合わせが送信されました　</h3>

		<p class="thanks-text">お問い合わせいただき、<br class="sp">ありがとうございます。<br>
			お問い合わせ頂いた内容については、<br class="sp">確認の上、担当者より<br class="sp">ご連絡させていただきます。
		</p>

		<div class="thanks-back"><a href="./">トップページに戻る</a></div>
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

