<?php $this_path = 'works/'; ?>
<?php require_once (dirname(__FILE__) . '/../../../../../include/variable.php'); ?>
<?php require_once (dirname(__FILE__) . '/../../../../../include/functions.php'); ?>
<?php relativeURL(); ?>
<?php
$directory = array(
	array('ホーム', 'ホームj', ''),
	array('ミエルカの山', 'ミエルカの山', 'works/'),
);
$robots = true;

$meta = array(
	'title' => getTitle($directory),
	'description' => '',
	'keywords' => '',
);

$preload = array();
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
	<main class="works-main c-motifs-wrap">
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
						<h1 class="p-hero__title__ja works-title js-fadeup">
							<picture>
								<source srcset="<?= $this_img_path; ?>works_title-pc.svg" media="<?= $mqUpLg; ?>">
								<source srcset="<?= $this_img_path; ?>works_title-sp.svg" media="<?= $mqDownLg; ?>">
								<img src="<?= $this_img_path; ?>works_title-pc.svg" alt="ミエルカの山" decoding="async">
							</picture>
						</h1>
						<p class="p-hero__title__en js-splittext">Works</p>
					</div>
				</header>
				<!-- sticky -->
				<?php if (!is_paged()): // 1ページ目  ?>
					<?php if (get_option('sticky_posts')): ?>
						<?php
						$args = array(
							'post_type' => 'works',
							'posts_per_page' => -1,
							'post__in' => get_option('sticky_posts'),
							'ignore_sticky_posts' => 1
						);
						$the_query = new WP_Query($args);
						if ($the_query->have_posts()):
							while ($the_query->have_posts()):
								$the_query->the_post();
								?>
								<div class="works-pickup">
									<?php
									$works_outline = SCF::get('works_outline');

									/* ---------- thumbanil ---------- */
									if (has_post_thumbnail()) {
										$image_id = get_post_thumbnail_id();
										$image_file = wp_get_attachment_image_src($image_id, '620_496_thumbnail');
										$image_file = $image_file[0];

										$image = '<img src="' . $placeholder_file . '" data-original="' . $image_file . '" alt="" class="c-objectfit -cover js-lazyload">';
									} else {
										$image = '<img src="' . $noimage2_file . '" alt="" class="c-objectfit -cover">';
									}
									?>
									<article class="p-card2 -small js-trigger js-fadeup">
										<a href="<?php the_permalink(); ?>">
											<h2 class="p-card2__title c-crop u-n-mqUp-md">
												<span class="c-anchor-lineIn-lg">
													<?php the_title(); ?>
												</span>
											</h2>
											<figure class="p-card2__figure c-bg2">
												<?= $image; ?>
											</figure>
											<div class="p-card2__contents">
												<h2 class="p-card2__title c-crop u-n-mqDown-md">
													<span class="c-anchor-lineIn-lg">
														<?php the_title(); ?>
													</span>
												</h2>
												<p class="c-txt-lg c-crop">
													<span>
														<?php echo wp_trim_words($works_outline, 310, '...'); ?>
													</span>
												</p>
												<p class="p-button -medium">
													<span>
														<span class="p-button__txt">もっと詳しく</span>
													</span>
												</p>
											</div>
										</a>
									</article>
								</div>
							<?php endwhile; endif;
						wp_reset_postdata(); ?>
					<?php endif; ?>
				<?php endif; ?>
				<!-- /sticky -->
				<!-- 通常のループ -->
				<?php if (have_posts()): ?>
					<div class="works-list c-column -col-3 -gap-c-60 -gap-r-62">
						<?php while (have_posts()):
							the_post(); ?>
							<?php if (!is_sticky()): ?>
								<?php
								/* ---------- thumbanil ---------- */
								if (has_post_thumbnail()) {
									$image_id = get_post_thumbnail_id();
									$image_file = wp_get_attachment_image_src($image_id, '360_294_thumbnail');
									$image_file = $image_file[0];

									$image = '<img src="' . $placeholder_file . '" data-original="' . $image_file . '" alt="" class="c-objectfit -cover js-lazyload">';
								} else {
									$image = '<img src="' . $noimage2_file . '" alt="" class="c-objectfit -cover">';
								}

								?>
								<article class="p-card3 -medium js-trigger js-fadeup">
									<a href="<?php the_permalink(); ?>">
										<figure class="p-card3__figure c-bg2">
											<?= $image; ?>
										</figure>
										<h2 class="p-card3__title c-crop">
											<span class="c-anchor-lineIn-1lg">
												<?php the_title(); ?>
											</span>
										</h2>
									</a>
								</article>
							<?php endif; ?>
						<?php endwhile; ?>
					</div>
					<?php
				else:
					echo '<p class="c-txt-lg c-crop works-contents__txt">現在投稿がありません。</p>';
				endif;
				?>
				<!-- /通常のループ -->
				<!-- p-pagination -->
				<?php pagination($wp_query->max_num_pages); ?>
				<!-- /p-pagination -->
			</div>
		</div>
	</main>
	<?php require_once ($web_root . $root . 'include/layout_footer.php'); ?>
</body>

</html>