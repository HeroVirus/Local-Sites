<!-- l-footer-->
<footer class="l-footer">
	<div class="l-footer__illust">
		<div class="l-footer__mountain"></div>
		<div class="l-footer__illust__cloud">
			<div class="c-object2 -unique1">
				<img src="<?= $img_path; ?>common/illust/cloud_blue_3.png" alt="" decoding="async" />
			</div>
			<div class="c-object2 -unique2">
				<img src="<?= $img_path; ?>common/illust/cloud_blue_2.png" alt="" decoding="async" />
			</div>
			<div class="c-object2 -unique3">
				<img class="u-reverse" src="<?= $img_path; ?>common/illust/cloud_blue_1.png" alt="" decoding="async" />
			</div>
			<div class="c-object2 -unique4">
				<img src="<?= $img_path; ?>common/illust/cloud_blue_1.png" alt="" decoding="async" />
			</div>
			<div class="c-object2 -unique5">
				<img src="<?= $img_path; ?>common/illust/cloud_blue_2.png" alt="" decoding="async" />
			</div>
			<div class="c-object2 -unique6">
				<img src="<?= $img_path; ?>common/illust/cloud_blue_3.png" alt="" decoding="async" />
			</div>
			<div class="c-object2 -unique7">
				<img src="<?= $img_path; ?>common/illust/cloud_blue_1.png" alt="" decoding="async" />
			</div>
			<div class="c-object2 -unique8">
				<img src="<?= $img_path; ?>common/illust/cloud_blue_2.png" alt="" decoding="async" />
			</div>
			<div class="c-object2 -unique9">
				<img class="u-reverse" src="<?= $img_path; ?>common/illust/cloud_blue_1.png" alt="" decoding="async" />
			</div>
		</div>
	</div>
	<div class="c-inner-full -contents">
		<div class="l-footer__inner">
			<address class="l-footer__profile">
				<p class="l-footer__logo">
					<a href="<?= $root; ?>">
						<img src="<?= $img_path; ?>common/logo2.svg" alt="ミエルカ株式会社" decoding="async" />
					</a>
				</p>
				<p class="l-footer__address">
					<picture>
						<source srcset="<?= $img_path; ?>common/layout/footer_address-pc.svg" media="<?= $mqUpLg; ?>" />
						<source srcset="<?= $img_path; ?>common/layout/footer_address-sp.svg" media="<?= $mqDownLg; ?>" />
						<img src="<?= $img_path; ?>common/layout/footer_address-pc.svg" alt="〒850-0057 長崎市大黒町14番5号 ニュー長崎ビルディング地下1階" decoding="async" />
					</picture>
				</p>
				<p class="p-button2 -medium -center-mqDown-lg">
					<a href="<?= $googlemap_url; ?>" target="_blank" rel="noopener noreferrer">
						<i class="c-cicon c-pin -medium"></i>
						<span class="p-button2__txt c-anchor-lineIn">Google Maps</span>
					</a>
				</p>
				<p class="c-tel -large -white -center-mqDown-lg">
					<span class="c-tel__en">Tel.</span>
					<span class="c-tel__num">095-820-0100</span>
				</p>
			</address>
			<nav class="l-footer__nav">
				<ul class="l-footer__nav__main">
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
				<ul class="l-footer__nav__sub">
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
			</nav>
		</div>
		<p class="l-footer__copyright">
			<small>
				<img src="<?= $img_path; ?>common/layout/footer_copyright.svg" alt="©MIERUKA CO.LTD. ALL RIGHTS RESERVED." decoding="async" />
			</small>
		</p>
	</div>
</footer>
<!-- /l-footer-->
