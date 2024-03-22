<?php $this_path = 'member/'; ?>
<?php require_once (dirname(__FILE__) . '/../../../../../include/variable.php'); ?>
<?php require_once (dirname(__FILE__) . '/../../../../../include/functions.php'); ?>
<?php relativeURL(); ?>
<?php
$directory = array(
	array('ホーム', 'ホーム', ''),
	array('ミエルカパートナー', 'ミエルカパートナー', 'member/'),
);
$robots = true;

$meta = array(
	'title' => getTitle($directory),
	'description' => '',
	'keywords' => '',
);

$preload = array(
	array(
		'href' => $this_img_path . 'main-illust.png',
		'as' => 'image',
	),
);
$style = array(
	$root . 'assets/css/page-member.css',
);
$script = array(
	$root . 'assets/js/page-member.js',
);
$jquery = false;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<?php require_once ($web_root . $root . 'include/meta.php'); ?>
</head>

<body data-root="<?= $root; ?>">
	<?php require_once ($web_root . $root . 'include/layout_loading.php'); ?>
	<?php require_once ($web_root . $root . 'include/layout_header.php'); ?>
	<main class="member-main">
		<div class="member-main__inner">
			<header class="p-hero member-hero">
				<div class="p-hero__title">
					<h1 class="p-hero__title__ja js-fadeup">
						<picture>
							<source srcset="<?= $this_img_path; ?>member_title-pc.svg" media="<?= $mqUpLg; ?>">
							<source srcset="<?= $this_img_path; ?>member_title-sp.svg" media="<?= $mqDownLg; ?>">
							<img src="<?= $this_img_path; ?>member_title-pc.svg" alt="ミエルカパートナー" decoding="async">
						</picture>
					</h1>
					<p class="p-hero__title__en js-splittext">Member</p>
				</div>
			</header>
			<div class="member-contents">
				<div class="member-contents__block">
					<div class="member-contents__illust js-trigger">
						<img class="js-fade" src="<?= $this_img_path; ?>main-illust.png" alt="" decoding="async">
						<img class="js-fadeleft js-delay-3" src="<?= $this_img_path; ?>main-illust_1.png" alt="" decoding="async">
						<img class="js-fadeleft js-delay-4" src="<?= $this_img_path; ?>main-illust_2.png" alt="" decoding="async">
						<img class="js-fadeleft js-delay-5" src="<?= $this_img_path; ?>main-illust_3.png" alt="" decoding="async">
					</div>
				</div>
				<div class="member-contents__block">
					<p class="member-contents__txt c-txt-lg c-crop">
						財務・会計、マーケティングの分野に精通したスタッフが、広告、広報、マーケティングの相談を承ります。また、各士業、プランナー、デザイナー、カメラマン、動画編集者などとチームを組み、幅広い手法、切り口によるご提案が可能です。
					</p>
				</div>
			</div>
		</div>
		<div class="c-inner-lg">
			<div class="member-list c-column -col-3 -gap-c-60 -gap-r-64">
				<?php if (have_posts()): ?>
					<?php while (have_posts()):
						the_post(); ?>
						<?php
						/* ---------- SCF ---------- */
						$member_name = SCF::get('member_name');
						$member_txt = SCF::get('member_txt');
						$member_thumbnail = SCF::get('member_thumbnail');

						if ($member_thumbnail) {
							$member_thumbnail_url = wp_get_attachment_image_src($member_thumbnail, '360_300_thumbnail');
							$member_thumbnail_url = $member_thumbnail_url[0];
						} else {
							$member_thumbnail_url = $this_img_path . 'no-image.jpg';
						}
						?>
						<article class="member-card">
							<figure class="member-card__figure js-trigger">
								<div class="member-card__figure__inner">
									<img class="c-objectfit -cover" src="<?= $member_thumbnail_url; ?>" alt="">
								</div>
							</figure>
							<h2 class="member-card__name c-crop">
								<?php the_title(); ?>
							</h2>
							<p class="member-card__furigana c-crop">
								<?= $member_name; ?>
							</p>
							<div class="member-card__accordion js-readmore">
								<div class="js-readmore__body">
									<div class="js-readmore__body__inner">
										<p class="member-card__txt c-txt-lg c-crop">
											<?= $member_txt; ?>
										</p>
									</div>
								</div>
								<p class="member-card__accordion__button">
									<span class="js-readmore__button c-anchor-lineIn">続きを読む</span>
								</p>
							</div>
						</article>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
	</main>
	<?php require_once ($web_root . $root . 'include/layout_footer.php'); ?>
</body>

</html>