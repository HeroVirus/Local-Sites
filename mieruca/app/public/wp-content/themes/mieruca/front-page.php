<?php $this_path = 'home/'; ?>
<?php require_once (dirname(__FILE__) . '../../../../include/variable.php'); ?>
<?php require_once (dirname(__FILE__) . '../../../../include/functions.php'); ?>
<?php relativeURL(); ?>
<?php
$directory = array(
  array('ホーム', 'ホーム', '')
);
$robots = true;

$meta = array(
  'title' => getTitle($directory),
  'description' => '',
  'keywords' => '',
);

$preload = array(
  array(
    'href' => $this_img_path . 'kv_bg.svg',
    'as' => 'image',
  ),
);
$style = array(
  $root . 'assets/css/page-home.css',
);
$script = array(
  $root . 'assets/js/page-home.js',
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
  <main class="home-main">
    <!-- home-kv-->
    <div class="home-kv" data-chapter="-1">
      <div class="home-kv__cloud">
        <div class="home-kv__cloud__inner">
          <div class="-unique-1 c-object4">
            <img src="<?= $img_path; ?>common/illust/cloud_blue_4.png" alt="" decoding="async">
          </div>
          <div class="-unique-2 c-object4">
            <img src="<?= $img_path; ?>common/illust/cloud_blue_4.png" alt="" decoding="async">
          </div>
          <div class="-unique-3 c-object4">
            <img src="<?= $img_path; ?>common/illust/cloud_blue_2.png" alt="" decoding="async" class="u-reverse">
          </div>
          <div class="-unique-4 c-object4">
            <img src="<?= $img_path; ?>common/illust/cloud_blue_4.png" alt="" decoding="async">
          </div>
          <div class="-unique-5 c-object4">
            <img src="<?= $img_path; ?>common/illust/cloud_blue_4.png" alt="" decoding="async">
          </div>
        </div>
      </div>
      <div class="home-kv__inner">
        <div class="home-kv__bg">
          <div class="home-kv__bg__inner">
            <div class="home-kv__bg__inner__inner">
              <img src="<?= $this_img_path; ?>kv_bg.svg" alt="" decoding="async">
              <div class="home-kv__bg__person c-object2">
                <img src="<?= $this_img_path; ?>apng-kv_person.png" alt="" decoding="async">
              </div>
            </div>
          </div>
        </div>
        <div class="home-kv__motif js-fade2">
          <div class="home-kv__motif__inner">
            <div class="-unique1 c-object2-2">
              <img src="<?= $img_path; ?>common/motif/motif_1.png" alt="" decoding="async">
            </div>
            <div class="-unique2 c-object2-2">
              <img src="<?= $img_path; ?>common/motif/motif_2.png" alt="" decoding="async">
            </div>
            <div class="-unique3 c-object2-2">
              <img src="<?= $img_path; ?>common/motif/motif_3.png" alt="" decoding="async">
            </div>
            <div class="-unique4 c-object2-2">
              <img src="<?= $img_path; ?>common/motif/motif_4.png" alt="" decoding="async">
            </div>
            <div class="-unique5 c-object2-2">
              <img src="<?= $img_path; ?>common/motif/motif_5.png" alt="" decoding="async">
            </div>
            <div class="-unique6 c-object2-2">
              <img src="<?= $img_path; ?>common/motif/motif_6.png" alt="" decoding="async">
            </div>
            <div class="-unique7 c-object2-2">
              <img src="<?= $img_path; ?>common/motif/motif_7.png" alt="" decoding="async">
            </div>
            <div class="-unique8 c-object2-2">
              <img src="<?= $img_path; ?>common/motif/motif_8.png" alt="" decoding="async">
            </div>
            <div class="-unique9 c-object2-2">
              <img src="<?= $img_path; ?>common/motif/motif_9.png" alt="" decoding="async">
            </div>
            <div class="-unique10 c-object2-2">
              <img src="<?= $img_path; ?>common/motif/motif_10.png" alt="" decoding="async">
            </div>
            <div class="-unique11 c-object2-2">
              <img src="<?= $img_path; ?>common/motif/motif_11.png" alt="" decoding="async">
            </div>
            <div class="-unique12 c-object2-2">
              <img src="<?= $img_path; ?>common/motif/motif_12.png" alt="" decoding="async">
            </div>
            <div class="-unique13 c-object2-2">
              <img src="<?= $img_path; ?>common/motif/motif_13.png" alt="" decoding="async">
            </div>
          </div>
        </div>
        <div class="home-kv__catch js-fade2">
          <div class="home-kv__catch__inner">
            <p>
              <img src="<?= $this_img_path; ?>kv_catch.svg" alt="ミライを、ミワタス 未来会計。" decoding="async">
            </p>
          </div>
        </div>
        <div class="home-kv__txt">
          <div class="home-kv__txt__inner">
            <div class="home-kv__txt__cell -unique1 js-fade2">
              <p class="c-txt-xxl c-crop">
                事業をはじめる、続ける、維持する、盛り上げる。<br>
                それはある意味、冒険のような活動。<br>
                そして経営者は、目の前に迫る<br>
                課題の山や事業のフィールドに立ち向かう冒険者。
              </p>
            </div>
            <div class="home-kv__txt__cell -unique2 js-fade2">
              <p class="c-txt-xxl c-crop">
                経営という名の冒険の先にある道は<br>
                ひとつとして同じ道はない。<br>
                先が見えないことで不安に感じるかもしれない。<br>
                ただ、見えない先には素晴らしい景色が広がっているかもしれない。
              </p>
            </div>
            <div class="home-kv__txt__cell -unique3 js-fade2">
              <p class="c-txt-xxl c-crop">少しでも、先が、未来が見渡せるのなら。</p>
              <p class="c-txt-xxl c-crop">
                冒険者である経営者ががたどってきた足跡、過去会計を見ながら<br class="u-n-mqDown-sm">
                冒険の先にある、未来の事業に必要な地図を描いていく。<br>
                そして、地図をもとに広告、広報、マーケティングを提案する。<br>
                それが、会計と財務の視点で経営者の冒険を支えるミエルカです。
              </p>
            </div>
          </div>
        </div>
        <div class="home-kv__illust">
          <div class="home-kv__illust__inner">
            <div class="home-kv__illust__footprints c-object2-2 js-fade2">
              <img src="<?= $this_img_path; ?>kv_footprints.svg" alt="" decoding="async">
            </div>
            <div class="home-kv__illust__num c-object2-2">
              <picture>
                <source srcset="<?= $this_img_path; ?>kv_num-pc.svg" media="<?= $mqUpLg; ?>">
                <source srcset="<?= $this_img_path; ?>kv_num-sp.svg" media="<?= $mqDownLg; ?>">
                <img src="<?= $this_img_path; ?>kv_num-pc.svg" alt="" decoding="async">
              </picture>
            </div>
            <div class="home-kv__illust__board c-object2-2 js-fade2">
              <img src="<?= $this_img_path; ?>kv_board.png" alt="" decoding="async">
            </div>
            <div class="home-kv__illust__flower c-object2-2 js-fade2">
              <img src="<?= $this_img_path; ?>kv_flower.png" alt="" decoding="async">
            </div>
            <div class="home-kv__illust__flower2 c-object2-2 js-fade2">
              <img src="<?= $this_img_path; ?>kv_flower2.png" alt="" decoding="async">
            </div>
            <div class="home-kv__illust__flower3">
              <picture>
                <source srcset="<?= $this_img_path; ?>kv_flower3-pc.png" media="<?= $mqUpLg; ?>">
                <source srcset="<?= $this_img_path; ?>kv_flower3-sp.png" media="<?= $mqDownLg; ?>">
                <img src="<?= $this_img_path; ?>kv_flower3-pc.png" alt="" decoding="async">
              </picture>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /home-kv-->
    <!-- home-about-->
    <section class="home-about">
      <div class="home-about__illust__cloud u-n-mqUp-lg">
        <div class="-unique-1 c-object4">
          <img class="c-anime-fluffy" src="<?= $img_path; ?>common/illust/cloud_white_1.png" alt="" decoding="async">
        </div>
        <div class="-unique-2 c-object4">
          <img class="u-reverse" src="<?= $img_path; ?>common/illust/cloud_white_2.png" alt="" decoding="async">
        </div>
        <div class="-unique-3 c-object4">
          <img class="c-anime-fluffy2" src="<?= $img_path; ?>common/illust/cloud_white_3.png" alt="" decoding="async">
        </div>
        <div class="-unique-4 c-object4">
          <img class="c-anime-fluffy c-anime-delay-_2" src="<?= $img_path; ?>common/illust/cloud_white_1.png" alt=""
            decoding="async">
        </div>
      </div>
      <div class="c-inner-lg2">
        <div class="home-about__contents">
          <header>
            <div class="c-title js-trigger">
              <h2 class="c-title__ja js-fadeleft">
                <picture>
                  <source srcset="<?= $this_img_path; ?>about_title-pc.svg" media="<?= $mqUpLg; ?>">
                  <source srcset="<?= $this_img_path; ?>about_title-sp.svg" media="<?= $mqDownLg; ?>">
                  <img src="<?= $this_img_path; ?>about_title-pc.svg" alt="ミエルカの地図" decoding="async">
                </picture>
              </h2>
              <p class="c-title__en js-splittext">About us</p>
            </div>
          </header>
          <div class="home-about__txt c-txt-lg c-crop c-txts">
            <p>
              広告、広報、マーケティングのトレンドは、日々変化しています。今日まで効果があった施策が、明日にはもう時代遅れになっていることもあるくらい、急激な速度で変化し続けています。その激変する時代の中で、適正な利益を生み続け、事業を継続していくためには、自社の事業のことを知ることが重要です。
            </p>
            <p>ミエルカは、財務・会計のプロとマーケティングのプロが、事業の足下を分析し、土台を固めた上で、未来の事業発展に向けた提案を行います。具体的な数字で評価・検証する広告、広報、マーケティングが特徴です。</p>
          </div>
          <p class="home-about__button p-button -medium">
            <a href="<?= $root; ?>about/">
              <span class="p-button__txt">もっと詳しく</span>
            </a>
          </p>
        </div>
      </div>
      <div class="home-about__illust c-inner-full2">
        <div class="home-about__illust__inner">
          <img src="<?= $this_img_path; ?>about_illust.png" alt="" decoding="async">
          <div class="home-about__illust__cloud u-n-mqDown-lg">
            <div class="-unique-1 c-object4">
              <img class="c-anime-fluffy" src="<?= $img_path; ?>common/illust/cloud_white_1.png" alt=""
                decoding="async">
            </div>
            <div class="-unique-2 c-object4">
              <img class="u-reverse" src="<?= $img_path; ?>common/illust/cloud_white_2.png" alt="" decoding="async">
            </div>
            <div class="-unique-3 c-object4">
              <img class="c-anime-fluffy2" src="<?= $img_path; ?>common/illust/cloud_white_3.png" alt=""
                decoding="async">
            </div>
            <div class="-unique-4 c-object4">
              <img class="c-anime-fluffy c-anime-delay-_2" src="<?= $img_path; ?>common/illust/cloud_white_1.png" alt=""
                decoding="async">
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /home-about-->
    <!-- home-service-->
    <section class="home-service">
      <div class="c-inner-lg2">
        <div class="home-service__contents">
          <header>
            <div class="c-title js-trigger">
              <h2 class="c-title__ja js-fadeleft">
                <picture>
                  <source srcset="<?= $this_img_path; ?>service_title-pc.svg" media="<?= $mqUpLg; ?>">
                  <source srcset="<?= $this_img_path; ?>service_title-sp.svg" media="<?= $mqDownLg; ?>">
                  <img src="<?= $this_img_path; ?>service_title-pc.svg" alt="ミエルカの道具" decoding="async">
                </picture>
              </h2>
              <p class="c-title__en js-splittext">Service</p>
            </div>
          </header>
          <p class="home-service__txt c-txt-lg c-crop">
            未来を見渡すための広告、広報、マーケティングの手法は多種多様です。時代の変化・進化とともに必要とされる経営判断において、より確度が高く、スピード感のある施策がその都度求められます。私たちが提供したいのは、経営者、事業それぞれの強み、弱み、得意、不得意をしっかりと共有した上で、会計・財務の視点からサポートするオーダーメードのサービスです。
          </p>
          <p class="home-service__button p-button -medium">
            <a href="<?= $root; ?>service/">
              <span class="p-button__txt">もっと詳しく</span>
            </a>
          </p>
        </div>
      </div>
      <div class="home-service__illust c-inner-full2">
        <div class="home-service__illust__inner">
          <div class="home-service__illust__img">
            <img src="<?= $this_img_path; ?>service_illust.png" alt="" decoding="async">
          </div>
          <div class="home-service__illust__cloud">
            <div class="-unique-1 c-object4">
              <img class="c-anime-fluffy c-anime-delay-_2" src="<?= $img_path; ?>common/illust/cloud_blue_1.png" alt=""
                decoding="async">
            </div>
            <div class="-unique-2 c-object4">
              <img class="c-anime-fluffy" src="<?= $img_path; ?>common/illust/cloud_blue_1.png" alt="" decoding="async">
            </div>
            <div class="-unique-3 c-object4">
              <img class="c-anime-fluffy2" src="<?= $img_path; ?>common/illust/cloud_blue_1.png" alt=""
                decoding="async">
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /home-service-->
    <!-- home-works-->
    <section class="home-works">
      <div class="home-works__cloud c-inner-full">
        <div class="-unique-1 c-object4">
          <img class="c-anime-fluffy" src="<?= $img_path; ?>common/illust/cloud_blue_1.png" alt="" decoding="async">
        </div>
        <div class="-unique-2 c-object4">
          <img src="<?= $img_path; ?>common/illust/cloud_blue_1.png" alt="" decoding="async">
        </div>
        <div class="-unique-3 c-object4">
          <img class="c-anime-fluffy2" src="<?= $img_path; ?>common/illust/cloud_blue_1.png" alt="" decoding="async">
        </div>
        <div class="-unique-4 c-object4">
          <img class="c-anime-fluffy2 c-anime-delay-_1" src="<?= $img_path; ?>common/illust/cloud_blue_1.png" alt=""
            decoding="async">
        </div>
        <div class="-unique-5 c-object4">
          <img src="<?= $img_path; ?>common/illust/cloud_blue_1.png" alt="" decoding="async">
        </div>
        <div class="-unique-6 c-object4">
          <img class="c-anime-fluffy" src="<?= $img_path; ?>common/illust/cloud_blue_1.png" alt="" decoding="async">
        </div>
      </div>
      <div class="home-works__body">
        <div class="c-mountain -large">
          <div class="c-mountain__triangle"></div>
          <div class="c-mountain__base"></div>
        </div>
        <div class="home-works__motifs">
          <div class="home-works__motifs__top c-inner-full">
            <div class="-unique-1 c-object4-2 js-trigger js-scale">
              <img src="<?= $img_path; ?>common/motif/motif_2.png" alt="" decoding="async">
            </div>
            <div class="-unique-2 c-object4-2 js-trigger js-scale">
              <img src="<?= $img_path; ?>common/motif/motif_5.png" alt="" decoding="async">
            </div>
          </div>
          <div class="home-works__motifs__main"></div>
        </div>
        <div class="home-works__inner c-inner-lg">
          <header>
            <div class="c-title u-t-center js-trigger">
              <h2 class="c-title__ja js-fadeleft">
                <picture>
                  <source srcset="<?= $this_img_path; ?>works_title-pc.svg" media="<?= $mqUpLg; ?>">
                  <source srcset="<?= $this_img_path; ?>works_title-sp.svg" media="<?= $mqDownLg; ?>">
                  <img src="<?= $this_img_path; ?>works_title-pc.svg" alt="ミエルカの山" decoding="async">
                </picture>
              </h2>
              <p class="c-title__en js-splittext">Works</p>
            </div>
          </header>
          <?php
          $args = array(
            'post_type' => 'works',
            'post_status' => 'publish',
            'posts_per_page' => 10
          );
          $the_query = new WP_Query($args);
          if ($the_query->have_posts()):
            ?>
          <div class="home-works__carousel">
            <div class="home-works__carousel__main">
              <div class="swiper-wrapper">
                <?php while ($the_query->have_posts()):
                    $the_query->the_post(); ?>
                <?php
                    $works_outline = SCF::get('works_outline');

                    /* ---------- thumbanil ---------- */
                    if (has_post_thumbnail()) {
                      $image_id = get_post_thumbnail_id();
                      $image_file = wp_get_attachment_image_src($image_id, '500_400_thumbnail');
                      $image_file = $image_file[0];

                      $image = '<img src="' . $image_file . '" alt="" class="c-objectfit -cover">';
                    } else {
                      $image = '<img src="' . $noimage2_file . '" alt="" class="c-objectfit -cover">';
                    }
                    ?>
                <article class="p-card2 -medium swiper-slide">
                  <a href="<?php the_permalink(); ?>">
                    <h3 class="p-card2__title c-crop u-n-mqUp-md">
                      <span class="c-anchor-lineIn-lg">
                        <?php the_title(); ?>
                      </span>
                    </h3>
                    <figure class="p-card2__figure c-radius-md c-bg2">
                      <?= $image; ?>
                    </figure>
                    <div class="p-card2__contents">
                      <h3 class="p-card2__title c-crop u-n-mqDown-md">
                        <span class="c-anchor-lineIn-lg">
                          <?php the_title(); ?>
                        </span>
                      </h3>
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
                <?php endwhile; ?>
              </div>
              <div class="home-works__carousel__main__arrows">
                <button class="home-works__carousel__main__arrow -prev" type="button">
                  <img class="js-svg" src="<?= $img_path; ?>common/icon/arrow3.svg" alt="" decoding="async">
                </button>
                <button class="home-works__carousel__main__arrow -next" type="button">
                  <img class="js-svg" src="<?= $img_path; ?>common/icon/arrow3.svg" alt="" decoding="async">
                </button>
              </div>
            </div>
            <div class="home-works__carousel__sub">
              <div class="swiper-wrapper">
                <?php while ($the_query->have_posts()):
                    $the_query->the_post(); ?>
                <?php
                    /* ---------- thumbanil ---------- */
                    if (has_post_thumbnail()) {
                      $image_id = get_post_thumbnail_id();
                      $image_file = wp_get_attachment_image_src($image_id, '220_180_thumbnail');
                      $image_file = $image_file[0];

                      $image = '<img src="' . $image_file . '" alt="" class="c-objectfit -cover">';
                    } else {
                      $image = '<img src="' . $noimage2_file . '" alt="" class="c-objectfit -cover">';
                    }
                    ?>
                <article class="p-card3 -small swiper-slide">
                  <a href="<?php the_permalink(); ?>">
                    <figure class="p-card3__figure c-radius-sm c-bg2">
                      <?= $image; ?>
                    </figure>
                    <h3 class="p-card3__title c-crop">
                      <span class="c-anchor-lineIn-lg">
                        <span>
                          <?php the_title(); ?>
                        </span>
                      </span>
                    </h3>
                  </a>
                </article>
                <?php endwhile; ?>
              </div>
              <button class="home-works__carousel__sub__arrow -prev" type="button"></button>
              <button class="home-works__carousel__sub__arrow -next" type="button"></button>
            </div>
          </div>
          <?php endif;
          wp_reset_postdata(); ?>
          <p class="home-works__button p-button -medium">
            <a href="<?= $root; ?>works/">
              <span class="p-button__txt">実績一覧へ</span>
            </a>
          </p>
        </div>
      </div>
    </section>
    <!-- /home-works-->
    <!-- home-member-->
    <section class="home-member">
      <div class="home-member__inner c-inner-lg">
        <header class="home-member__header">
          <div class="c-title js-trigger">
            <h2 class="c-title__ja js-fadeleft">
              <picture>
                <source srcset="<?= $this_img_path; ?>member_title-pc.svg" media="<?= $mqUpLg; ?>">
                <source srcset="<?= $this_img_path; ?>member_title-sp.svg" media="<?= $mqDownLg; ?>">
                <img src="<?= $this_img_path; ?>member_title-pc.svg" alt="ミエルカパートナー" decoding="async">
              </picture>
            </h2>
            <p class="c-title__en js-splittext">Member</p>
          </div>
        </header>
        <div class="home-member_illust js-trigger u-n-mqDown-lg">
          <img class="js-fade" src="<?= $this_img_path; ?>member_illust_1.png" alt="" decoding="async">
          <img class="js-fadeleft js-delay-3" src="<?= $this_img_path; ?>member_illust_2.png" alt="" decoding="async">
          <img class="js-fadeleft js-delay-4" src="<?= $this_img_path; ?>member_illust_3.png" alt="" decoding="async">
          <img class="js-fadeleft js-delay-5" src="<?= $this_img_path; ?>member_illust_4.png" alt="" decoding="async">
        </div>
        <div class="home-member__contents">
          <p class="c-txt-lg c-crop">
            財務・会計、マーケティングの分野に精通したスタッフが、広告、広報、マーケティングの相談を承ります。また、各士業、プランナー、デザイナー、カメラマン、動画編集者などとチームを組み、幅広い手法、切り口によるご提案が可能です。
          </p>
          <div class="home-member_illust js-trigger u-n-mqUp-lg">
            <img class="js-fade" src="<?= $this_img_path; ?>member_illust_1.png" alt="" decoding="async">
            <img class="js-fadeleft js-delay-3" src="<?= $this_img_path; ?>member_illust_2.png" alt="" decoding="async">
            <img class="js-fadeleft js-delay-4" src="<?= $this_img_path; ?>member_illust_3.png" alt="" decoding="async">
            <img class="js-fadeleft js-delay-5" src="<?= $this_img_path; ?>member_illust_4.png" alt="" decoding="async">
          </div>
          <ul class="home-member__list c-column -col-3-sm -gap-c-20">
            <?php
            $args = array(
              'post_type' => 'member',
              'post_status' => 'publish',
              'posts_per_page' => 3
            );
            $the_query = new WP_Query($args);
            if ($the_query->have_posts()):
              while ($the_query->have_posts()):
                $the_query->the_post();
                ?>
            <?php
                /* ---------- thumbanil ---------- */
                $member_thumbnail2 = SCF::get('member_thumbnail2');

                if ($member_thumbnail2) {
                  $member_thumbnail2_url = wp_get_attachment_image_src($member_thumbnail2, '170_170_thumbnail');
                  $member_thumbnail2_url = $member_thumbnail2_url[0];
                } else {
                  $member_thumbnail2_url = $noimage_file;
                }
                ?>
            <li>
              <figure class="home-member__list__figure c-aspect -square c-radius-sm">
                <img src="<?= $member_thumbnail2_url; ?>" alt="" class="c-objectfit -cover" decoding="async">
              </figure>
              <p class="home-member__list__name">
                <?php the_title(); ?>
              </p>
            </li>
            <?php
              endwhile;
            endif;
            wp_reset_postdata();
            ?>
          </ul>
          <p class="home-member__button p-button -medium">
            <a href="<?= $root; ?>member/">
              <span class="p-button__txt">一覧へ</span>
            </a>
          </p>
        </div>
      </div>
    </section>
    <!-- /home-member-->
    <!-- home-news-->
    <section class="home-news">
      <div class="home-news__inner c-inner-lg -contents-lg">
        <header class="home-news__header">
          <div class="c-title u-t-center-mqDown-lg js-trigger">
            <h2 class="c-title__ja js-fadeleft">
              <img src="<?= $this_img_path; ?>news_title.svg" alt="お知らせ" decoding="async">
            </h2>
            <p class="c-title__en js-splittext">News</p>
          </div>
          <p class="home-news__button p-button -medium u-n-mqDown-lg">
            <a href="<?= $root; ?>news/">
              <span class="p-button__txt">一覧へ</span>
            </a>
          </p>
        </header>
        <div class="home-news__contents">
          <?php
          $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 3
          );
          $the_query = new WP_Query($args);
          if ($the_query->have_posts()):
            while ($the_query->have_posts()):
              $the_query->the_post();
              ?>
          <?php
              /* ---------- term ---------- */
              // 親要素がある場合は、親要素を表示
              $term = get_the_terms($post->ID, 'category')[0];
              $term_name = $term->name;
              $term_slug = $term->slug;


              /* ---------- thumbanil ---------- */
              if (has_post_thumbnail()) {
                $image_id = get_post_thumbnail_id();
                $image_file = wp_get_attachment_image_src($image_id, '130_130_thumbnail');
                $image_file = $image_file[0];

                $image = '<img src="' . $placeholder_file . '" data-original="' . $image_file . '" alt="" class="c-objectfit -cover js-lazyload">';
              } else {
                $image = '<img src="' . $noimage_file . '" alt="" class="c-objectfit -cover">';
              }

              ?>
          <article class="p-card">
            <a href="<?php the_permalink(); ?>">
              <figure class="p-card__figure c-aspect -square c-radius-sm c-bg2">
                <?= $image; ?>
              </figure>
              <div class="p-card__contents">
                <div class="c-meta -small">
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
                <h3 class="p-card__title c-crop">
                  <span class="c-anchor-lineIn-lg">
                    <span>
                      <?php the_title(); ?>
                    </span>
                  </span>
                </h3>
              </div>
            </a>
          </article>
          <?php
            endwhile;
          else:
            echo '<p class="c-txt-lg c-crop">現在投稿がありません。</p>';
          endif;
          wp_reset_postdata();

          ?>
        </div>
        <p class="home-news__button p-button -medium u-n-mqUp-lg">
          <a href="<?= $root; ?>news/">
            <span class="p-button__txt">一覧へ</span>
          </a>
        </p>
      </div>
    </section>
    <!-- /home-news-->
  </main>
  <?php require_once ($web_root . $root . 'include/layout_footer.php'); ?>
</body>

</html>