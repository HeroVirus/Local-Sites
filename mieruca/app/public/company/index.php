<?php $this_path = 'company/'; ?>
<?php require_once( dirname( __FILE__ ) . '/../include/variable.php' ); ?>
<?php require_once( dirname( __FILE__ ) . '/../include/functions.php' ); ?>
<?php
	$directory   = array(
		array('ホーム','ホーム',''),
		array('会社概要','会社概要','company/'),
	);
	$robots = true;

	$meta = array(
		'title'       => getTitle($directory),
		'description' => '',
		'keywords'    => '',
	);

	$preload = array(
		array(
			'href' => $this_img_path . 'portrait.jpg',
			'as'   => 'image',
		),
	);
	$style = array(
		$root . 'assets/css/page-company.css',
	);
	$script = array(
		//- $root . 'assets/js/page-company.js',
	);
	$jquery  = false;
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<?php require_once($web_root.$root.'include/meta.php'); ?>
	</head>
	<body data-root="<?= $root; ?>">
		<?php require_once($web_root.$root.'include/layout_loading.php'); ?>
		<?php require_once($web_root.$root.'include/layout_header.php'); ?>
		<main class="company-main">
			<div class="c-inner-lg">
				<header class="p-hero company-hero">
					<div class="p-hero__title">
						<h1 class="p-hero__title__ja js-fadeup">
							<img src="<?= $this_img_path; ?>company_title.svg" alt="会社概要" decoding="async">
						</h1>
						<p class="p-hero__title__en js-splittext">Company</p>
					</div>
				</header>
				<section class="company-greeting">
					<div class="company-greeting__block">
						<h2 class="company-greeting__title">
							<img src="<?= $this_img_path; ?>heading-greeting.svg" alt="代表挨拶" decoding="async">
						</h2>
						<p class="company-greeting__txt c-txt-lg c-crop">
							ミエルカ株式会社のホームページを訪れていただきましてありがとうございます<br>
							私は税理士として経営者様から様々なお話を聞かせていただく機会が数多くあります<br>
							帳簿や領収書などを基に決算書や申告書を作成する業務はとても重要で、これらが基礎、土台となってその会社の未来が創られていくのですが、多くの経営者の皆様の希望や願望、悩みなどを聴くうちに、もっと何かの役に立ちたい、さらに貢献できることがあるのではないかと思い始めたことがこの会社に繋がっています<br>
							経営者にとって決して尽きることのない“お金・人・売上”にまつわる課題の解決方法を一緒に悩み考えて、いつしかお客様と一緒に喜ぶことができれば、これこそは企業として最高の喜びだと思います
						</p>
						<p class="company-greeting__name">
							<img src="<?= $this_img_path; ?>name.svg" alt="光石 尚彦" decoding="async">
						</p>
					</div>
					<div class="company-greeting__block">
						<div class="company-greeting__pict">
							<img src="<?= $this_img_path; ?>portrait.jpg" alt="光石 尚彦" decoding="async">
						</div>
					</div>
				</section>
				<dl class="company-guidelines">
					<div class="company-guidelines__block -mission">
						<dt class="js-trigger">
							<h3 class="company-guidelines__heading js-fadeup">
								<img src="<?= $this_img_path; ?>heading-mission.svg" alt="Mission" decoding="async">
							</h3>
							<span class="company-guidelines__icon">
								<img class="js-scale js-delay-2" src="<?= $this_img_path; ?>mission.png" alt="mission" decoding="async">
							</span>
						</dt>
						<dd>
							<p class="company-guidelines__lead">
								<picture>
									<source srcset="<?= $this_img_path; ?>lead-mission.svg" media="<?= $mqUpLg; ?>">
									<source srcset="<?= $this_img_path; ?>lead-mission-sp.svg" media="<?= $mqDownLg; ?>">
									<img src="<?= $this_img_path; ?>lead-mission.svg" alt="「したい」「なりたい」をともに目指す" decoding="async">
								</picture>
							</p>
							<p class="company-guidelines__txt c-txt-lg c-crop">お客様がやりたいことを実現するために、そしてスタッフ1人1人のやりたいことを実現するために、税理士法人ASPIREは存在します。</p>
						</dd>
					</div>
					<div class="company-guidelines__block -vision">
						<dt class="js-trigger">
							<h3 class="company-guidelines__heading js-fadeup">
								<img src="<?= $this_img_path; ?>heading-vision.svg" alt="Vision" decoding="async">
							</h3>
							<span class="company-guidelines__icon">
								<img class="js-scale js-delay-2" src="<?= $this_img_path; ?>vision.png" alt="" decoding="async">
							</span>
						</dt>
						<dd>
							<p class="company-guidelines__lead">
								<picture>
									<source srcset="<?= $this_img_path; ?>lead-vision.svg" media="<?= $mqUpLg; ?>">
									<source srcset="<?= $this_img_path; ?>lead-vision-sp.svg" media="<?= $mqDownLg; ?>">
									<img src="<?= $this_img_path; ?>lead-vision.svg" alt="「いい時も、よくない時も、常にそばにいて支え続ける存在」" decoding="async">
								</picture>
							</p>
							<p class="company-guidelines__txt c-txt-lg c-crop">ある関与先の経営者から言われた言葉です。私たちが目指すべき、あるべき姿を表現してもらいました。</p>
						</dd>
					</div>
					<div class="company-guidelines__block -value">
						<dt class="js-trigger">
							<h3 class="company-guidelines__heading js-fadeup">
								<img src="<?= $this_img_path; ?>heading-value.svg" alt="Value" decoding="async">
							</h3>
							<span class="company-guidelines__icon">
								<img class="js-scale js-delay-2" src="<?= $this_img_path; ?>value.png" alt="value" decoding="async">
							</span>
						</dt>
						<dd>
							<p class="company-guidelines__lead">
								<picture>
									<source srcset="<?= $this_img_path; ?>lead-value.svg" media="<?= $mqUpLg; ?>">
									<source srcset="<?= $this_img_path; ?>lead-value-sp.svg">
									<img src="<?= $this_img_path; ?>lead-value.svg" alt="「ドリルでなく穴」" decoding="async">
								</picture>
							</p>
							<p class="company-guidelines__txt c-txt-lg c-crop">
								マーケティングの教科書に出てくる「ドリルを買いに来た客が本当に欲しいものは何か？」の答えです。お客様企業は帳簿や決算書・申告書が欲しいのではなく、これらを使って得られる良い実績、良い経営が欲しいのです。お客様が望む、本当に欲しいものを提供します。
							</p>
						</dd>
					</div>
				</dl>
				<section class="company-overview">
					<h2 class="company-overview__heading">
						<img src="<?= $this_img_path; ?>heading-overview.svg" alt="会社概要" decoding="async">
					</h2>
					<table class="company-overview__table">
						<tr>
							<th>会社名</th>
							<td>ミエルカ株式会社</td>
						</tr>
						<tr>
							<th>本社</th>
							<td>〒850-0057<br>長崎市大黒町14番5号　ニュー長崎ビルディング地下1階</td>
						</tr>
						<tr>
							<th>電話</th>
							<td>
								<a href="tel:095-820-0100">095-820-0100</a>
							</td>
						</tr>
						<tr>
							<th>設立</th>
							<td>昭和28年4月10日</td>
						</tr>
						<tr>
							<th>代表取締役社長</th>
							<td>光石　尚彦</td>
						</tr>
						<tr>
							<th>事業内容</th>
							<td>
								●経営財務コンサルティング●経営計画作成支援●経営会議運営支援●補助金、助成金●SNSマーケティングサポート●マーケティング(販促、集客、広告、ブランディング)●人材育成、教育訓練支援
							</td>
						</tr>
					</table>
				</section>
				<section class="company-access">
					<div class="p-hero">
						<div class="p-hero__title company-access-title">
							<h2 class="p-hero__title__ja">
								<img src="<?= $this_img_path; ?>title-access.svg" alt="アクセス" decoding="async">
							</h2>
							<p class="p-hero__title__en">Access</p>
						</div>
					</div>
					<div class="company-access__map">
						<div class="company-access__map__inner">
							<iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d838.8849833333351!2d129.87105426964246!3d32.751404998354644!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1z6ZW35bSO5biC5aSn6buS55S6MTTnlao15Y-344CA44OL44Ol44O86ZW35bSO44OT44Or44OH44Kj44Oz44Kw5Zyw5LiLMemajg!5e0!3m2!1sja!2sjp!4v1704950376745!5m2!1sja!2sjp" width="600" height="450" style="border:0;" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"></iframe>
						</div>
						<div class="company-access__map__address">
							<p>〒850-0057　長崎市大黒町14番5号　ニュー長崎ビルディング地下1階</p>
							<a href="https://maps.app.goo.gl/bSQssc4sYJEsiR2J8" target="_blank" rel="noopener noreferrer external" data-wpel-link="external">
								<i class="company-access__map__icon">
									<img class="js-svg" src="<?= $img_path; ?>common/icon/pin.svg" alt="">
								</i>
								<span class="c-anchor-lineIn">Google Maps</span>
							</a>
						</div>
					</div>
				</section>
			</div>
		</main>
		<?php require_once($web_root.$root.'include/layout_footer.php'); ?>
	</body>
</html>
