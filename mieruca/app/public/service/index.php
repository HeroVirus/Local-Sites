<?php $this_path = 'service/'; ?>
<?php require_once( dirname( __FILE__ ) . '/../include/variable.php' ); ?>
<?php require_once( dirname( __FILE__ ) . '/../include/functions.php' ); ?>
<?php
	$directory   = array(
		array('ホーム','ホーム',''),
		array('ミエルカの道具','ミエルカの道具','service/'),
	);
	$robots = true;

	$meta = array(
		'title'       => getTitle($directory),
		'description' => '',
		'keywords'    => '',
	);

	$preload = array(
		array(
			'href' => $this_img_path . 'illust_climbing.png',
			'as'   => 'image',
		),
	);
	$style = array(
		$root . 'assets/css/page-service.css',
	);
	$script = array(
		$root . 'assets/js/page-service.js',
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
		<main class="service-main">
			<header class="p-hero service-hero">
				<div class="p-hero__title">
					<h1 class="p-hero__title__ja js-fadeup">
						<picture>
							<source srcset="<?= $this_img_path; ?>service_title-pc.svg" media="<?= $mqUpLg; ?>">
							<source srcset="<?= $this_img_path; ?>service_title-sp.svg" media="<?= $mqDownLg; ?>">
							<img src="<?= $this_img_path; ?>service_title.svg" alt="ミエルカの道具" decoding="async">
						</picture>
					</h1>
					<p class="p-hero__title__en js-splittext">Service</p>
				</div>
			</header>
			<div class="service-contents">
				<div class="service-contents__block -header">
					<header class="service-header -pc">
						<div>
							<div class="service-header__icons">
								<span class="service-header__icons__item -lamp">
									<img src="<?= $this_img_path; ?>illust_lamp-small.png" alt="" decoding="async">
								</span>
								<span class="service-header__icons__item -gear">
									<img src="<?= $this_img_path; ?>illust_gear-small.png" alt="" decoding="async">
								</span>
								<span class="service-header__icons__item -rope">
									<img src="<?= $this_img_path; ?>illust_rope-small.png" alt="" decoding="async">
								</span>
								<span class="service-header__icons__item -axe">
									<img src="<?= $this_img_path; ?>illust_axe-small.png" alt="" decoding="async">
								</span>
							</div>
							<p class="service-header__heading c-crop">利益と資金の最大化</p>
						</div>
						<div>
							<div class="service-header__icons">
								<span class="service-header__icons__item -bag is-active">
									<img src="<?= $this_img_path; ?>illust_bag-small.png" alt="" decoding="async">
								</span>
							</div>
							<p class="service-header__heading c-crop">起業は人なり</p>
						</div>
						<div>
							<div class="service-header__icons">
								<span class="service-header__icons__item -binoculars">
									<img src="<?= $this_img_path; ?>illust_binoculars-small.png" alt="" decoding="async">
								</span>
								<span class="service-header__icons__item -compass">
									<img src="<?= $this_img_path; ?>illust_compass-small.png" alt="" decoding="async">
								</span>
							</div>
							<p class="service-header__heading c-crop">
								<span class="u-ib">「売れる」</span>
								<span class="u-ib">仕組みを構築</span>
							</p>
						</div>
					</header>
					<div class="service-illust">
						<div class="service-illust__cloud">
							<div class="c-object2 -unique1 c-anime-fluffy c-anime-delay-_1">
								<img src="<?= $img_path; ?>common/illust/cloud_blue_3.png" alt="" decoding="async">
							</div>
							<div class="c-object2 -unique2 c-anime-fluffy c-anime-delay-_3">
								<img src="<?= $img_path; ?>common/illust/cloud_blue_2.png" alt="" decoding="async">
							</div>
							<div class="c-object2 -unique3 c-anime-fluffy c-anime-delay-_2">
								<img src="<?= $img_path; ?>common/illust/cloud_blue_1.png" alt="" decoding="async">
							</div>
							<div class="c-object2 -unique4 c-anime-fluffy c-anime-delay-_1">
								<img src="<?= $img_path; ?>common/illust/cloud_blue_1.png" alt="" decoding="async">
							</div>
						</div>
						<div class="service-illust__main">
							<img class="service-illust__main__main" src="<?= $this_img_path; ?>illust_climbing.png" alt="" decoding="async">
							<img class="service-illust__main__sub" src="<?= $this_img_path; ?>illust_climbing2.png" alt="" decoding="async">
						</div>
					</div>
				</div>
				<div class="service-contents__block">
					<section class="service-section1">
						<header class="service-header -sp">
							<div class="service-header__icons">
								<span class="service-header__icons__item -lamp">
									<img src="<?= $this_img_path; ?>illust_lamp-small.png" alt="" decoding="async">
								</span>
								<span class="service-header__icons__item -gear">
									<img src="<?= $this_img_path; ?>illust_gear-small.png" alt="" decoding="async">
								</span>
								<span class="service-header__icons__item -rope">
									<img src="<?= $this_img_path; ?>illust_rope-small.png" alt="" decoding="async">
								</span>
								<span class="service-header__icons__item -axe">
									<img src="<?= $this_img_path; ?>illust_axe-small.png" alt="" decoding="async">
								</span>
							</div>
							<h2 class="service-header__heading c-crop">
								利益と資金の最大化
							</h2>
						</header>
						<section class="service-section2 -section1">
							<h3 class="service-lead">
								<picture>
									<source srcset="<?= $this_img_path; ?>title_section1.svg" media="<?= $mqUpLg; ?>">
									<source srcset="<?= $this_img_path; ?>title_section1-sp.svg" media="<?= $mqDownLg; ?>">
									<img src="<?= $this_img_path; ?>title_section1.svg" alt="企業がめざす方向へ光をあてる。" decoding="async">
								</picture>
							</h3>
							<div class="service-icon -lamp">
								<img src="<?= $this_img_path; ?>illust_lamp.png" alt="" decoding="async">
							</div>
							<section class="service-section3">
								<h4 class="service-heading c-crop">経営財務コンサルティング</h4>
								<p class="service-txt c-txt-lg c-crop">
									経営の課題はどこにあるのか、なぜこうなったのか、これからどうすれば良いのか。その理由や方策は決算書に集約されています。税理士法人を母体とする当社は、財務の切り口で経営をサポートします。適切な会計情報に基づいて作成された正しい決算書類かどうかを見極め、実態を把握し、本質を理解したうえで、めざす方向に向かってご提案します。
								</p>
								<section class="service-section4">
									<h4 class="service-heading2">
										<span>経営財務コンサルティングの内容</span>
									</h4>
									<ul class="service-list c-txt-lg">
										<li>決算書、税務申告書、借入金明細書などの適正性を検証</li>
										<li>財務指標、変動損益計算書、金融機関格付け評価などの<br>事前資料作成</li>
										<li>経営環境を分析</li>
										<li>人事組織図の作成</li>
										<li>経営計画の作成</li>
										<li>PDCAサイクルをサポート</li>
									</ul>
								</section>
							</section>
						</section>
						<section class="service-section2 -section2">
							<h3 class="service-lead">
								<picture>
									<source srcset="<?= $this_img_path; ?>title_section2.svg" media="<?= $mqUpLg; ?>">
									<source srcset="<?= $this_img_path; ?>title_section2-sp.svg" media="<?= $mqDownLg; ?>">
									<img src="<?= $this_img_path; ?>title_section2.svg" alt="経営計画は、正しいレシピから。" decoding="async">
								</picture>
							</h3>
							<div class="service-icon -gear">
								<img src="<?= $this_img_path; ?>illust_gear.png" alt="" decoding="async">
							</div>
							<section class="service-section3">
								<h4 class="service-heading c-crop">経営計画作成支援</h4>
								<p class="service-txt c-txt-lg c-crop">
									経営計画について「絵に描いた餅」と不要論を唱える人もいます。ミエルカでは、経営計画を「本当においしい餅を食べるためのレシピ」ととらえています。つくり方は進めながら変化する場合もありますが、到達する目標「おいしい餅を食べる」は変わりません。「なぜそれをやるのか」からはじまり、最後の仕上げ（つまり目標）をイメージしながら手順を示します。計画をつくるだけでなく、マネジメントサイクルを回しながらスパイラルアップするために、いっしょに悩み考えながら実行をサポートします。
								</p>
								<section class="service-section4">
									<h4 class="service-heading2">
										<span>経営計画のマネジメントサイクル</span>
									</h4>
									<ul class="service-list c-txt-lg">
										<li>Plan＞各種分析をもとに課題を抽出。目標到達までの道筋を定める</li>
										<li>Do＞計画に基づいて実践。実践するための方法が重要</li>
										<li>Check＞結果と行動を検証。売上や利益などの結果だけでなく、プロセスも検証する</li>
										<li>Action＞必要に応じて軌道修正。この軌道修正こそが最終的な目標達成に近づくための大きなポイント</li>
									</ul>
								</section>
							</section>
						</section>
						<section class="service-section2 -section3">
							<h3 class="service-lead">
								<picture>
									<source srcset="<?= $this_img_path; ?>title_section3.svg" media="<?= $mqUpLg; ?>">
									<source srcset="<?= $this_img_path; ?>title_section3-sp.svg" media="<?= $mqDownLg; ?>">
									<img src="<?= $this_img_path; ?>title_section3.svg" alt="コミュニケーションは企業の命綱。" decoding="async">
								</picture>
							</h3>
							<div class="service-icon -rope">
								<img src="<?= $this_img_path; ?>illust_rope.png" alt="" decoding="async">
							</div>
							<section class="service-section3">
								<h4 class="service-heading c-crop">経営会議運営支援</h4>
								<p class="service-txt c-txt-lg c-crop">
									社内の情報共有、意思決定、業務の確実な遂行のために、会議運営は重視したい要素です。「会議に集まらない」「集まっているのに議論しない」「議論したのに決められない」「決めたのに実行しない」「実行しなかったのに誰も責任を取らない」など、組織で起こりうることを整理し、外部からサポートを行います。必要に応じて専門分野の意見や説明を加えることができるので、会議運営の実効性が高まります。
								</p>
								<section class="service-section4">
									<h4 class="service-heading2">
										<span>会議運営支援のサポート内容</span>
									</h4>
									<ul class="service-list c-txt-lg">
										<li>議案、日時、場所、参加者を決めて招集し、出欠の回答を得る</li>
										<li>会議進行のための資料を作成</li>
										<li>発言機会、脱線防止、板書など進行のサポート</li>
										<li>会議の内容を議事録にまとめて参加者に配布</li>
										<li>決定事項の進捗状況を確認</li>
									</ul>
								</section>
							</section>
						</section>
						<section class="service-section2 -section4">
							<h3 class="service-lead">
								<picture>
									<source srcset="<?= $this_img_path; ?>title_section4.svg" media="<?= $mqUpLg; ?>">
									<source srcset="<?= $this_img_path; ?>title_section4-sp.svg" media="<?= $mqDownLg; ?>">
									<img src="<?= $this_img_path; ?>title_section4.svg" alt="困難を打ち砕いて道をつくる。" decoding="async">
								</picture>
							</h3>
							<div class="service-icon -axe">
								<img src="<?= $this_img_path; ?>illust_axe.png" alt="" decoding="async">
							</div>
							<section class="service-section3">
								<h4 class="service-heading c-crop">補助金・助成金</h4>
								<p class="service-txt c-txt-lg c-crop">
									事業再構築補助金、ものづくり補助金、経営革新計画の採択実績を持つ税理士法人を母体とする自社の強みを生かしたサービス。ヒアリングを通じて新事業のビジョンを具体化し、実際の事業再構築、事業拡大に向けた戦略を立案。クライアントファーストの視点を核にした補助金の採択に必要な計画書の策定を支援します。補助金採択の後には、事業再構築や事業拡大に向けた具体的な戦略の立案・実行支援も提供が可能です。
								</p>
								<section class="service-section4">
									<h4 class="service-heading2">
										<span>補助金・助成金のサポート内容</span>
									</h4>
									<ul class="service-list c-txt-lg">
										<li>ヒアリングをもとに新事業のビジョンを具体化</li>
										<li>補助金・助成金採択に必要な条件を満たす戦略アドバイス</li>
										<li>最適な戦略を考慮した事業計画書の策定</li>
										<li>＜オプション＞採択後の戦略立案、マーケティングプラン、実行支援　など</li>
									</ul>
								</section>
							</section>
						</section>
					</section>
					<section class="service-section1">
						<header class="service-header -sp">
							<div class="service-header__icons">
								<span class="service-header__icons__item -bag is-active">
									<img src="<?= $this_img_path; ?>illust_bag-small.png" alt="" decoding="async">
								</span>
							</div>
							<h2 class="service-header__heading c-crop">
								起業は人なり
							</h2>
						</header>
						<section class="service-section2 -section5">
							<h3 class="service-lead">
								<picture>
									<source srcset="<?= $this_img_path; ?>title_section5.svg" media="<?= $mqUpLg; ?>">
									<source srcset="<?= $this_img_path; ?>title_section5-sp.svg" media="<?= $mqDownLg; ?>">
									<img src="<?= $this_img_path; ?>title_section5.svg" alt="ビジョンを背負う最強チームを編成。" decoding="async">
								</picture>
							</h3>
							<div class="service-icon -bag">
								<img src="<?= $this_img_path; ?>illust_bag.png" alt="" decoding="async">
							</div>
							<section class="service-section3">
								<h4 class="service-heading c-crop">人材育成・教育訓練支援</h4>
								<p class="service-txt c-txt-lg c-crop">
									人材育成や教育訓練は、企業のビジョンや経営方針、経営者の考え方を丁寧に見ていくことからはじめます。ビジョン達成のために必要な人材はどのような人か、そのために必要な教育制度はなにを導入すればいいのか。企業のビジョン、人材ビジョンを明確にした上でサポートを行います。
								</p>
								<section class="service-section4">
									<h4 class="service-heading2">
										<span>人材育成・教育訓練支援のサポート内容</span>
									</h4>
									<ul class="service-list c-txt-lg">
										<li>企業ビジョン、人材ビジョンのヒアリング</li>
										<li>ビジョンをもとにした人材育成方針策定</li>
										<li>人材募集、採用、面接の方針</li>
										<li>教育・研修計画の策定</li>
										<li>業務マニュアル、研修方法の整備</li>
										<li>人材評価方法、研修評価方法の策定　など</li>
									</ul>
								</section>
							</section>
						</section>
					</section>
					<section class="service-section1">
						<header class="service-header -sp">
							<div class="service-header__icons">
								<span class="service-header__icons__item -binoculars">
									<img src="<?= $this_img_path; ?>illust_binoculars-small.png" alt="" decoding="async">
								</span>
								<span class="service-header__icons__item -compass">
									<img src="<?= $this_img_path; ?>illust_compass-small.png" alt="" decoding="async">
								</span>
							</div>
							<h2 class="service-header__heading c-crop">
								「売れる」仕組みを構築
							</h2>
						</header>
						<section class="service-section2 -section6">
							<h3 class="service-lead">
								<picture>
									<source srcset="<?= $this_img_path; ?>title_section6.svg" media="<?= $mqUpLg; ?>">
									<source srcset="<?= $this_img_path; ?>title_section6-sp.svg" media="<?= $mqDownLg; ?>">
									<img src="<?= $this_img_path; ?>title_section6.svg" alt="少し先を見据えたマーケティング。" decoding="async">
								</picture>
							</h3>
							<div class="service-icon -binoculars">
								<img src="<?= $this_img_path; ?>illust_binoculars.png" alt="" decoding="async">
							</div>
							<section class="service-section3">
								<h4 class="service-heading c-crop">SNSマーケティングサポート</h4>
								<p class="service-txt c-txt-lg c-crop">
									SNS広告の最適化やターゲット設定を行い、広告効果を最大化することを目的に行います。売上向上、集客など、広告の目的を詳細にヒアリングを行い、ソーシャルメディアのトレンドを把握した上で、コンテンツの企画から発信方法、メディアの選定、組み合わせまで幅広い提案が可能です。自社で自走できるSNS広告運営を大前提に伴走いたします。
								</p>
								<section class="service-section4">
									<h4 class="service-heading2">
										<span>SNSマーケティングのサポート内容</span>
									</h4>
									<ul class="service-list c-txt-lg">
										<li>効果向上企画</li>
										<li>コンテンツ制作支援</li>
										<li>ターゲット顧客へのアプローチ</li>
										<li>競合他社との差別化</li>
										<li>SNS最新トレンド　など</li>
									</ul>
								</section>
							</section>
						</section>
						<section class="service-section2 -section7">
							<h3 class="service-lead">
								<picture>
									<source srcset="<?= $this_img_path; ?>title_section7.svg" media="<?= $mqUpLg; ?>">
									<source srcset="<?= $this_img_path; ?>title_section7-sp.svg" media="<?= $mqDownLg; ?>">
									<img src="<?= $this_img_path; ?>title_section7.svg" alt="さまざまな方法で、目標へと指南する。" decoding="async">
								</picture>
							</h3>
							<div class="service-icon -compass">
								<img src="<?= $this_img_path; ?>illust_compass.png" alt="" decoding="async">
							</div>
							<section class="service-section3">
								<h4 class="service-heading c-crop">マーケティング（販促・集客・広告・ブランディング）</h4>
								<p class="service-txt c-txt-lg c-crop">
									商品やサービスの提供にともない、競争力を維持し、高めるために必要な活動をサポートします。ビジョンや事業内容を詳細にヒアリングし、競合他社との差別化を図り、企業の商品やサービスの独自性をアピールしながら、その発信方法、集客方法まで幅広くご提案します。ビジネスの成長に直結する、ミエルカの得意領域です。
								</p>
								<section class="service-section4">
									<h4 class="service-heading2">
										<span>ミエルカのマーケティング</span>
									</h4>
									<ul class="service-list c-txt-lg">
										<li>販促<br>商品やサービスの売上を上げるための活動。キャンペーンや販促活動を通じて新吉根客獲得やリピート増加を図ります</li>
										<li>集客<br>新規顧客獲得を目的とした活動。広告、PR、イベントを企画開催することで知名度を高めます。</li>
										<li>広告<br>商品やサービスの宣伝活動。TVCM、新聞広告、ネット広告などを通じ、商品やサービスの魅力を伝え、アピールします。</li>
										<li>
											ブランディング<br>企業のイメージ向上、商品・サービスの付加価値を高める活動。ロゴやキャラクター、コピーライティングによって企業の強みをアピールし、競合他社との差別化を図ります。
										</li>
									</ul>
								</section>
							</section>
						</section>
					</section>
				</div>
			</div>
		</main>
		<?php require_once($web_root.$root.'include/layout_footer.php'); ?>
	</body>
</html>
