<?php
	// セッションを開始
	session_start();

	// エスケープ処理やデータチェックを行う関数のファイルの読み込み
	require '../libraries/functions.php';

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
		$dirname = dirname( $_SERVER[ 'SCRIPT_NAME' ] );
		$dirname = ($dirname == DIRECTORY_SEPARATOR)? '' : $dirname;
		$url = ( empty( $_SERVER[ 'HTTPS' ] ) ? 'http://' : 'https://' ) . $_SERVER[ 'SERVER_NAME' ] . $dirname;
		header( 'HTTP/1.1 303 See Other' );
		header( 'location: ' . $url );
		exit;
	}

	// POSTされたデータを変数に代入
	$type = isset( $_POST[ 'type' ] ) ? $_POST[ 'type' ] : NULL;
	$name01 = isset( $_POST[ 'name01' ] ) ? $_POST[ 'name01' ] : NULL;
	$mail = isset( $_POST[ 'mail' ] ) ? $_POST[ 'mail' ] : NULL;
	$mail_verification = isset( $_POST[ 'mail_verification' ] ) ? $_POST[ 'mail_verification' ] : NULL;
	$tel = isset( $_POST[ 'tel' ] ) ? $_POST[ 'tel' ] : NULL;
	$company = isset( $_POST[ 'company' ] ) ? $_POST[ 'company' ] : NULL;
	$department = isset( $_POST[ 'department' ] ) ? $_POST[ 'department' ] : NULL;
	$url = isset( $_POST[ 'url' ] ) ? $_POST[ 'url' ] : NULL;
	$content = isset( $_POST[ 'content' ] ) ? $_POST[ 'content' ] : NULL;

	// エラーメッセージを保存する配列の初期化
	$error = array();

	// 値の検証（入力内容が条件を満たさない場合はエラーメッセージを配列 $error に設定）
	if( $type == '' ){
		$error['type'] = 'お問い合わせ種別を選択してください';
	}
	if ( $name01 == '' ) {
		$error['name01'] = '氏名が未入力です';
	}
	if ( $mail == '' ) {
		$error['mail'] = 'メールアドレスが未入力です';
	} else { // メールアドレスを正規表現でチェック
		$pattern = '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/uiD';
		if ( !preg_match( $pattern, $mail ) ) {
			$error['mail'] = 'メールアドレスの形式が正しくありません';
		}
	}
	if ( $mail_verification == '' ) {
		$error['mail_verification'] = 'メールアドレス(確認用)が未入力です';
	} else { // メールアドレスを正規表現でチェック
		$pattern = '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/uiD';

		if($mail !== $mail_verification) {
			$error['mail_verification'] = '入力されましたメールアドレスと一致しません';
		} elseif ( !preg_match( $pattern, $mail_verification ) ) {
			$error['mail_verification'] = 'メールアドレスの形式が正しくありません';
		}
	}
	if ( $tel == '' ) {
		$error['tel'] = '電話番号が未入力です';
	}
	if ( $content == '' ) {
		$error['content'] = 'お問い合わせ内容が未入力です';
	}

	//POSTされたデータとエラーの配列をセッション変数に保存
	$_SESSION[ 'type' ] = $type;
	$_SESSION[ 'name01' ] = $name01;
	$_SESSION[ 'mail' ] = $mail;
	$_SESSION[ 'mail_verification' ] = $mail_verification;
	$_SESSION[ 'tel' ] = $tel;
	$_SESSION[ 'company' ] = $company;
	$_SESSION[ 'department' ] = $department;
	$_SESSION[ 'url' ] = $url;
	$_SESSION[ 'content' ] = $content;

	$_SESSION[ 'error' ] = $error;

	// チェックの結果にエラーがある場合は入力フォームに戻す
	if ( count( $error ) > 0 ) {
		// エラーがある場合
		$dirname = dirname( $_SERVER[ 'SCRIPT_NAME' ] );
		$dirname = ($dirname == DIRECTORY_SEPARATOR)? '' : $dirname;
		$url = ( empty( $_SERVER[ 'HTTPS' ] ) ? 'http://' : 'https://' ) . $_SERVER[ 'SERVER_NAME' ] . $dirname;
		header( 'HTTP/1.1 303 See Other' );
		header( 'location: ' . $url );
		exit;
	}
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

		<h3 class="confirm-title">以下の内容で送信してよろしいですか？</h3>

		<div class="contact-form">
			<div class="form-contact-confirm-block">
				<div class="form-confirm-block-label">お問い合わせ種別</div>
				<div class="form-confirm-block-text"><?php echo $type; ?></div>
			</div>
			<div class="form-contact-confirm-block">
				<div class="form-confirm-block-label">氏名</div>
				<div class="form-confirm-block-text"><?php echo $name01; ?></div>
			</div>
			<div class="form-contact-confirm-block">
				<div class="form-confirm-block-label">メールアドレス</div>
				<div class="form-confirm-block-text"><?php echo $mail; ?></div>
			</div>
			<div class="form-contact-confirm-block">
				<div class="form-confirm-block-label">電話番号</div>
				<div class="form-confirm-block-text"><?php echo $tel; ?></div>
			</div>
			<div class="form-contact-confirm-block">
				<div class="form-confirm-block-label">会社名</div>
				<div class="form-confirm-block-text"><?php echo $company; ?></div>
			</div>
			<div class="form-contact-confirm-block">
				<div class="form-confirm-block-label">部署名</div>
				<div class="form-confirm-block-text"><?php echo $department; ?></div>
			</div>
			<div class="form-contact-confirm-block">
				<div class="form-confirm-block-label">URL</div>
				<div class="form-confirm-block-text"><?php echo $url; ?></div>
			</div>
			<div class="form-contact-confirm-block">
				<div class="form-confirm-block-label">お問い合わせ内容</div>
				<div class="form-confirm-block-text"><?php echo $content; ?></div>
			</div>

			<div class="form-buttom split">
				<div class="return-btn">
					<form action="index.php" name="form-fix" method="post">
						<a href="javascript:document.forms['form-fix'].submit()">
							<p class="text1">戻る</p>
						</a>
					</form>
				</div>
				<div class="confirm-wrap">
					<form action="thanks.php" name="form-send" method="post">
						<input type="hidden" name="ticket" value="<?php echo h($ticket); ?>">
						<input type="submit" name="confirm" class="confirm-btn" value="送信する">
					</form>
				</div>
			</div>
		</div>

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

