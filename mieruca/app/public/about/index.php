<?php $this_path = 'about/'; ?>
<?php require_once (dirname(__FILE__) . '/../include/variable.php'); ?>
<?php require_once (dirname(__FILE__) . '/../include/functions.php'); ?>
<?php
$directory = array(
	array('ホーム', 'ホーム', ''),
	array('ミエルカの道具', 'ミエルカの道具', 'about/'),
);
$robots = true;

$meta = array(
	'title' => getTitle($directory),
	'description' => '',
	'keywords' => '',
);

$preload = array(
	array(
		'href' => $this_img_path . 'about_fv-pc.png',
		'as' => 'image',
	),
);
$style = array(
	$root . 'assets/css/page-about.css',
);
$script = array(
	$root . 'assets/js/page-about.js',
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
  <main class="about-main">
    <header class="p-hero about-hero">
      <div class="p-hero__title">
        <h1 class="p-hero__title__ja js-fadeup">
          <picture>
            <source srcset="<?= $this_img_path; ?>about_title-pc.svg" media="<?= $mqUpLg; ?>">
            <source srcset="<?= $this_img_path; ?>about_title-sp.svg" media="<?= $mqDownLg; ?>">
            <img src="<?= $this_img_path; ?>about_title-pc.svg" alt="ミエルカの地図" decoding="async">
          </picture>
        </h1>
        <p class="p-hero__title__en js-splittext">About us</p>
      </div>
      <div class="p-hero__cloud">
        <div class="c-object2 -unique1 c-anime-fluffy c-anime-delay-_3">
          <img src="<?= $img_path; ?>common/illust/cloud_blue_1.png" alt="" decoding="async">
        </div>
        <div class="c-object2 -unique2 c-anime-fluffy">
          <img src="<?= $img_path; ?>common/illust/cloud_blue_2.png" alt="" decoding="async">
        </div>
        <div class="c-object2 -unique3 c-anime-fluffy c-anime-delay-_2">
          <img src="<?= $img_path; ?>common/illust/cloud_blue_3.png" alt="" decoding="async">
        </div>
        <div class="c-object2 -unique4 c-anime-fluffy c-anime-delay-_3">
          <img src="<?= $img_path; ?>common/illust/cloud_blue_1.png" alt="" decoding="async">
        </div>
      </div>
    </header>
    <div class="about-catch">
      <div class="about-catch__main">
        <div class="about-catch__main__inner">
          <p class="about-catch__lead">
            <picture>
              <source srcset="<?= $this_img_path; ?>about_catch_lead-pc.svg" media="<?= $mqUpLg; ?>">
              <source srcset="<?= $this_img_path; ?>about_catch_lead-sp.svg" media="<?= $mqDownLg; ?>">
              <img src="<?= $this_img_path; ?>about_catch_lead-pc.svg" alt="経営という冒険に挑む経営者の少し未来を見渡す。" decoding="async">
            </picture>
          </p>
          <div class="about-catch__illust-sp js-trigger js-faderight">
            <div class="about-catch__illust-sp__inner">
              <img src="<?= $this_img_path; ?>about_fv-sp.png" alt="" decoding="async">
            </div>
          </div>
          <p class="about-catch__txt c-txt-lg c-crop">経営は、冒険のような活動。<br>そして経営者は、<br>課題の山や事業のフィールドに立ち向かう冒険者。</p>
          <p class="about-catch__txt c-txt-lg c-crop">
            冒険者である経営者に対して、税務、財務・会計の分野で<br>事業のサポートを行ってきた私たちに<br>もっとできることはないか。<br>財務・会計のプロだからこそできることはなにか。<br>その問いからスタートしたのが、<br>少し先の未来を、見渡すための<br>広告、広報、マーケティングサポート業務です。
          </p>
        </div>
        <div class="about-catch__main__cloud">
          <div class="c-object2 -unique1 c-anime-fluffy c-anime-delay-_3">
            <img src="<?= $img_path; ?>common/illust/cloud_blue_1.png" alt="" decoding="async">
          </div>
          <div class="c-object2 -unique2 c-anime-fluffy">
            <img src="<?= $img_path; ?>common/illust/cloud_blue_2.png" alt="" decoding="async">
          </div>
          <div class="c-object2 -unique3 c-anime-fluffy c-anime-delay-_2">
            <img src="<?= $img_path; ?>common/illust/cloud_blue_3.png" alt="" decoding="async">
          </div>
          <div class="c-object2 -unique4 c-anime-fluffy c-anime-delay-_3">
            <img src="<?= $img_path; ?>common/illust/cloud_blue_1.png" alt="" decoding="async">
          </div>
        </div>
      </div>
      <div class="about-catch__illust js-trigger js-faderight">
        <div class="about-catch__illust__inner">
          <img src="<?= $this_img_path; ?>about_fv-pc.png" alt="" decoding="async">
        </div>
      </div>
    </div>
    <div class="about-service">
      <div class="about-service__catch">
        <p class="about-service__lead js-trigger js-fadeup">
          <picture>
            <source srcset="<?= $this_img_path; ?>catch_lead-pc.svg" media="<?= $mqUpLg; ?>">
            <source srcset="<?= $this_img_path; ?>catch_lead-sp.svg" media="<?= $mqDownLg; ?>">
            <img src="<?= $this_img_path; ?>catch_lead-pc.svg" alt="ミエルカのサービスについて、その特徴や、核となるものをある冒険者の物語を通してご紹介します。"
              decoding="async">
          </picture>
        </p>
        <div class="about-service__person">
          <img src="<?= $this_img_path; ?>apng_about_person.png" alt="" decoding="async">
        </div>
        <div class="about-service__bg">
          <picture>
            <source srcset="<?= $this_img_path; ?>about_mv_bg-pc.png" media="<?= $mqUpLg; ?>">
            <source srcset="<?= $this_img_path; ?>about_mv_bg-sp.png" media="<?= $mqDownLg; ?>">
            <img src="<?= $this_img_path; ?>about_mv_bg-pc.png" alt="" decoding="async">
          </picture>
        </div>
      </div>
      <div class="about-service__section-wrap">
        <section class="about-service__section -section1">
          <div class="about-service__inner c-inner-lg3">
            <div class="about-service__contents">
              <div class="about-service__label">
                <p class="about-service__label__num">
                  <img src="<?= $this_img_path; ?>about_service_number1.svg" alt="1" decoding="async">
                </p>
                <p class="about-service__label__txt">プロローグ</p>
              </div>
              <h2 class="about-service__title">
                <img src="<?= $this_img_path; ?>title_section1.svg" alt="出会い" decoding="async">
              </h2>
              <p class="about-service__txt c-txt-lg3 c-crop">
                ひとりの冒険者がいる。<br>目の前には、いくつも連なる山の尾根。<br>どの山に向かうのか。<br>足が向く方角へ進むのか、<br
                  class="u-n-mqUp-lg">はたまた後戻りするのか。<br>思考を重ねていたある時に、<br>めざす山を案内してくれる、という<br>ミエルカと名乗る者に出会う。</p>
              <p class="about-service__txt c-txt-lg3 c-crop">「まずはあなたが辿ってきた道を<br>振りかえってみませんか」</p>
            </div>
            <div class="about-service__illust js-trigger">
              <img class="js-fadeup" src="<?= $this_img_path; ?>illust_section1.png" alt="" decoding="async">
              <img class="js-fadeleft js-delay-5" src="<?= $this_img_path; ?>illust_section1_1.png" alt=""
                decoding="async">
              <img class="js-fadeleft js-delay-3" src="<?= $this_img_path; ?>illust_section1_2.png" alt=""
                decoding="async">
            </div>
          </div>
        </section>
        <section class="about-service__section -section2">
          <div class="about-service__inner c-inner-lg3">
            <div class="about-service__contents">
              <div class="about-service__label">
                <p class="about-service__label__num">
                  <img src="<?= $this_img_path; ?>about_service_number2.svg" alt="2" decoding="async">
                </p>
                <p class="about-service__label__txt">足下の花</p>
              </div>
              <h2 class="about-service__title">
                <img src="<?= $this_img_path; ?>title_section2.svg" alt="過去の数字が教えてくれる" decoding="async">
              </h2>
              <p class="about-service__txt c-txt-lg3 c-crop">
                冒険者が辿ってきた道は、<br>決して順風満帆なものではなかった。<br>とはいえ、一歩一歩、<br>時にはつまずきながらも歩みを進めてきた。<br>冒険者にとっては、ただただ<br>前をみて進む日々だった。<br>話を聞いたミエルカは、こう言った。
              </p>
              <p class="about-service__txt c-txt-lg3 c-crop">「あなたのたどってきた<br>足跡には、未来の宝がありますね」</p>
            </div>
            <div class="about-service__illust js-trigger">
              <img class="js-fadeup" src="<?= $this_img_path; ?>illust_section2.png" alt="" decoding="async">
              <img class="js-mask-bl_tr -slow js-delay-6" src="<?= $this_img_path; ?>illust_section2_1.png" alt=""
                decoding="async">
              <img class="js-mask-bl_tr -slow js-delay-8" src="<?= $this_img_path; ?>illust_section2_2.png" alt=""
                decoding="async">
              <div class="c-object2">
                <img class="js-fadeup js-delay-15" src="<?= $this_img_path; ?>apng_illust_section2_3.png" alt=""
                  decoding="async">
              </div>
            </div>
          </div>
        </section>
        <section class="about-service__section -section3">
          <div class="about-service__inner c-inner-lg3">
            <div class="about-service__contents">
              <div class="about-service__label">
                <p class="about-service__label__num">
                  <img src="<?= $this_img_path; ?>about_service_number3.svg" alt="3" decoding="async">
                </p>
                <p class="about-service__label__txt">目指す山</p>
              </div>
              <h2 class="about-service__title">
                <img src="<?= $this_img_path; ?>title_section3.svg" alt="地続きにある目標" decoding="async">
              </h2>
              <p class="about-service__txt c-txt-lg3 c-crop">
                冒険者がたどってきた道を振り返ると、<br>実にいろいろな色形をした花が咲いていた。<br>あの紫の花は、事業をはじめた時のもの。<br>あの青い花は、咲かせるのに相当な苦労をした。<br>そして、ふと前に視線をむけると、<br>そこには今まで見たことのない風景が<br>足下から地続きでつながっていた。
              </p>
              <p class="about-service__txt c-txt-lg3 c-crop">「前に進むためには、<br
                  class="u-n-mqUp-lg">まずは後ろと足下を見返すこと。<br>そうすれば自分が登る山がわかりますね」</p>
            </div>
            <div class="about-service__illust js-trigger">
              <img class="js-fadeup" src="<?= $this_img_path; ?>illust_section3.png" alt="" decoding="async">
              <img class="js-fadeup js-delay-4" src="<?= $this_img_path; ?>illust_section3_1.png" alt=""
                decoding="async">
            </div>
          </div>
        </section>
        <section class="about-service__section -section4">
          <div class="about-service__inner c-inner-lg3">
            <div class="about-service__contents">
              <div class="about-service__label">
                <p class="about-service__label__num">
                  <img src="<?= $this_img_path; ?>about_service_number4.svg" alt="4" decoding="async">
                </p>
                <p class="about-service__label__txt">地図を描く</p>
              </div>
              <h2 class="about-service__title">
                <img src="<?= $this_img_path; ?>title_section4.svg" alt="目標へのたどり方" decoding="async">
              </h2>
              <p class="about-service__txt c-txt-lg3 c-crop">
                冒険者の目の前にある山は、<br>これまで見たことのない尖った<br>険しい表情をした山だった。<br>でも、冒険者はその山に惹かれていた。<br>ただ、山に続く道は<br
                  class="u-n-mqUp-lg">どうやらひとつだけではないようだ。<br>そしてミエルカは言った。</p>
              <p class="about-service__txt c-txt-lg3 c-crop">「あの山に向かうために、<br>あなただけの地図を描きませんか」</p>
            </div>
            <div class="about-service__illust js-trigger">
              <img class="js-fadeup" src="<?= $this_img_path; ?>illust_section4.png" alt="" decoding="async">
              <img class="js-fadeleft js-delay-3" src="<?= $this_img_path; ?>illust_section4_1.png" alt=""
                decoding="async">
              <img class="js-fadeleft js-delay-5" src="<?= $this_img_path; ?>illust_section4_2.png" alt=""
                decoding="async">
            </div>
          </div>
        </section>
        <section class="about-service__section -section5">
          <div class="about-service__inner c-inner-lg3">
            <div class="about-service__contents">
              <div class="about-service__label">
                <p class="about-service__label__num">
                  <img src="<?= $this_img_path; ?>about_service_number5.svg" alt="5" decoding="async">
                </p>
                <p class="about-service__label__txt">エピローグ</p>
              </div>
              <h2 class="about-service__title">
                <img src="<?= $this_img_path; ?>title_section5.svg" alt="そして冒険は続く" decoding="async">
              </h2>
              <p class="about-service__txt c-txt-lg3 c-crop">
                遠くから見て尖って険しい山への道は、<br>冒険者にとってワクワクするものだった。<br>ミエルカとともに、<br>時に地図を描きかえながら<br>着実に山を攻略していった。<br>頂上に辿りつき、ひと息つくその先には、<br>また違う形をした山が待っていた。<br>ミエルカは笑った。
              </p>
              <p class="about-service__txt c-txt-lg3 c-crop">「また新しい冒険の地図を、<br>いっしょに描きましょう」</p>
            </div>
            <div class="about-service__illust js-trigger">
              <img class="js-fadeup" src="<?= $this_img_path; ?>illust_section5.png" alt="" decoding="async">
              <img class="js-fadeleft js-delay-3" src="<?= $this_img_path; ?>illust_section5_1.png" alt=""
                decoding="async">
              <img class="js-fadeleft js-delay-5" src="<?= $this_img_path; ?>illust_section5_2.png" alt=""
                decoding="async">
              <div class="about-service__illust__cloud">
                <div class="c-object2 -unique1 c-anime-fluffy c-anime-delay-_3">
                  <img src="<?= $img_path; ?>common/illust/cloud_blue_1.png" alt="" decoding="async">
                </div>
                <div class="c-object2 -unique2 c-anime-fluffy">
                  <img src="<?= $img_path; ?>common/illust/cloud_blue_2.png" alt="" decoding="async">
                </div>
                <div class="c-object2 -unique3 c-anime-fluffy c-anime-delay-_2">
                  <img src="<?= $img_path; ?>common/illust/cloud_blue_3.png" alt="" decoding="async">
                </div>
                <div class="c-object2 -unique4 c-anime-fluffy c-anime-delay-_3">
                  <img src="<?= $img_path; ?>common/illust/cloud_blue_1.png" alt="" decoding="async">
                </div>
              </div>
            </div>
          </div>
        </section>
        <div class="about-service__progress">
          <div class="about-service__progress__inner">
            <div class="about-service__progress__bar">
              <span></span>
              <span></span>
              <span></span>
              <span></span>
              <span></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <section class="about-concept">
      <div class="about-concept__inner">
        <div class="about-concept__main">
          <div class="about-concept__main__inner">
            <header class="about-concept__title">
              <h2 class="about-concept__title__ja">
                <img src="<?= $this_img_path; ?>concept_title-ja.svg" alt="サービスのコンセプト" decoding="async">
              </h2>
              <p class="about-concept__title__en">
                <img src="<?= $this_img_path; ?>concept_title-en.svg" alt="concept" decoding="async">
              </p>
            </header>
            <p class="about-concept__txt c-txt-lg c-crop">
              経営者が事業に挑むことに専念できるように、広告、広報、マーケティングの分野で、少し未来を見渡すサポートを行うのがミエルカの役割です。</p>
            <p class="about-concept__txt c-txt-lg c-crop">
              税務、財務・会計の知見をベースに、クライアントの事業を過去会計をもとに分析。具体的な数字をもとに、事業の目標設定、具体的施策をご提案します。また、広告、広報、マーケティングの運用を伴走しながらサポートすることで、結果を分析し、施策の最適化をスピーディに行います。数字という誰もが共有できる根拠をもとに未来を描き、さらに結果として出てきた数字をもとに改善しながら遂行していく。それが、ミエルカだからこそできる広告、広報、マーケティングサービスです。
            </p>
          </div>
        </div>
        <div class="about-concept__illust">
          <div class="about-concept__illust__inner js-trigger">
            <img class="js-fadeup" src="<?= $this_img_path; ?>illust_concept.png" alt="" decoding="async">
            <img class="js-mask-b_t js-delay-6" src="<?= $this_img_path; ?>illust_concept_1.png" alt=""
              decoding="async">
          </div>
        </div>
      </div>
      <div class="c-inner-lg">
        <ul class="about-concept__list c-column -col-2-1 -gap-c-104 -gap-r-147">
          <li class="js-trigger js-fadeup">
            <figure class="about-concept__list__pict">
              <div class="about-concept__list__number">
                <p>
                  <img src="<?= $this_img_path; ?>number1.svg" alt="01" decoding="async">
                </p>
              </div>
              <img class="c-objectfit -cover" src="<?= $this_img_path; ?>concept_list1.jpg" alt="" decoding="async">
            </figure>
            <h3 class="about-concept__list__title">
              <picture>
                <source srcset="<?= $this_img_path; ?>concept_list_title1-pc.svg" media="<?= $mqUpLg; ?>">
                <source srcset="<?= $this_img_path; ?>concept_list_title1-sp.svg" media="<?= $mqDownLg; ?>">
                <img src="<?= $this_img_path; ?>concept_list_title1-pc.svg" alt="財務・会計のスペシャリストが分析" decoding="async">
              </picture>
            </h3>
            <p class="about-concept__list__txt c-txt-lg c-crop">
              ミエルカは、税理士法人が母体なので、財務・会計を切り口に分析した上で、経営やマーケティング業務をサポートします。過去会計を見て、根拠のある「数字」をもとに、未来に向けた施策のご提案を得意としています。また、結果についても「数字」でシビアに判断し、地に足ついた事業展開をサポートします。
            </p>
          </li>
          <li class="js-trigger js-fadeup">
            <figure class="about-concept__list__pict">
              <div class="about-concept__list__number">
                <p>
                  <img src="<?= $this_img_path; ?>number2.svg" alt="01" decoding="async">
                </p>
              </div>
              <img class="c-objectfit -cover" src="<?= $this_img_path; ?>concept_list2.jpg" alt="" decoding="async">
            </figure>
            <h3 class="about-concept__list__title">
              <picture>
                <source srcset="<?= $this_img_path; ?>concept_list_title2-pc.svg" media="<?= $mqUpLg; ?>">
                <source srcset="<?= $this_img_path; ?>concept_list_title2-sp.svg" media="<?= $mqDownLg; ?>">
                <img src="<?= $this_img_path; ?>concept_list_title2-pc.svg" alt="数字を根拠にしたプランニング" decoding="async">
              </picture>
            </h3>
            <p class="about-concept__list__txt c-txt-lg c-crop">
              財務・会計のスペシャリストが導き出した根拠のある「数字」をもとに、広告、広報、マーケティングの分野の専門家が効果的な戦略を組み立てます。マーケティングの前提にあるのが、すべての人が共有できる「数字」であることが、ミエルカの広告、広報、マーケティングのサービスの最大の特徴でもあります。
            </p>
          </li>
          <li class="js-trigger js-fadeup">
            <figure class="about-concept__list__pict">
              <div class="about-concept__list__number">
                <p>
                  <img src="<?= $this_img_path; ?>number3.svg" alt="01" decoding="async">
                </p>
              </div>
              <img class="c-objectfit -cover" src="<?= $this_img_path; ?>concept_list3.jpg" alt="" decoding="async">
            </figure>
            <h3 class="about-concept__list__title">
              <picture>
                <source srcset="<?= $this_img_path; ?>concept_list_title3-pc.svg" media="<?= $mqUpLg; ?>">
                <source srcset="<?= $this_img_path; ?>concept_list_title3-sp.svg" media="<?= $mqDownLg; ?>">
                <img src="<?= $this_img_path; ?>concept_list_title3-pc.svg" alt="サポート体制は伴走＆自走型" decoding="async">
              </picture>
            </h3>
            <p class="about-concept__list__txt c-txt-lg c-crop">
              財務・会計を切り口にしたコンサルティングにはじまり、業績アップ、集客のためのマーケティング戦略のご提案、実施、そして財務・会計の視点からの結果検証と、一貫したサポート体制が可能。数字で評価・検証しながら結果につなげ、再現性の高い提案で自走できることを前提とした伴走型サポートで取り組んでいます。
            </p>
          </li>
          <li class="js-trigger js-fadeup">
            <figure class="about-concept__list__pict">
              <div class="about-concept__list__number">
                <p>
                  <img src="<?= $this_img_path; ?>number4.svg" alt="01" decoding="async">
                </p>
              </div>
              <img class="c-objectfit -cover" src="<?= $this_img_path; ?>concept_list4.jpg" alt="" decoding="async">
            </figure>
            <h3 class="about-concept__list__title">
              <picture>
                <source srcset="<?= $this_img_path; ?>concept_list_title4-pc.svg" media="<?= $mqUpLg; ?>">
                <source srcset="<?= $this_img_path; ?>concept_list_title4-sp.svg" media="<?= $mqDownLg; ?>">
                <img src="<?= $this_img_path; ?>concept_list_title4-pc.svg" alt="必要に応じたチーム編成" decoding="async">
              </picture>
            </h3>
            <p class="about-concept__list__txt c-txt-lg c-crop">
              広告、広報、マーケティングのご提案を実現し、さらにクオリティの高さを担保するために、必要に応じたチーム編成で取り組みます。法律面でのサポートは、各士業との連携ができ、デザイナー、プランナー、カメラマンなどのクリエイティブな人材とのつながりもあります。
            </p>
          </li>
        </ul>
      </div>
    </section>
  </main>
  <?php require_once ($web_root . $root . 'include/layout_footer.php'); ?>
</body>

</html>