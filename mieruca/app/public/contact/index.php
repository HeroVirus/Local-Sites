<?php
/**************************************************************
 * mode パラメーターで判定
 *
 * modeは5種類
 * index -- 入力ページ
 * check -- 確認ページ
 * mail  -- メール送信
 * submit -- 送信ページ
 * error -- エラーページ （有効期限エラーと未入力エラー両方で使用し、$error_typeで判別する）
 **************************************************************/
/* ---------- mode ---------- */
if (isset($_GET["mode"])) {
	$mode = $_GET['mode'];
} else {
	$mode = 'index';
}

/* ---------- セッションスタート ---------- */
if ($mode !== 'submit') {
	session_start();
}

/* ---------- トークン ---------- */
if ($mode === 'check' || $mode === 'mail') {
	if (isset($_POST["token"]) && isset($_SESSION["token"]) && $_POST["token"] === $_SESSION['token']) {
	} else {
		$mode = 'error';
		$error_type = 'effective';
		$errorMessage = '有効期限が切れています。<br>大変お手数ですが、最初からやり直してください。';
	}
}

/* ---------- URLリスト ---------- */
$form_url = array(
	'index' => './',
	'check' => './?mode=check',
	'mail' => './?mode=mail',
	'submit' => './?mode=submit',
);




/**************************************************************
 * 不正アクセス ./ へリダイレクト
 **************************************************************/
/* ---------- POST ---------- */
if (
	$mode !== 'index' &&
	empty($_SERVER["HTTP_REFERER"]) &&
	$_SERVER["REQUEST_METHOD"] != "POST"
) {
	header('Location:' . $form_url['index']);
	exit;
}

/* ---------- token ---------- */
if ($mode === 'check' || $mode === 'mail') {
	if (isset($_SESSION["token"]) && !empty($_SESSION["token"])) {
	} else {
		// echo "不正なリクエストです" . "\n";
		header('Location:' . $form_url['index']);
		exit;
	}
}




/**************************************************************
 * クリックジャッキング対策
 **************************************************************/
header('X-FRAME-OPTIONS: SAMEORIGIN');





if ($mode == 'index') {
	/**************************************************************
	 * 入力ページ
	 **************************************************************/

	/**************************************************************
	 * トークン生成
	 **************************************************************/
	/* ---------- トークンを生成 ---------- */
	$toke_byte = openssl_random_pseudo_bytes(32);
	$token = bin2hex($toke_byte);

	/* ---------- セッションに保存 ---------- */
	$_SESSION['token'] = $token;


} elseif ($mode == 'check') {
	/**************************************************************
	 * 確認ページ
	 **************************************************************/

	/**************************************************************
	 * トークン
	 **************************************************************/
	if (isset($_POST["token"]) && $_POST["token"] === $_SESSION['token']) {
		$token = $_POST['token'];
		$_SESSION['token'] = $token;
	}



	/**************************************************************
	 * shaping
	 **************************************************************/
	function shapingText($text)
	{
		/* ---------- HTML特殊文字をエスケープ ---------- */
		$text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');

		/* ---------- 前後の半角全角スペースを削除 ---------- */
		$text = preg_replace('/^[ 　]+/u', '', $text);
		$text = preg_replace('/[ 　]+$/u', '', $text);

		/* ---------- 文字代替 ---------- */
		$text = str_replace("<", "&lt;", $text);
		$text = str_replace(">", "&gt;", $text);
		$text = str_replace(",", "", $text);
		$text = str_replace("'", "", $text);
		$text = mb_convert_kana($text, 'KVa', "UTF-8");

		return $text;
	}

	function shaping($value)
	{
		if (is_array($value)) {
			$values = '';
			$count = 0;

			foreach ($value as $text) {
				if ($count == 0) {
					$joint = '';
				} else {
					$joint = '、';
					// $joint = "\n";
				}

				$values .= $joint . $text;
				$count++;
			}

			return $values;
		} else {
			$text = shapingText($value);
			return $text;
		}
	}



	/**************************************************************
	 * value
	 * POSTされたデータを各変数に入れる
	 **************************************************************/
	$f_name = shaping(isset($_POST['f_name']) ? $_POST['f_name'] : NULL);
	;
	$f_kana = shaping(isset($_POST['f_kana']) ? $_POST['f_kana'] : NULL);
	;
	$f_mail = shaping(isset($_POST['f_mail']) ? $_POST['f_mail'] : NULL);
	;
	$f_tel = shaping(isset($_POST['f_tel']) ? $_POST['f_tel'] : NULL);
	;
	$f_address = shaping(isset($_POST['f_address']) ? $_POST['f_address'] : NULL);
	;
	$f_message = shaping(isset($_POST['f_message']) ? $_POST['f_message'] : NULL);
	;



	/**************************************************************
	 * value check
	 **************************************************************/
	$errorMessage = '';

	/* ---------- $errorMessage ---------- */
	if ($errorMessage === '') {
		if ($f_name == '')
			$errorMessage .= '「お名前」を入力してください。<br>';
		if ($f_kana == '')
			$errorMessage .= '「お名前（フリガナ）」を入力してください。<br>';
		if ($f_mail == '')
			$errorMessage .= '「メールアドレス」を入力してください。<br>';
		if ($f_address == '')
			$errorMessage .= '「ご住所」を入力してください。<br>';
		if ($f_message == '')
			$errorMessage .= '「お問い合わせ内容」を入力してください。<br>';
	}

	/* ---------- エラーがなければセッションに追加 ---------- */
	if ($errorMessage === '') {
		$_SESSION['f_name'] = $f_name;
		$_SESSION['f_kana'] = $f_kana;
		$_SESSION['f_mail'] = $f_mail;
		$_SESSION['f_tel'] = $f_tel;
		$_SESSION['f_address'] = $f_address;
		$_SESSION['f_message'] = $f_message;
	} else {
		$mode = 'error';
		$error_type = 'required';
	}


	/* ---------- outputValue ---------- */
	function outputValue($value)
	{
		if (isset($value)) {
			echo nl2br($value);
		} else {
			echo '入力内容に不備があります。再度入力して下さい。';
		}
	}



} elseif ($mode == 'mail') {
	/**************************************************************
	 * メール送信設定
	 **************************************************************/
	mb_language("ja");
	mb_internal_encoding("UTF-8");



	/* ---------- variable ---------- */
	$mail_from_title = 'お問い合わせ'; // お問い合わせ or 資料請求 or 採用エントリー
	$mail_from_type = 'お問い合わせ'; // お問い合わせ or 請求 or エントリー or お申し込み
	$mail_from_name = 'ミエルカ株式会社';
	$mail_from_mail = 'support@eca.jp';
	$mail_to_mail = 'support@eca.jp';


	/* ---------- クレジット ---------- */
	$mail_credit = "ーーーーーーーーーーーーーーーーーーーーーーーーー

{$mail_from_name}
HP：https://mieruca-mc.jp/
住所：〒850-0057　長崎市大黒町14番5号　ニュー長崎ビルディング地下1階
TEL：095-820-0100

ーーーーーーーーーーーーーーーーーーーーーーーーー
";


	/* ---------- 送信内容 ---------- */
	$mail_content = "{$mail_from_type}内容
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
お名前：{$_SESSION['f_name']}
お名前（フリガナ）：{$_SESSION['f_kana']}
メールアドレス：{$_SESSION['f_mail']}
電話番号：{$_SESSION['f_tel']}
ご住所：{$_SESSION['f_address']}
お問い合わせ内容：{$_SESSION['f_message']}
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
";



	/**************************************************************
	 * 受付メール
	 **************************************************************/
	$reception_mail = array(
		'to' => $mail_to_mail,
		'header' =>
			'From: ' . mb_encode_mimeheader(mb_convert_encoding($mail_from_name, 'JIS', 'auto')) . '<' . $mail_from_mail . '>'
			. "\r\n" . 'MIME-Version: 1.0'
			. "\r\n" . 'Content-Transfer-Encoding: 8bit'
			. "\r\n" . 'Content-Type: text/plain; charset=UTF-8'
		,
		'subject' => 'ホームページから' . $mail_from_title . 'が届きました',
		'message' => "ホームページの{$mail_from_title}フォームから{$mail_from_type}がありました。
{$mail_from_type}内容は以下の通りです。


{$mail_content}
",
	);



	/**************************************************************
	 * 自動返信メール
	 **************************************************************/
	$auto_mail = array(
		'to' => $_SESSION['f_mail'],
		'header' =>
			'From: ' . mb_encode_mimeheader(mb_convert_encoding($mail_from_name, 'JIS', 'auto')) . '<' . $mail_from_mail . '>'
			. "\r\n" . 'MIME-Version: 1.0'
			. "\r\n" . 'Content-Transfer-Encoding: 8bit'
			. "\r\n" . 'Content-Type: text/plain; charset=UTF-8'
		,
		'subject' => '【' . $mail_from_name . '】' . $mail_from_title . 'ありがとうございました',
		'message' => "{$_SESSION['f_name']} 様

この度は{$mail_from_name}へ{$mail_from_type}いただき、誠にありがとうございます。
下記の内容にて{$mail_from_type}を承りました。
内容を確認次第、担当者より折返しご連絡させていただきます。
今しばらくお待ちくださいませ。


{$mail_content}


※本メールはシステムからの自動返信メールです。
※本メールに返信されても、返信内容の確認およびご返答が出来ない場合がございます。
※本メールにお心当たりのないお客様や内容に誤りがありましたら、お手数ですが下記連絡先までお問い合わせください。

{$mail_credit}
",
	);



	/**************************************************************
	 * 送信
	 **************************************************************/
	mb_send_mail($reception_mail['to'], $reception_mail['subject'], $reception_mail['message'], $reception_mail['header']);
	mb_send_mail($auto_mail['to'], $auto_mail['subject'], $auto_mail['message'], $auto_mail['header']);



	/**************************************************************
	 * 完了ページへリダイレクト
	 **************************************************************/
	header('Location:' . $form_url['submit']);


	/**************************************************************
	 * セッション終了
	 **************************************************************/
	session_destroy();



} elseif ($mode == 'submit') {
	/**************************************************************
	 * 完了ページ
	 **************************************************************/
}
?>
<?php $this_path = 'contact/'; ?>
<?php require_once(dirname(__FILE__) . '/../include/variable.php'); ?>
<?php require_once(dirname(__FILE__) . '/../include/functions.php'); ?>
<?php
/**************************************************************
 * modeによる振り分け
 **************************************************************/
if ($mode == 'index') {
	$directory = array(
		array('ホーム', 'ホーム', ''),
		array('お問い合わせ', 'お問い合わせ', 'contact/')
	);
} elseif ($mode == 'check') {
	$directory = array(
		array('ホーム', 'ホーム', ''),
		array('お問い合わせ', 'お問い合わせ', 'contact/'),
		array('入力内容の確認', '入力内容の確認', 'contact/')
	);
} elseif ($mode == 'submit') {
	$directory = array(
		array('ホーム', 'ホーム', ''),
		array('お問い合わせ', 'お問い合わせ', 'contact/'),
		array('送信完了', '送信完了', 'contact/')
	);
} elseif ($mode == 'error') {
	$directory = array(
		array('ホーム', 'ホーム', ''),
		array('お問い合わせ', 'お問い合わせ', 'contact/'),
		array('エラー', 'エラー', 'contact/')
	);
}


if ($mode == 'index') {
	$page_description = '';
	$robots = true;
} else {
	$page_description = '';
	$robots = false;
}

/**************************************************************
 * template
 **************************************************************/
$meta = array(
	'title' => getTitle($directory),
	'description' => $page_description,
	'keywords' => '',
);

$preload = array();
$style = array(
	$root . 'assets/css/page-contact.css',
);
$script = array(
	$root . 'assets/js/component-form.js',
);
$jquery = false;

$contact_class = '-border-gray';
?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<?php require_once($web_root . $root . 'include/meta.php'); ?>

</head>

<body class="c-bg-dot" data-root="<?= $root; ?>">
	<?php require_once($web_root . $root . 'include/layout_header.php'); ?>
	<main class="contact-main">
		<div class="c-inner-lg">
			<!-- p-hero-->
			<header class="p-hero contact-hero">
				<div class="p-hero__title">
					<h1 class="p-hero__title__ja js-fadeup"><img src="<?= $img_path; ?>contact/contact_title.svg" alt="お問い合わせ"
							decoding="async"></h1>
					<p class="p-hero__title__en js-splittext">Contact</p>
				</div>
			</header>
			<!-- /p-hero-->
		</div>
		<?php if ($mode == 'index'): ?>
	 	<?php
		 /**************************************************************
			* 入力ページ
			**************************************************************/
		 ?>
		 <div class="contact-flex c-inner-lg">
			 <div class="contact-flex__block">
				 <p class="contact-txt c-txt-lg c-crop">
					 お問い合わせ、お見積もりのご依頼やご質問等はお電話または下記フォームよりお気軽にお問い合わせください。こちらのフォームからのお問い合わせに関しては、メールでご返答させていただきます。</p>
			 </div>
			 <div class="contact-flex__block contact-tel">
				 <p class="contact-tel__heading"><img src="<?= $img_path; ?>contact/tel_heading.svg" alt="お電話の方はこちら"
						 decoding="async"></p>
				 <p class="contact-tel__tel">Tel.</p>
				 <p class="contact-tel__number"><a href="tel:095-820-0100">095-820-0100</a></p>
				 <p class="contact-tel__hours"><img src="<?= $img_path; ?>contact/tel_hours.svg" alt="受付可能時間 9:00〜18:00(土日祝祭日休み)"
						 decoding="async"></p>
			 </div>
		 </div>
		 <!-- p-form-->
		 <form method="post" action="<?= $form_url['check']; ?>" name="contactForm" class="p-form p-form--contact h-adr">
			 <input type="hidden" name="mode" value="check">
			 <input type="hidden" name="token" value="<?= $token ?>">
			 <span class="p-country-name" style="display:none;">Japan</span>
			 <div class="p-form__body -input">
				 <header class="p-form__header">
					 <div class="p-form__title">
						 <h2 class="p-form__title__ja">
							 <img src="<?= $img_path; ?>contact/form_title.svg" alt="お問い合わせフォーム" decoding="async">
						 </h2>
						 <p class="p-form__title__en">Form</p>
					 </div>
				 </header>
				 <div class="p-form__inner c-inner-lg">
					 <!-- p-form__table -->
					 <div class="p-form__table">
						 <dl class="p-form__table__cell">
							 <dt>
								 お名前
								 <span class="p-form__required">*</span>
							 </dt>
							 <dd>
								 <div class="p-form__control">
									 <input type="text" name="f_name" placeholder="山田太郎" autocomplete="name" data-name-ja="お名前"
										 class="p-form__txtbox">
								 </div>
							 </dd>
						 </dl>
						 <dl class="p-form__table__cell">
							 <dt>
								 お名前（フリガナ）
								 <span class="p-form__required">*</span>
							 </dt>
							 <dd>
								 <div class="p-form__control">
									 <input type="text" name="f_kana" placeholder="ヤマダタロウ" autocomplete="on" data-name-ja="お名前（フリガナ）"
										 class="p-form__txtbox">
								 </div>
							 </dd>
						 </dl>
						 <dl class="p-form__table__cell">
							 <dt>
								 メールアドレス
								 <span class="p-form__required">*</span>
							 </dt>
							 <dd>
								 <div class="p-form__control">
									 <input type="email" name="f_mail" placeholder="sample@mieruca.com" autocomplete="email"
										 data-name-ja="メールアドレス" class="p-form__txtbox">
								 </div>
							 </dd>
						 </dl>
						 <dl class="p-form__table__cell">
							 <dt>
								 メールアドレス確認
								 <span class="p-form__required">*</span>
							 </dt>
							 <dd>
								 <div class="p-form__control">
									 <input type="email" name="f_mail-check" placeholder="sample@mieruca.com" data-name-ja="メールアドレス確認"
										 class="p-form__txtbox">
								 </div>
							 </dd>
						 </dl>
						 <dl class="p-form__table__cell">
							 <dt>電話番号</dt>
							 <dd>
								 <div class="p-form__control">
									 <input type="tel" name="f_tel" placeholder="000-0000-0000" autocomplete="tel" data-name-ja="電話番号"
										 class="p-form__txtbox">
								 </div>
							 </dd>
						 </dl>
						 <dl class="p-form__table__cell">
							 <dt>
								 ご住所
								 <span class="p-form__required">*</span>
							 </dt>
							 <dd>
								 <div class="p-form__control">
									 <input type="text" name="f_address" placeholder="〇〇県〇〇市〇〇〇00-00"
										 autocomplete="address-level1 address-level2 address-level3 address-level4" data-name-ja="ご住所"
										 class="p-form__txtbox">
								 </div>
							 </dd>
						 </dl>
						 <dl class="p-form__table__cell">
							 <dt>
								 お問い合わせ内容
								 <span class="p-form__required">*</span>
							 </dt>
							 <dd>
								 <div class="p-form__control">
									 <textarea name="f_message" rows="6" placeholder="メッセージをご入力ください。" data-name-ja="お問い合わせ内容"
										 class="p-form__txtbox"></textarea>
								 </div>
							 </dd>
						 </dl>
					 </div>
					 <!-- /p-form__table -->
					 <div class="p-form__footer -input">
						 <div class="p-form__footer__block">
							 <p class="p-form__footer__txt c-crop"><a href="<?= $root; ?>privacy-policy/" target="_blank"
									 rel="noopener noreferrer external"><span
										 class="c-anchor-lineOut">プライバシーポリシー</span></a>をよくお読みいただき、<br>同意いただけましたら「確認画面へ」ボタンを押してください。</p>
						 </div>
						 <div class="p-form__footer__block">
							 <div class="p-form__buttom -check">
								 <p class="p-button -medium p-form__check">
									 <a href="javascript:void(0);"><span class="p-button__txt">確認画面へ</span></a>
								 </p>
							 </div>
						 </div>
					 </div>
				 </div>
			 </div>
		 </form>
		 <!-- /p-form-->
		<?php elseif ($mode == 'error'): ?>
	 	<?php
		 /**************************************************************
			* エラーページ
			**************************************************************/
		 ?>
		 <!-- p-form-->
		 <div class="p-form">
			 <div class="p-form__body">
				 <div class="p-form__inner -error c-inner-lg">
					 <h1 class="p-form__attention__title c-crop">
						 <span class="u-ib">入力エラー</span>
					 </h1>
					 <p class="c-txt-lg c-crop u-t-center">
					 	<?= $errorMessage; ?>
					 </p>
					 <div class="p-form__buttom -back">
						 <p class="p-button -medium u-m-center p-form__back">
						 	<?php if ($error_type == 'effective'): ?>
								<a href="./"><span class="p-button__txt">
										やり直す
									</span></a>
						 	<?php else: ?>
								<a href="javascript:void(0);" onclick="window.history.back();"><span class="p-button__txt">
										戻る
									</span></a>
						 	<?php endif; ?>
						 </p>
					 </div>

				 </div>
			 </div>
		 </div>
		 <!-- /p-form-->
		<?php elseif ($mode == 'check'): ?>
	 	<?php
		 /**************************************************************
			* 確認ページ
			**************************************************************/
		 ?>
		 <!-- p-form-->
		 <form method="post" action="<?= $form_url['mail']; ?>" name="contactForm" class="p-form p-form--contact">
			 <input type="hidden" name="mode" value="mail">
			 <input type="hidden" name="token" value="<?= $token ?>">
			 <div class="p-form__body">
				 <div class="p-form__inner -check c-inner-lg">
					 <h1 class="p-form__attention__title c-crop">
						 <span class="u-ib">入力内容の確認</span>
					 </h1>
					 <p class="c-txt-lg c-crop u-t-center">
						 <span class="u-ib">内容にお間違いがなければ、</span>
						 <span class="u-ib">「送信」ボタンを押してください。</span>
					 </p>
					 <div class="p-form__table2">
						 <dl class="p-form__table__cell">
							 <dt class="c-crop">お名前</dt>
							 <dd class="c-crop">
							 	<?php outputValue($f_name); ?>
							 </dd>
						 </dl>
						 <dl class="p-form__table__cell">
							 <dt class="c-crop">お名前（フリガナ）</dt>
							 <dd class="c-crop">
							 	<?php outputValue($f_kana); ?>
							 </dd>
						 </dl>
						 <dl class="p-form__table__cell">
							 <dt class="c-crop">メールアドレス</dt>
							 <dd class="c-crop">
							 	<?php outputValue($f_mail); ?>
							 </dd>
						 </dl>
						 <dl class="p-form__table__cell">
							 <dt class="c-crop">電話番号</dt>
							 <dd class="c-crop">
							 	<?php outputValue($f_tel); ?>
							 </dd>
						 </dl>
						 <dl class="p-form__table__cell">
							 <dt class="c-crop">ご住所</dt>
							 <dd class="c-crop">
							 	<?php outputValue($f_address); ?>
							 </dd>
						 </dl>
						 <dl class="p-form__table__cell">
							 <dt class="c-crop">お問い合わせ内容</dt>
							 <dd class="c-crop">
							 	<?php outputValue($f_message); ?>
							 </dd>
						 </dl>
					 </div>

					 <div class="p-form__footer -submit">
						 <div class="p-form__buttom">
							 <p class="p-button -medium p-form__back">
								 <a href="javascript:void(0);" onclick="window.history.back();"><span class="p-button__txt">戻る</span></a>
							 </p>
							 <p class="p-button -medium p-form__submit">
								 <a href="javascript:void(0);"><span class="p-button__txt">送信</span></a>
							 </p>
						 </div>
					 </div>
				 </div>
			 </div>
		 </form>
		 <!-- /p-form-->
		<?php elseif ($mode == 'submit'): ?>
	 	<?php
		 /**************************************************************
			* 完了ページ
			**************************************************************/
		 ?>
		 <!-- p-form-->
		 <div class="p-form">
			 <div class="p-form__body">
				 <div class="p-form__inner -attention c-inner-sm p-form__attention">
					 <h1 class="p-form__attention__title c-crop">
						 <span class="u-ib">お問い合わせフォームの</span>
						 <span class="u-ib">送信を完了致しました。</span>
					 </h1>
					 <p class="p-form__attention__txt c-txt-lg c-crop">
						 この度はお問い合わせいただきまして誠にありがとうございます。<br class="u-n-mqDown-lg">
						 内容を確認次第、担当者より折返しご連絡させていただきます。<br class="u-n-mqDown-lg">
						 今しばらくお待ちくださいませ。
					 </p>
					 <p class="p-form__attention__txt2 c-crop">
						 <small class="u-font-main">
							 ※ご送信後、ご確認メールが届かない場合は、フォームご入力のメールアドレスの誤り、もしくはシステム等の不具合が考えられます。<br class="u-n-mqDown-lg">
							 その際にはお手数ですがもう一度ご送信下さいますか、お電話にてお問い合わせくださいますようお願い申し上げます。<br class="u-n-mqDown-lg">
							 また、まれに迷惑メールフォルダへ入っている場合がございますので、合わせてご確認ください。
						 </small>
					 </p>
				 </div>
			 </div>
		 </div>
		 <!-- /p-form-->
		<?php endif; ?>
	</main>
	<?php require_once($web_root . $root . 'include/layout_footer.php'); ?>
</body>

</html>