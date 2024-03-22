<?php $this_path = 'news/'; ?>
<?php require_once (dirname(__FILE__) . '../../../../include/variable.php'); ?>
<?php require_once (dirname(__FILE__) . '../../../../include/functions.php'); ?>
<?php relativeURL(); ?>
<?php
$directory = array(
	array('ホーム', 'ホーム', ''),
	array('お知らせ', 'お知らせ', 'news/'),
	array(get_the_title(), get_the_title(), 'news/' . get_the_ID() . '/'),
);
$robots = true;

if ($post->post_excerpt) {
	$page_description = $post->post_excerpt;
} else {
	$page_description = getSubstr($post->post_content, 100, '...');
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
	<main class="news-single-main">
		<div class="c-inner-lg">
			<header class="p-hero news-single-hero">
				<div class="p-hero__title">
					<p class="p-hero__title__ja js-fadeup">
						<img src="<?= $this_img_path; ?>news_title.svg" alt="お知らせ" decoding="async">
					</p>
					<p class="p-hero__title__en js-splittext">News</p>
				</div>
			</header>
			<div class="c-flex news-content">
				<div class="c-flex__main">
					<?php
					/* ---------- term ---------- */
					$term = get_the_terms($post->ID, 'category')[0];
					$term_name = $term->name;
					$term_slug = $term->slug;
					?>
					<article class="p-article">
						<header class="p-article__header">
							<div class="c-meta -medium">
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
							<h1 class="p-article__header__title c-crop">
								<?php the_title(); ?>
							</h1>
						</header>
						<div class="s-editor">
							<?php the_content(); ?>
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
					<footer class="p-pagination -single news-single-pagination">
						<div class="p-pagination__inner">
							<p class="p-pagination__pager -prev <?= $next_class; ?>">
								<a href="<?= $next_href; ?>">
									<i class="c-icon c-arrow u-reverse"></i>
									<span class="p-pagination__pager__txt">戻る</span>
								</a>
							</p>
							<div class="p-button -medium">
								<a href="<?= $root; ?>news/">
									<span class="p-button__txt">ニュース一覧へ</span>
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
				<div class="c-flex__side news-single-side">
					<?php require_once (dirname(__FILE__) . '/template/parts/sidebar-news.php'); ?>
				</div>
			</div>
		</div>
	</main>
	<?php require_once ($web_root . $root . 'include/layout_footer.php'); ?>
</body>

</html>