<?php
/************************************
メール処理に関する定数一覧
************************************/
// SMTPホスト名
define('SMTP_HOST', '');
// お問い合わせ送信・受信メールアドレス
define('STAFF_EMAIL', '');
// パスワード
define('STAFF_EMAIL_PASSWORD', '');
// お問い合わせ送信名
define('STAFF_NAME', '');
// Return-Pathに指定するメールアドレス
define('MAIL_RETURN_PATH', STAFF_EMAIL);
// 自動返信の返信先（自動返信を設定する場合）
define('REPLY_TO_EMAIL', STAFF_EMAIL);
// 自動返信の返信先名前（自動返信を設定する場合）
define('REPLY_TO_NAME', STAFF_NAME);
// メールタイトル（お問い合わせ者用）
define('MAIL_SUBJECT_CONTACT', '');
// メールタイトル（担当者用）
define('MAIL_SUBJECT_STAFF', '');


/************************************
メール本文作成
************************************/
function MakeMailBody( $staff_flg = 0 ) {
    // 変数にエスケープ処理したセッション変数の値を代入
    $type = h( $_SESSION[ 'type' ] );
	$name01 = h( $_SESSION[ 'name01' ] );
	$mail = h( $_SESSION[ 'mail' ] );
	$mail_verification = h( $_SESSION[ 'mail_verification' ] );
	$tel = h( $_SESSION[ 'tel' ] );
	$company = h( $_SESSION[ 'company' ] );
	$department = h( $_SESSION[ 'department' ] );
	$url = h( $_SESSION[ 'url' ] );
	$content = h( $_SESSION[ 'content' ] );

    // メール本文
    if($staff_flg) {
        // 担当者用
        $mail_content1 = '' . PHP_EOL;
    } else {
        // お問い合わせ者用
        $mail_content1 = $name01 . '様' . PHP_EOL;
        $mail_content1 .= PHP_EOL;
        $mail_content1 .= '' . PHP_EOL;

    }

    $mail_content2 = PHP_EOL;
    $mail_content2 .= '【 お問い合わせ種別 】' . PHP_EOL;
    $mail_content2 .= $type . PHP_EOL;
    $mail_content2 .= PHP_EOL;
    $mail_content2 .= '【 氏名 】' . PHP_EOL;
    $mail_content2 .= $name01 . PHP_EOL;
    $mail_content2 .= PHP_EOL;
    $mail_content2 .= '【メールアドレス】' . PHP_EOL;
    $mail_content2 .= $mail . PHP_EOL;
    $mail_content2 .= PHP_EOL;
    $mail_content2 .= '【電話番号】' . PHP_EOL;
    $mail_content2 .= $tel . PHP_EOL;
    $mail_content2 .= PHP_EOL;
    $mail_content2 .= '【会社名】' . PHP_EOL;
    $mail_content2 .= $company . PHP_EOL;
    $mail_content2 .= PHP_EOL;
    $mail_content2 .= '【部署名】' . PHP_EOL;
    $mail_content2 .= $department . PHP_EOL;
    $mail_content2 .= PHP_EOL;
    $mail_content2 .= '【URL】' . PHP_EOL;
    $mail_content2 .= $url . PHP_EOL;
    $mail_content2 .= PHP_EOL;
    $mail_content2 .= '【お問い合わせ内容】' . PHP_EOL;
    $mail_content2 .= $content . PHP_EOL;

    $mail_body = $mail_content1 . $mail_content2;

    return $mail_body;
}
