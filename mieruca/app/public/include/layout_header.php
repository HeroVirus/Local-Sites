<!-- l-header-->
<header class="l-header">
	<!-- l-header__inner-->
	<div class="l-header__inner">
		<?php if( $web_path == $root ): ?>
		<h1 class="l-header__logo">
			<a href="<?= $root; ?>">
				<img src="<?= $img_path; ?>common/logo.svg" alt="ミエルカ株式会社" decoding="async" />
			</a>
		</h1>
		<?php else: ?>
		<p class="l-header__logo">
			<a href="<?= $root; ?>">
				<img src="<?= $img_path; ?>common/logo.svg" alt="ミエルカ株式会社" decoding="async" />
			</a>
		</p>
		<?php endif; ?>
		<!-- l-header__nav-->
		<nav class="l-header__nav">
			<ul>
				<li>
					<a href="<?= $root; ?>about/">
						<span class="c-anchor-lineIn-lg">
							<img class="js-svg -about" src="<?= $img_path; ?>common/layout/nav_about.svg" alt="ミエルカの地図" decoding="async" />
						</span>
					</a>
				</li>
				<li>
					<a href="<?= $root; ?>service/">
						<span class="c-anchor-lineIn-lg">
							<img class="js-svg -service" src="<?= $img_path; ?>common/layout/nav_service.svg" alt="ミエルカの道具" decoding="async" />
						</span>
					</a>
				</li>
				<li>
					<a href="<?= $root; ?>works/">
						<span class="c-anchor-lineIn-lg">
							<img class="js-svg -works" src="<?= $img_path; ?>common/layout/nav_works.svg" alt="ミエルカの山" decoding="async" />
						</span>
					</a>
				</li>
				<li>
					<a href="<?= $root; ?>member/">
						<span class="c-anchor-lineIn-lg">
							<img class="js-svg -member" src="<?= $img_path; ?>common/layout/nav_member.svg" alt="ミエルカパートナー" decoding="async" />
						</span>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /l-header__nav-->
	</div>
	<!-- /l-header__inner-->
	<!-- l-header__button-->
	<button class="l-header__button" type="button" aria-label="メインメニューの切替">
		<span>
			<img class="js-svg" src="<?= $img_path; ?>common/icon/mountain.svg" alt="メニューを開ける" decoding="async" />
		</span>
	</button>
	<!-- /l-header__button-->
</header>
<!-- /l-header-->
<!-- l-sitemap-->
<nav class="l-sitemap">
	<header class="l-sitemap__header">
		<p class="l-sitemap__logo">
			<a href="<?= $root; ?>">
				<img src="<?= $img_path; ?>common/logo2.svg" alt="ミエルカ株式会社" decoding="async" />
			</a>
		</p>
		<button class="l-sitemap__close" type="button">
			<span>
				<img src="<?= $img_path; ?>common/layout/sitemap_close.svg" alt="Close" decoding="async" />
			</span>
		</button>
	</header>
	<div class="l-sitemap__main">
		<ul class="l-sitemap__list">
			<li>
				<a href="<?= $root; ?>about/">
					<span class="c-anchor-lineIn-lg">
						<img class="js-svg -about" src="<?= $img_path; ?>common/layout/nav_about.svg" alt="ミエルカの地図" decoding="async" />
					</span>
				</a>
			</li>
			<li>
				<a href="<?= $root; ?>service/">
					<span class="c-anchor-lineIn-lg">
						<img class="js-svg -service" src="<?= $img_path; ?>common/layout/nav_service.svg" alt="ミエルカの道具" decoding="async" />
					</span>
				</a>
			</li>
			<li>
				<a href="<?= $root; ?>works/">
					<span class="c-anchor-lineIn-lg">
						<img class="js-svg -works" src="<?= $img_path; ?>common/layout/nav_works.svg" alt="ミエルカの山" decoding="async" />
					</span>
				</a>
			</li>
			<li>
				<a href="<?= $root; ?>member/">
					<span class="c-anchor-lineIn-lg">
						<img class="js-svg -member" src="<?= $img_path; ?>common/layout/nav_member.svg" alt="ミエルカパートナー" decoding="async" />
					</span>
				</a>
			</li>
		</ul>
		<ul class="l-sitemap__list2">
			<li>
				<a href="<?= $root; ?>company">
					<span class="c-anchor-lineIn-lg">
						<img class="js-svg -company" src="<?= $img_path; ?>common/layout/nav_company.svg" alt="会社概要" decoding="async" />
					</span>
				</a>
			</li>
			<li>
				<a href="<?= $root; ?>news">
					<span class="c-anchor-lineIn-lg">
						<img class="js-svg -news" src="<?= $img_path; ?>common/layout/nav_news.svg" alt="お知らせ" decoding="async" />
					</span>
				</a>
			</li>
			<li>
				<a href="<?= $root; ?>contact">
					<span class="c-anchor-lineIn-lg">
						<img class="js-svg -contact" src="<?= $img_path; ?>common/layout/nav_contact.svg" alt="お問い合わせ" decoding="async" />
					</span>
				</a>
			</li>
		</ul>
	</div>
	<div class="l-sitemap__illust">
		<img src="<?= $img_path; ?>common/layout/sitemap_illust.png" alt="" decoding="async" />
	</div>
</nav>
<!-- /l-sitemap-->
