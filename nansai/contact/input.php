
<?php
/*******************************
 固定ページ お問い合わせ
 お問い合わせフォーム 入力画面
*******************************/
// 不正アクセスチェック
if(!$noindexaccess){
    header("HTTP/1.0 404 Not Found");exit();
}
?>

<div class="contact-inner">
  <p class="contact-lead">以下の項目にご入力の上、「確認画面へ」ボタンを押してください。<span>[必須]</span>の項目は必ずご入力をお願いいたします。
  </p>
  <form name="toiawase" action="#form" enctype="multipart/form-data" method="post" class="contact-form">
    <div class="form-block required">
      <div class="form-label required">
        <label for="">お名前</label>
      </div>
      <div class="form-input">
        <input type="text" placeholder="例 )　南彩太郎" name="name" value="<?php echo ($name)?$name:"";?>">
        <span class="error"><?php echo $name_error ? $name_error : '';?></span>
      </div>
    </div>
    <div class="form-block required">
      <div class="form-label required">
        <label for="">フリガナ</label>
      </div>
      <div class="form-input">
        <input type="text" placeholder="例 )　ナンサイタロウ" name="kana" value="<?php echo ($kana)?$kana:"";?>">
        <span class="error"><?php echo $kana_error ? $kana_error : '';?></span>
      </div>
    </div>
    <div class="form-block required">
      <div class="form-label">
        <label for="">メールアドレス</label>
      </div>
      <div class="form-input">
        <input type="text" placeholder="例 )　info@nansai.co.jp" name="email" value="<?php echo ($email)?$email:"";?>">
        <span class="error"><?php echo $email_error ? $email_error : '';?></span>
      </div>
    </div>
    <div class="form-block required">
      <div class="form-label">
        <label for="">メールアドレス(確認用)</label>
      </div>
      <div class="form-input">
        <input type="text" placeholder="例 )　info@nansai.co.jp" name="email2" value="<?php echo ($email2)?$email2:"";?>">
        <span class="error"><?php echo $email2_error ? $email2_error : '';?></span>
      </div>
    </div>
    <div class="form-block required">
      <div class="form-label">
        <label for="">電話番号</label>
      </div>
      <div class="form-input">
        <input type="text" placeholder="例 )　048-284-5252" name="tel" value="<?php echo ($tel)?$tel:"";?>">
        <span class="error"><?php echo $tel_error ? $tel_error : '';?></span>
      </div>
    </div>
    <div class="form-block required top">
      <div class="form-label">
        <label for="">ご住所</label>
      </div>
      <div class="form-input">
        <i>〒</i><input type="text" placeholder="333-0833" name="postcode" value="<?php echo ($postcode)?$postcode:"";?>" class="wide-quarter">
        <span class="error"><?php echo $postcode_error ? $postcode_error : '';?></span>

        <input type="text" placeholder="例 )　埼玉県川口市西新井宿443" name="address" value="<?php echo ($address)?$address:"";?>">
        <span class="error"><?php echo $address_error ? $address_error : '';?></span>
      </div>
    </div>
    <div class="form-block">
      <div class="form-label">
        <label for="">お問い合わせ項目</label>
      </div>
      <div class="m-form-radio-wrap">
        <div class="m-form-radio">
          <label>
            <input type="radio" name="cat" value="reservation"<?php if($cat == '' || $cat == 'reservation') echo ' checked'; ?>>
            <span class="m-form-radio-name">
              <span class="m-form-radio-text">予約について</span>
            </span>
          </label>
        </div>
        <div class="m-form-radio">
          <label>
            <input type="radio" name="cat" value="content"<?php if($cat == 'content') echo ' checked'; ?>>
            <span class="m-form-radio-name">
              <span class="m-form-radio-text">内容について</span>
            </span>
          </label>
        </div>
        <div class="m-form-radio">
          <label>
            <input type="radio" name="cat" value="others"<?php if($cat == 'others') echo 'checked'; ?>>
            <span class="m-form-radio-name">
              <span class="m-form-radio-text">その他</span>
            </span>
          </label>
        </div>
      </div>
    </div>
    <div class="form-block required last-type top">
      <div class="form-label">
        <label for="">お問い合わせ内容</label>
      </div>
      <div class="form-input half textarea-box">
        <textarea class="input-txt" rows="5" name="message" autocorrect="off" autocapitalize="off" placeholder="お問い合わせ内容をご自由にご記入ください"><?php echo ($message)?$message:"";?></textarea>
        <span class="error"><?php echo $message_error ? $message_error : '';?></span>
      </div>
    </div>

    <div class="m-form-checkbox">
      <label>
        <input type="checkbox" name="agree" value="agreement">
        <span class="m-form-checkbox-name">
          <span class="m-form-checkbox-text">当社の個人情報保護方針に同意する。</span>
        </span>
      </label>
      <p class="text">※プライバシーポリシーは<br class="sp"><a href="/privacy/">こちら</a>よりご参照ください</p>
    </div>

    <div class="form-buttom">
      <div id="confirmBtnWrap" class="confirm-btn-wrap">
        <input type="hidden" name="action" value="confirm">
        <input id="submitButton" type="submit" name="submit" class="confirm-btn" value="入力内容を確認する">
        <input type="hidden" name="ticket" value="">
      </div>
    </div>

  </form>

</div>