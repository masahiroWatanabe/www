<?php

/*******************************
 固定ページ お問い合わせ
 お問い合わせフォーム 確認画面
 *******************************/
// 不正アクセスチェック
if (!$noindexaccess) {
  header("HTTP/1.0 404 Not Found");
  exit();
} ?>

<script>
  //2重送信防止スクリプト
  var flg_Submit = false;

  function Fnk_DoubleSubmit() {
    if (flg_Submit) {
      alert("処理中です。");
      return false;
    } else {
      flg_Submit = true;
      return true;
    }
  }
</script>

<div class="contact-inner">
	<p class="contact-lead">以下の項目にご入力の上、「確認画面へ」ボタンを押してください。<span>[必須]</span>の項目は必ずご入力をお願いいたします。
	</p>
	<form action="#thanks" method="post" class="contact-form">
		<div class="form-block required">
			<div class="form-label required">
				<label for="">お名前</label>
			</div>
			<div class="form-input-verification">
				<input type="hidden" name="name" value="<?php echo $name; ?>"><p><?php echo $name; ?></p>
			</div>
		</div>
		<div class="form-block required">
			<div class="form-label required">
				<label for="">フリガナ</label>
			</div>
			<div class="form-input-verification">
			<input type="hidden" name="kana" value="<?php echo $kana; ?>"><p><?php echo $kana; ?></p>
			</div>
		</div>
		<div class="form-block required">
			<div class="form-label">
				<label for="">メールアドレス</label>
			</div>
			<div class="form-input-verification">
			<input type="hidden" name="email" value="<?php echo $email; ?>"><p><?php echo $email; ?></p>
			<input type="hidden" name="email2" value="<?php echo $email2; ?>">
			</div>
		</div>
		<div class="form-block required">
			<div class="form-label">
				<label for="">電話番号</label>
			</div>
			<div class="form-input-verification">
				<input type="hidden" name="tel" value="<?php echo $tel; ?>"><p><?php echo $tel; ?></p>
			</div>
		</div>
		<div class="form-block required top">
			<div class="form-label">
				<label for="">ご住所</label>
			</div>
			<div class="form-input-verification">
				<input type="hidden" name="postcode" value="<?php echo $postcode; ?>"><p>〒<?php echo $postcode; ?></p>
				<input type="hidden" name="address" value="<?php echo $address; ?>"><p><?php echo $address; ?></p>
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
						<input type="radio" name="cat" value="others"<?php if($cat == 'others') echo 'checked'; ?> >
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
			<div class="form-input-verification">
				<input type="hidden" name="message" value="<?php echo $message; ?>">
				<p><?php echo nl2br($message); ?></p>
			</div>
		</div>

		<div class="m-form-checkbox">
			<label>
				<input type="checkbox" name="agree" value="agreement" checked="checked">
				<span class="m-form-checkbox-name">
					<span class="m-form-checkbox-text">当社の個人情報保護方針に同意する。</span>
				</span>
			</label>
			<p class="text">※プライバシーポリシーは<br class="sp"><a href="/privacy/">こちら</a>よりご参照ください</p>
		</div>

		<div class="form-buttom-flex">
			<input type="hidden" name="action" value="thanks">
			<button type="submit" name="submit" value="送信する" class="entry">
				<span>情報を送信する</span>
			</button>
			<a href="javascript:history.back();" class="return">内容を確認する</a>
		</div>


	</form>

</div>
	