<?php
	$title       = removeUseless( $meta['title'] );
	$description = removeUseless( $meta['description'] );
	$keywords    = removeUseless( $meta['keywords'] );
 ?>
	<meta charset="UTF-8">
	<title><?= $title; ?></title>
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
	<meta name="format-detection" content="telephone=no">
<?php if( $robots == true ): ?>
	<meta name="robots" content="all">
<?php else: ?>
	<meta name="robots" content="noindex,nofollow">
<?php endif; ?>
<?php if( $description ): ?>
	<meta name="description" content="<?= $description; ?>">
<?php endif; ?>
<?php if( $keywords ): ?>
	<meta name="keywords" content="<?= $keywords; ?>">
<?php endif; ?>
	<meta name="copyright" content="© <?= $author; ?>">
	<meta name="author" content="<?= $author; ?>">
	<meta name="theme-color" content="<?= $theme_color; ?>">
	<meta name="msapplication-TileColor" content="<?= $theme_color; ?>">
	<meta name="application-name" content="<?= $site_name; ?>">
	<meta name="apple-mobile-web-app-title" content="<?= $site_name; ?>">
	<meta name="thumbnail" content="<?= $ogp_url; ?>">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="<?= $title;?>">
<?php if( $description ): ?>
	<meta name="twitter:description" content="<?= $description; ?>">
<?php endif; ?>
	<meta name="twitter:image:src" content="<?= $ogp_url; ?>">
<?php if( $web_path == $root ): ?>
	<meta property="og:type" content="website">
<?php else: ?>
	<meta property="og:type" content="article">
<?php endif; ?>
	<meta property="og:site_name" content="<?= $site_name; ?>">
	<meta property="og:title" content="<?= $title;?>">
<?php if( $description ): ?>
	<meta property="og:description" content="<?= $description; ?>">
<?php endif; ?>
	<meta property="og:url" content="<?= $url; ?>">
	<meta property="og:image" content="<?= $ogp_url; ?>">
	<meta property="og:locale" content="ja_JP">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="dns-prefetch" href="//fonts.googleapis.com">
	<link rel="dns-prefetch" href="//www.google-analytics.com">
	<link rel="preload" href="<?= $root; ?>assets/css/common.min.css<?= $cash_data; ?>" as="style">
	<link rel="preload" href="<?= $root; ?>assets/js/library.js<?= $cash_data; ?>" as="script">
	<link rel="preload" href="<?= $root; ?>assets/js/module.min.js<?= $cash_data; ?>" as="script">
	<!-- <link rel="preload" href="<?= $root; ?>assets/img/common/loading.svg" as="image"> -->
<?php outputPreload( $preload ); ?>
	<link rel="index" href="<?= $home_url; ?>">
	<link rel="canonical" href="<?= $url; ?>">
	<!-- <link rel="contents" href="<?= $home_url; ?>sitemap.xml" title="サイトマップ"> -->
	<link rel="icon" type="image/x-icon" href="<?= $root; ?>assets/img/meta/favicon.ico">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Palanquin+Dark:wght@500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?= $root; ?>assets/css/common.min.css<?= $cash_data; ?>">
<?php outputStyle( $style ); ?>
	<script> </script>
<?php if( $jquery === true ): ?>
	<script src="<?= $root; ?>assets/js/jquery-library.js<?= $cash_data; ?>" defer></script>
<?php endif; ?>
	<script src="<?= $root; ?>assets/js/library.js<?= $cash_data; ?>" defer></script>
	<script src="<?= $root; ?>assets/js/module.min.js<?= $cash_data; ?>" defer></script>
	<script src="<?= $root; ?>assets/js/common.js<?= $cash_data; ?>" defer></script>
<?php outputScript( $script ); ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-568NKYHNJD"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-568NKYHNJD');
	</script>

<?php if( $test_mode == true ): ?>
	<meta name="robots" content="noindex,nofollow">
<?php endif; ?>
