<?php
/*******************************
 固定ページ お問い合わせ
 お問い合わせフォーム メール送信
*******************************/
// 不正アクセスチェック
if(!$noindexaccess){
    header("HTTP/1.0 404 Not Found");exit();
}

mb_language("ja");
mb_internal_encoding("UTF-8");

#-------------------------------------------------------------------------------------------
# メール送信処理１（お客様への返信メール）
#-------------------------------------------------------------------------------------------
// メール本文
$mailbody = $name . "様" . "\n\n";
$mailbody .= "この度はお問い合わせ頂き、誠にありがとうございます。"."\n"."下記内容でお問い合わせを受付致しました。"."\n\n";
$mailbody .= "担当者よりご連絡させていただきますの少々お待ち下さい"."\n\n";
$mailbody .= "【お問い合わせ内容】"."\n";
$mailbody .= "お名前：" . $name . "\n";
$mailbody .= "ふりがな：" . $kana . "\n";
$mailbody .= "メールアドレス： $email" . "\n";
$mailbody .= "電話番号： $tel" . "\n";
$mailbody .= "ご住所：" . "\n" . "〒" . $postcode . " " . $address . "\n";
$mailbody .= "お問い合わせ項目：" . $cat_label . "\n";
$mailbody .= "お問い合わせ内容：\n";
$mailbody .= $message;
$mailbody .= "
----------------------------------------------------------

株式会社市民葬祭ホール 南彩会館
https://nan-sai.com

----------------------------------------------------------";
 
// 件名とフッター
$headers = "Reply-To: ".mb_encode_mimeheader(WEBMST_NAME)."<".WEBMST_MAIL.">\n";
$headers .= "Return-Path: ".WEBMST_MAIL."<".WEBMST_MAIL.">\n";
$headers .= "From: ".mb_encode_mimeheader(WEBMST_NAME)."<".WEBMST_MAIL.">\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-Transfer-Encoding: BASE64\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\n";
$subject = "お問い合わせありがとうございます";
 
// メール送信（失敗時：強制終了）
$usrmail_result = mb_send_mail($email,$subject,$mailbody,$headers);
if(!$usrmail_result)die("お客様へのメール送信に失敗しました。<br />\n
                         誠に申し訳ございませんがこちらまでご連絡ください。“".WEBMST_MAIL."”");

#-------------------------------------------------------------------------------------------
# メール送信処理２（送信先は $mailto宛）
#-------------------------------------------------------------------------------------------
 
// Headerとbodyとsubjectを設定（送信元はお客様 $email）
$headers = "Reply-To: ".mb_encode_mimeheader(WEBMST_NAME)."<".$email.">\n";
$headers .= "Return-Path: ".mb_encode_mimeheader(WEBMST_NAME)."<".$email.">\n";
$headers .= "From: ".mb_encode_mimeheader(WEBMST_NAME)."<".$email.">\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-Transfer-Encoding: BASE64\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\n";

// 件名を設定
$subject = "WEBサイトからお問い合わせがありました";
 
// メール本文
$mailbody = "WEBサイトからお問い合わせがありました。". "\n"."内容を確認し、ご対応お願い致します。" . "\n\n";
$mailbody .= "■お問い合わせ内容" . "\n";
$mailbody .= "お名前：" . $name . "\n";
$mailbody .= "ふりがな：" . $kana . "\n";
$mailbody .= "メールアドレス： $email" . "\n";
$mailbody .= "電話番号： $tel" . "\n";
$mailbody .= "ご住所：" . "\n" . "〒" . $postcode . " " . $address . "\n";
$mailbody .= "お問い合わせ項目：" . $cat_label . "\n";
$mailbody .= "お問い合わせ内容：\n";
$mailbody .= $message;

// メール送信実行
if(!empty($mailto)){
    $sendmail_result = mb_send_mail($mailto,$subject,$mailbody,$headers);
     
    if(!$sendmail_result){
        die("<p>メール送信に失敗しました。<br>\n誠に申し訳ございませんが最初から操作をやり直してください。</p>");
    }
}
else{
    die("<p>メールを送信する事が出来ませんでした。<br>\n誠に申し訳ございませんが“".WEBMST_MAIL."”へ直接メールにて<br>お問い合わせしていただけますようお願い申し上げます。</p>");
}
?>