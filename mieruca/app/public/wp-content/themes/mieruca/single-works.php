<?php $this_path = 'works/'; ?>
<?php require_once (dirname(__FILE__) . '../../../../include/variable.php'); ?>
<?php require_once (dirname(__FILE__) . '../../../../include/functions.php'); ?>
<?php relativeURL(); ?>
<?php
$directory = array(
	array('ホーム', 'ホームj', ''),
	array('ミエルカの山', 'ミエルカの山', 'works/'),
	array(get_the_title(), get_the_title(), 'works/' . get_the_ID() . '/'),
);
$robots = true;

$meta = array(
	'title' => getTitle($directory),
	'description' => '',
	'keywords' => '',
);

$preload = array(
	//- array(
	//- 	'href' => $this_img_path . 'kv_bg.svg',
	//- 	'as'   => 'image',
	//- ),
);
$style = array(
	$root . 'assets/css/page-works.css',
);
$script = array(
	//- $root . 'assets/js/page-works.js',
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
	<main class="works-single-main c-motifs-wrap">
		<div class="c-motifs">
			<div class="c-motifs__top"></div>
			<div class="c-motifs__main"></div>
		</div>
		<div class="c-mountain -medium -gradation">
			<div class="c-mountain__triangle"></div>
			<div class="c-mountain__base"></div>
		</div>
		<div class="works-main__inner">
			<div class="works-contents c-inner-lg">
				<header class="p-hero works-hero">
					<div class="p-hero__title">
						<p class="p-hero__title__ja works-title js-fadeup">
							<picture>
								<source srcset="<?= $this_img_path; ?>works_title-pc.svg" media="<?= $mqUpLg; ?>">
								<source srcset="<?= $this_img_path; ?>works_title-sp.svg" media="<?= $mqDownLg; ?>">
								<img src="<?= $this_img_path; ?>works_title-pc.svg" alt="ミエルカの山" decoding="async">
							</picture>
						</p>
						<p class="p-hero__title__en js-splittext">Works</p>
					</div>
				</header>
				<?php
				/* ---------- SCF ---------- */
				$works_hero = SCF::get('works_hero');
				$works_client = SCF::get('works_client');
				$works_category = SCF::get('works_category');
				$works_support = SCF::get('works_support');
				$works_outline = SCF::get('works_outline');

				$works_step = SCF::get('works_step');
				$works_free = SCF::get('works_free');
				$works_partner = SCF::get('works_partner');
				?>
				<article class="works-single-article">
					<header class="works-single__header">
						<h1 class="works-single__title c-crop">
							<?php the_title(); ?>
						</h1>
					</header>
					<?php if ($works_hero): ?>
						<?php
						$works_hero_url = wp_get_attachment_image_src($works_hero, '1200_550_hero')[0];
						?>
						<figure class="works-single__pict js-trigger js-fadeup">
							<img class="c-objectfit -cover" src="<?= $works_hero_url; ?>" alt="" decoding="async">
						</figure>
					<?php endif; ?>
					<div class="works-single-article__inner">
						<dl class="works-single-table c-txt-lg">
							<?php if ($works_client): ?>
								<div class="works-single-table__block">
									<dt>クライアント</dt>
									<dd>
										<?= $works_client; ?>
									</dd>
								</div>
							<?php endif; ?>
							<?php if ($works_category): ?>
								<div class="works-single-table__block">
									<dt>業種</dt>
									<dd>
										<?= $works_category; ?>
									</dd>
								</div>
							<?php endif; ?>
							<?php if ($works_support[0]['works_support_cell']): ?>
								<div class="works-single-table__block">
									<dt>導入支援内容</dt>
									<dd>
										<ol>
											<?php foreach ($works_support as $fields): ?>
												<li>
													<?= $fields['works_support_cell']; ?>
												</li>
											<?php endforeach; ?>
										</ol>
									</dd>
								</div>
							<?php endif; ?>
						</dl>
						<?php if ($works_outline): ?>
							<p class="works-single-txt c-crop c-txt-lg">
								<?= nl2br($works_outline); ?>
							</p>
						<?php endif; ?>
						<?php if ($works_step[0]['works_step_title']): ?>
							<div class="works-single-step">
								<?php $index = 0; ?>
								<?php foreach ($works_step as $fields): ?>
									<?php $index++; ?>
									<?php
									$works_step_title = $fields['works_step_title'];
									$works_step_txt = $fields['works_step_txt'];
									$works_step_image1 = $fields['works_step_image1'];
									$works_step_image2 = $fields['works_step_image2'];
									$works_step_image3 = $fields['works_step_image3'];
									$works_step_image4 = $fields['works_step_image4'];
									$works_step_image5 = $fields['works_step_image5'];
									$works_step_image6 = $fields['works_step_image6'];
									$works_step_image7 = $fields['works_step_image7'];
									$works_step_image8 = $fields['works_step_image8'];
									$works_step_image9 = $fields['works_step_image9'];
									$works_step_image10 = $fields['works_step_image10'];
									?>
									<section class="works-single-step__section">
										<div class="works-single-flex">
											<div class="works-single-flex__block">
												<div class="works-single-step__header">
													<div class="works-single-step__header__inner">
														<h2 class="works-single-step__heading">
															Step
															<?= $index; ?>
														</h2>
													</div>
													<span class="works-single-step__arrow u-n-mqDown-lg">
														<img src="<?= $this_img_path; ?>arrow-bottom.svg" alt="" decoding="async">
													</span>
												</div>
											</div>
											<div class="works-single-flex__block">
												<h3 class="works-single-step__title c-crop">
													<?= $works_step_title; ?>
												</h3>
												<p class="works-single-step__txt c-crop c-txt-lg">
													<?= nl2br($works_step_txt); ?>
												</p>
												<?php
												if ($works_step_image1):
													$works_step_image1_url = wp_get_attachment_image_src($works_step_image1, '720_free_contents')[0];
													?>
													<figure class="works-single-step__pict">
														<img src="<?= $works_step_image1_url; ?>" alt="" decoding="async">
													</figure>
												<?php endif; ?>
												<?php
												if ($works_step_image2):
													$works_step_image2_url = wp_get_attachment_image_src($works_step_image2, '720_free_contents')[0];
													?>
													<figure class="works-single-step__pict">
														<img src="<?= $works_step_image2_url; ?>" alt="" decoding="async">
													</figure>
												<?php endif; ?>
												<?php
												if ($works_step_image3):
													$works_step_image3_url = wp_get_attachment_image_src($works_step_image3, '720_free_contents')[0];
													?>
													<figure class="works-single-step__pict">
														<img src="<?= $works_step_image3_url; ?>" alt="" decoding="async">
													</figure>
												<?php endif; ?>
												<?php
												if ($works_step_image4):
													$works_step_image4_url = wp_get_attachment_image_src($works_step_image4, '720_free_contents')[0];
													?>
													<figure class="works-single-step__pict">
														<img src="<?= $works_step_image4_url; ?>" alt="" decoding="async">
													</figure>
												<?php endif; ?>
												<?php
												if ($works_step_image5):
													$works_step_image5_url = wp_get_attachment_image_src($works_step_image5, '720_free_contents')[0];
													?>
													<figure class="works-single-step__pict">
														<img src="<?= $works_step_image5_url; ?>" alt="" decoding="async">
													</figure>
												<?php endif; ?>
												<?php
												if ($works_step_image6):
													$works_step_image6_url = wp_get_attachment_image_src($works_step_image6, '720_free_contents')[0];
													?>
													<figure class="works-single-step__pict">
														<img src="<?= $works_step_image6_url; ?>" alt="" decoding="async">
													</figure>
												<?php endif; ?>
												<?php
												if ($works_step_image7):
													$works_step_image7_url = wp_get_attachment_image_src($works_step_image7, '720_free_contents')[0];
													?>
													<figure class="works-single-step__pict">
														<img src="<?= $works_step_image7_url; ?>" alt="" decoding="async">
													</figure>
												<?php endif; ?>
												<?php
												if ($works_step_image8):
													$works_step_image8_url = wp_get_attachment_image_src($works_step_image8, '720_free_contents')[0];
													?>
													<figure class="works-single-step__pict">
														<img src="<?= $works_step_image8_url; ?>" alt="" decoding="async">
													</figure>
												<?php endif; ?>
												<?php
												if ($works_step_image9):
													$works_step_image9_url = wp_get_attachment_image_src($works_step_image9, '720_free_contents')[0];
													?>
													<figure class="works-single-step__pict">
														<img src="<?= $works_step_image9_url; ?>" alt="" decoding="async">
													</figure>
												<?php endif; ?>
												<?php
												if ($works_step_image10):
													$works_step_image10_url = wp_get_attachment_image_src($works_step_image10, '720_free_contents')[0];
													?>
													<figure class="works-single-step__pict">
														<img src="<?= $works_step_image10_url; ?>" alt="" decoding="async">
													</figure>
												<?php endif; ?>
											</div>
										</div>
										<span class="works-single-step__arrow u-n-mqUp-lg u-block">
											<img src="<?= $this_img_path; ?>arrow-bottom.svg" alt="" decoding="async">
										</span>
									</section>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
						<?php if ($works_free): ?>
							<section class="works-single-free s-editor">
								<?= $works_free; ?>
							</section>
						<?php endif; ?>
						<?php if ($works_partner[0]['works_partner_dt']): ?>
							<section class="works-single-partner">
								<div class="works-single-flex">
									<div class="works-single-flex__block">
										<div class="works-single-step__header">
											<div class="works-single-step__header__inner">
												<h2 class="works-single-step__heading -partner">
													Partner
												</h2>
											</div>
										</div>
									</div>
									<div class="works-single-flex__block">
										<dl class="works-single-table c-txt-lg">
											<?php foreach ($works_partner as $fields): ?>
												<div class="works-single-table__block">
													<dt>
														<?= $fields['works_partner_dt']; ?>
													</dt>
													<dd>
														<?= $fields['works_partner_dd']; ?>
													</dd>
												</div>
											<?php endforeach; ?>
										</dl>
									</div>
								</div>
							</section>
						<?php endif; ?>
					</div>
				</article>
				<?php
				$prev_post = get_previous_post();
				$next_post = get_next_post();

				if (!empty ($next_post)) {
					$next_href = get_permalink($next_post->ID);
					$next_class = '';
				} else {
					$next_href = 'javascript:void(0);';
					$next_class = 'is-disabled';
				}

				if (!empty ($prev_post)) {
					$prev_href = get_permalink($prev_post->ID);
					$prev_class = '';
				} else {
					$prev_href = 'javascript:void(0);';
					$prev_class = 'is-disabled';
				}
				?>
				<footer class="p-pagination -single">
					<div class="p-pagination__inner">
						<p class="p-pagination__pager -prev <?= $next_class; ?>">
							<a href="<?= $next_href; ?>">
								<i class="c-icon c-arrow u-reverse"></i>
								<span class="p-pagination__pager__txt">戻る</span>
							</a>
						</p>
						<div class="p-button -medium">
							<a href="<?= $root; ?>works/">
								<span class="p-button__txt">実績一覧へ</span>
							</a>
						</div>
						<p class="p-pagination__pager -next <?= $prev_class; ?>">
							<a href="<?= $prev_href; ?>">
								<span class="p-pagination__pager__txt">次へ</span>
								<i class="c-icon c-arrow"></i>
							</a>
						</p>
					</div>
				</footer>
			</div>
		</div>
	</main>
	<?php require_once ($web_root . $root . 'include/layout_footer.php'); ?>
</body>

</html>