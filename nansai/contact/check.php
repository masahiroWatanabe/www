<?php
/*******************************
 固定ページ お問い合わせ
 お問い合わせフォーム 文字列チェック
*******************************/
// 不正アクセスチェック
if(!$noindexaccess){
    header("HTTP/1.0 404 Not Found");exit();
}

/* 危険文字列置換ファンクション */
function Chk_StrMode($str){
 
    // タグを除去
    $str = strip_tags($str);
    // 空白を除去
    $str = mb_ereg_replace("^(　){0,}","",$str);
    $str = mb_ereg_replace("(　){0,}$","",$str);
    $str = trim($str);
    // 特殊文字を HTML エンティティに変換する
    $str = htmlspecialchars($str);
     
    return $str;
}
/* 未入力チェックファンクション */
function Chk_InputMode($sub, $str){  
    // $errmes = "";
    // if($str == ""){$errmes .= "<p>{$mes}</p>";}
    // return $errmes;
    $errmes = "";
    if($str == ""){
        // $errmes .= "※" . $sub . "を正しく入力してください";
        $errmes .= "※情報を正しく入力してください";
    }
    return $errmes;
}
 
/* メールアドレスチェックファンクション 2017.9.1現在 参考サイト：http://wepicks.net/phpsample-preg-mail/ */
function CheckEmailAddress($sMailaddress) {
    if(preg_match('/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD', $sMailaddress)){
        list($username,$domain)=explode('@',$sMailaddress);
        if(!checkdnsrr($domain,'MX')){
            return false;
        }
    return true;
    }
return false;
}

function confirmEmailAddress($str1, $str2) {
    $errmes = "";
    if($str1 !== $str2) {
        $errmes = "※メールアドレスが一致しません";
    }
    return $errmes;
}
 
#----------------------------------------------------------------------------------
# データの受け取りと危険文字列置換  ※Chk_StrMode(文字列);
#----------------------------------------------------------------------------------
$param = array();
 
// 引数を元に文字列処理及び変換処理を行う
foreach($_POST as $k=>$e):
    if(is_array($e)) {
     $e = implode( ", ", $e);
    }
    $params[$k] = Chk_StrMode($e);
endforeach;
 
// 変数に入れる
extract($params);
 
#----------------------------------------------------------------------------------
# エラーチェック   ※Chk_InputMode(文字列,モード,エラーメッセージ);
#----------------------------------------------------------------------------------


if(is_array($_POST['type'])) {
  $type = implode( ", ", $_POST['type']);
}

// $type_error = Chk_InputMode($type);
$name_error = Chk_InputMode('お名前', $name);
$kana_error = Chk_InputMode('フリガナ', $kana);
$email_error = Chk_InputMode('メールアドレス', $email);
$email2_error = Chk_InputMode('メールアドレス(確認用)', $email2);
$tel_error = Chk_InputMode('電話番号', $tel);
$postcode_error = Chk_InputMode('〒', $postcode);
$address_error = Chk_InputMode('住所', $address);
$cat_error = Chk_InputMode('お問い合わせ項目', $cat);
$message_error = Chk_InputMode('お問い合わせ内容', $message);
 
// メールアドレスチェック
if($email){ 
    if(CheckEmailAddress($email) != true){
        $email_error .= "※メールアドレスの形式に誤りがあります。<br>";
    }
}

if($email2) {
    $email2_error = Chk_InputMode('メールアドレス確認', $email2);
    if(CheckEmailAddress($email2) != true){
        $email2_error .= "※メールアドレスの形式に誤りがあります。<br>";
    }
    $email_error .= confirmEmailAddress($email, $email2);
    $email2_error .= confirmEmailAddress($email, $email2);
}

if($cat == 'reservation') {
  $cat_label = '予約について';
} else if($cat == 'content') {
  $cat_label = '内容について';
} else {
  $cat_label = 'その他';
}

// $location_error = ($pref_error || $address_error) ? "※情報を正しく入力してください" : "";
$error_mes = $name_error . $kana_error . $email_error .$email2_error . $tel_error . $address_error . $cat_error . $message_error;
?>