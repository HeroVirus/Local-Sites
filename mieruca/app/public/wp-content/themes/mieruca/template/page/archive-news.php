<?php $this_path = 'news/'; ?>
<?php require_once (dirname(__FILE__) . '/../../../../../include/variable.php'); ?>
<?php require_once (dirname(__FILE__) . '/../../../../../include/functions.php'); ?>
<?php relativeURL(); ?>
<?php
$directory = array(
	array('ホーム', 'ホーム', ''),
	array('お知らせ', 'お知らせ', 'news/'),
);
$robots = true;

if (is_home() && !is_date() && !is_tax()) {
	$page_description = '';
} else {
	$directory = getWPDirectory($directory);
	// $page_description = '〇〇のカテゴリー別ブログ「'. wp_get_document_title() .'」についてご案内します。';
	$page_description = '';
}

$meta = array(
	'title' => getTitle($directory),
	'description' => $page_description,
	'keywords' => '',
);

$preload = array();
$style = array(
	$root . 'assets/css/page-news.css',
);
$script = array(
	$root . 'assets/js/page-news.js',
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
	<main class="news-main">
		<div class="c-inner-lg">
			<header class="p-hero news-hero">
				<div class="p-hero__title">
					<?php if (is_home() && !is_date() && !is_tax()): ?>
						<h1 class="p-hero__title__ja js-fadeup">
							<img src="<?= $this_img_path; ?>news_title.svg" alt="お知らせ" decoding="async">
						</h1>
					<?php else: ?>
						<p class="p-hero__title__ja js-fadeup">
							<img src="<?= $this_img_path; ?>news_title.svg" alt="お知らせ" decoding="async">
						</p>
					<?php endif; ?>
					<p class="p-hero__title__en js-splittext">News</p>
				</div>
			</header>
			<div class="c-flex news-content">
				<div class="c-flex__main">
					<!-- c-column -->
					<?php if (have_posts()): ?>
						<div class="c-column -col-2 -gap-c-60 -gap-r-87">
							<?php while (have_posts()):
								the_post(); ?>
								<?php
								/* ---------- term ---------- */
								// 親要素がある場合は、親要素を表示
								$term = get_the_terms($post->ID, 'category')[0];
								$term_name = $term->name;
								$term_slug = $term->slug;


								/* ---------- thumbanil ---------- */
								if (has_post_thumbnail()) {
									$image_id = get_post_thumbnail_id();
									$image_file = wp_get_attachment_image_src($image_id, '400_300_thumbnail');
									$image_file = $image_file[0];

									$image = '<img src="' . $placeholder_file . '" data-original="' . $image_file . '" alt="" class="c-objectfit -cover js-lazyload">';
								} else {
									$image = '<img src="' . $noimage_file . '" alt="" class="c-objectfit -cover">';
								}

								?>
								<article class="p-card4">
									<a href="<?php the_permalink(); ?>">
										<figure class="p-card4__figure c-bg2">
											<?= $image; ?>
										</figure>
										<div class="p-card4__contents">
											<div class="c-meta -small2">
												<p class="c-meta__time">
													<time datetime="<?php the_time('Y-m-d'); ?>">
														<?php the_time('Y.m.d'); ?>
													</time>
												</p>
												<p class="c-meta__term">
													<span>
														<?= $term_name; ?>
													</span>
												</p>
											</div>
											<h3 class="p-card4__title c-crop">
												<span class="c-anchor-lineIn-lg">
													<span>
														<?php the_title(); ?>
													</span>
												</span>
											</h3>
										</div>
									</a>
								</article>
							<?php endwhile; ?>
						</div>
						<?php
					else:
						echo '<p class="c-txt-lg c-crop">現在投稿がありません。</p>';
					endif;
					?>
					<!-- /c-column -->
					<!-- p-pagination -->
					<?php pagination($wp_query->max_num_pages); ?>
					<!-- /p-pagination -->
				</div>
				<div class="c-flex__side news-side">
					<?php require_once (dirname(__FILE__) . './../parts/sidebar-news.php'); ?>
				</div>
			</div>
		</div>
	</main>
	<?php require_once ($web_root . $root . 'include/layout_footer.php'); ?>
</body>

</html>