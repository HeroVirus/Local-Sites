<?php
/* ------------------------------------------------------------------------------
 ontent widthの指定
------------------------------------------------------------------------------ */
if ( ! isset( $content_width ) ) $content_width = 1000;




/* ------------------------------------------------------------------------------
 不要なページを無効化
------------------------------------------------------------------------------ */
function custom_handle_404() {
	if (
		// 不要なタクソノミー、シングルページを無効化
		// シングルページは、確認もあるため single-[〇〇].php で制御
		// is_post_type_archive('pickup') ||
		// is_tax('topics') ||
		is_singular('member') ||

		// 検索ページ、作成者ページ、添付ファイルページを無効化
		is_search() ||
		is_author() ||
		is_attachment()
	) {
		global $wp_query;
		$wp_query->set_404();
		status_header( 404 );
		nocache_headers();
	}
}
add_action( 'template_redirect', 'custom_handle_404' );






/* ------------------------------------------------------------------------------
 デフォルト投稿
------------------------------------------------------------------------------ */
/* ----------------------------------------
 左メニュー「投稿」名称を変更
---------------------------------------- */
function edit_admin_menus(){
	global $menu;
	global $submenu;

	$menu[5][0] = 'お知らせ';
	$submenu['edit.php'][5][0] = 'お知らせ';
}
add_action('admin_menu','edit_admin_menus');


/* ----------------------------------------
 投稿関連の非表示の設定
---------------------------------------- */
function remove_post_supports() {
	// remove_post_type_support( 'post', 'author' ); // 作成者
	// remove_post_type_support( 'post', 'thumbnail' ); // アイキャッチ
	remove_post_type_support( 'post', 'excerpt' ); // 抜粋
	remove_post_type_support( 'post', 'trackbacks' ); // トラックバック
	remove_post_type_support( 'post', 'custom-fields' ); // カスタムフィールド
	remove_post_type_support( 'post', 'comments' ); // コメント
	remove_post_type_support( 'post', 'revisions' ); // リビジョン
	remove_post_type_support( 'post', 'page-attributes' ); // ページ属性
	remove_post_type_support( 'post', 'post-formats' ); // 投稿フォーマット

	// unregister_taxonomy_for_object_type( 'category', 'post' ); // カテゴリ
	unregister_taxonomy_for_object_type( 'post_tag', 'post' ); // タグ
}
add_action( 'init', 'remove_post_supports' );







/* ------------------------------------------------------------------------------
 カスタム投稿タイプ、SCFオプションページ
------------------------------------------------------------------------------ */
/* ------------------------------------------------------------
 ミエルカの山（works）
------------------------------------------------------------ */
add_action('init','register_custom_post_works');
function register_custom_post_works(){
	register_post_type(
		'works',
		array(
			'label'           => 'ミエルカの山',
			'public'          => true,
			'capability_type' => 'post',
			'menu_position'   => 5,
			'has_archive'     => true,
			'supports'        => array(
				'title',
				'author',
				'editor',
				'thumbnail',
			),
			'rewrite' => array('with_front' => false)
		)
	);
}




/* ------------------------------------------------------------
 ミエルカパートナー（member）
------------------------------------------------------------ */
add_action('init','register_custom_post_member');
function register_custom_post_member(){
	register_post_type(
		'member',
		array(
			'label'           => 'ミエルカパートナー',
			'public'          => true,
			'capability_type' => 'post',
			'menu_position'   => 5,
			'has_archive'     => true,
			'supports'        => array(
				'title',
				'author',
			),
			'rewrite' => array('with_front' => false)
		)
	);
}










/* ------------------------------------------------------------------------------
 フロント
------------------------------------------------------------------------------ */
/* ------------------------------------------------------------
 相対パス
------------------------------------------------------------ */
class relative_URI {
	function relative_URL() {
		add_action('relativeURL_start', array(&$this, 'relativeURL_start'), 1);
		add_action('relativeURL_end', array(&$this, 'relativeURL_end'), 99999);
	}
	function replace_relative_URL($content) {
		$home_url = trailingslashit(get_home_url('/'));
		$parsed   = parse_url($home_url);
		$replace  = $parsed['scheme'] . '://' . $parsed['host'];
		$pattern  = array(
			'# (href|src|action)="'.preg_quote($replace).'([^"]*)"#ism',
			"# (href|src|action)='".preg_quote($replace)."([^']*)'#ism",
		);
		$content  = preg_replace($pattern, ' $1="$2"', $content);
		$pattern  = '#<(meta [^>]*name=[\'"]twitter:image:src[^\'"]*[\'"] [^>]*content=|meta [^>]*property=[\'"]og:[^\'"]*[\'"] [^>]*content=|link [^>]*rel=[\'"]canonical[\'"] [^>]*href=|link [^>]*rel=[\'"]contents[\'"] [^>]*href=|link [^>]*rel=[\'"]index[\'"] [^>]*href=|link [^>]*rel=[\'"]shortlink[\'"] [^>]*href=|data-href=|data-url=)[\'"](/[^\'"]*)[\'"]([^>]*)>#uism';
		$content = preg_replace($pattern, '<$1"'.$replace.'$2"$3>', $content);
		return $content;
	}
	function relativeURL_start(){
		ob_start(array(&$this, 'replace_relative_URL'));
	}
	function relativeURL_end(){
		ob_end_flush();
	}
}

$class_relative_URI = new relative_URI();

function relativeURL(){
	global $class_relative_URI;
	$class_relative_URI->relativeURL_start();
}




/* ------------------------------------------------------------
 表示件数制御
------------------------------------------------------------ */
add_action('pre_get_posts','my_pre_get_posts');
function my_pre_get_posts( $query ) {
	if(is_admin() || ! $query -> is_main_query()) return;

	if( $query -> is_post_type_archive('member') ){
		$query -> set('posts_per_page',-1);
	} elseif(
		$query -> is_post_type_archive('works')
	 ){
		$query->set('posts_per_page',9);
		$query->set('post__not_in', get_option('sticky_posts') );
	} elseif(
		$query -> is_home() ||
		$query -> is_category() ||
		$query -> is_date()
	 ){
		$query -> set('posts_per_page',6);
		// $query -> set('posts_per_page',1);
	}
}




/* ------------------------------------------------------------
 アイキャッチ画像　
------------------------------------------------------------ */
add_theme_support('post-thumbnails');
add_image_size('130_130_thumbnail',260,260,true);
add_image_size('170_170_thumbnail',340,340,true);
add_image_size('220_180_thumbnail',440,360,true);
add_image_size('360_294_thumbnail',720,588,true);
add_image_size('360_300_thumbnail',720,600,true);
add_image_size('400_300_thumbnail',800,600,true);
add_image_size('500_400_thumbnail',1000,800,true);
add_image_size('620_496_thumbnail',1240,992,true);

add_image_size('720_free_contents',1440,2000,false);

add_image_size('1200_550_hero',2400,1100,true);

add_image_size('ogp',1200,630,true);


/* ---------------------------------------------------
 Webp取得
-------------------------------------------------- */
function getWebp( $image_file , $baseDir = false ){
	global $domain_url;
	global $wp_site_url;
	global $back_dir_towp;

	$replace_url = str_replace( $wp_site_url , '', $image_file . '.webp' );

	if( $baseDir == true ){
		$replace_url = $back_dir_towp . $replace_url;
	}

	// webpがあればsourceタグを入れる
	if( file_exists( $replace_url ) ){
		$static_image_url = str_replace( $domain_url , '', $image_file );
		$sourse = '<source type="image/webp" srcset="'. $static_image_url .'.webp">';
	} else{
		$sourse = '';
	}

	return $sourse;
}




/* ------------------------------------------------------------
 srcset無効
------------------------------------------------------------ */
add_filter( 'wp_calculate_image_srcset_meta', '__return_null' );




/* ------------------------------------------------------------
 change_document_title_parts
------------------------------------------------------------ */
function change_document_title_parts( $title_parts ){
	$title_parts['tagline'] = '';
	$title_parts['site'] = '';

	if( is_date() ){
		$year  = get_query_var('year');
		$month = get_query_var('monthnum');
		$day   = get_query_var('day');

		$title = ($year ? $year . '年' : '') .
				 ($month ? $month . '月' : '') .
				 ($day ? $day . '日' : '');

		$title = preg_replace("/( |　)/", "", $title );

		$title_parts['title'] = $title;
	}

	return $title_parts;
}
add_filter( 'document_title_parts', 'change_document_title_parts' );




/* ------------------------------------------------------------
 content
------------------------------------------------------------ */
/* ---------------------------------------------------
 lazyload
-------------------------------------------------- */
function contentLazyload( $content ){
	$placeholder = 'https://~/placeholder.gif';
	$content = preg_replace('/(<img[^>]*)\s+src=/', '$1 src="'. $placeholder .'" data-original=', $content);

	$content = preg_replace_callback('/<img([^>]*)>/', function( $matches ) {
		$match = rtrim ( $matches[1], '/' );

		//classを持っているかどうか
		if ( strpos( $match, 'class=' ) !== false ) {
			//クラスを持っていなければ追加
			if ( strpos( $match, 'lazyload' ) === false ) {
				$match = preg_replace('/class="([^"]*)"/', 'class="$1 js-lazyload"', $match);
			}
		} else {
			//classがなければ、classごと追加
			$match .= 'class="js-lazyload" ';
		}

		return '<img'. $match .'>';
	}, $content);

	return $content;
}

/* ----- the_content でも発動 ----- */
add_filter('the_content', function( $content ) {
	return contentLazyload( $content );
});


/* ---------------------------------------------------
 本文のimgタグだけfigureタグで括る
-------------------------------------------------- */
function fb_unautop_4_img( $content ){
	$content = preg_replace(
		'/<p>\\s*?(<a rel=\"attachment.*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s',
		'<figure>$1</figure>',
		$content
	);
	return $content;
}
add_filter( 'the_content', 'fb_unautop_4_img', 99 );


/* ---------------------------------------------------
 本文のiframeタグを <div class="youtube"></div> で括るための置換処理
-------------------------------------------------- */
function ag_wrap_iframe($the_content){
	if ( is_singular() ) {
		$the_content = preg_replace('/<iframe/i', '<div class="c-youtube2"><iframe', $the_content);
		$the_content = preg_replace('/<\/iframe>/i', '</iframe></div>', $the_content);
	}
	return $the_content;
}
add_filter('the_content','ag_wrap_iframe');



/* ---------------------------------------------------
 アーカイブタイトル
-------------------------------------------------- */
add_filter( 'get_the_archive_title', function ( $title ) {
	if( is_category() || is_archive() ) {
		$title = single_cat_title( '', false );
	}
	elseif( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif( is_month() ){
		$title = get_query_var('year') . "年".get_query_var('monthnum')."月";
		$title = single_month_title( '', false );
	}
	return $title;
});

function jp_date_wp_title( $title, $sep, $seplocation ) {
	if ( is_date() ) {
		$m = get_query_var('m');
		if ( $m ) {
			$year = substr($m, 0, 4);
			$month = intval(substr($m, 4, 2));
			$day = intval(substr($m, 6, 2));
		} else {
			$year = get_query_var('year');
			$month = get_query_var('monthnum');
			$day = get_query_var('day');
		}

		$title = ($seplocation != 'right' ? " $sep " : '') .
				($year ? $year . '年' : '') .
				($month ? $month . '月' : '') .
				($day ? $day . '日' : '') .
				($seplocation == 'right' ? " $sep " : '');
	}
	return $title;
}
add_filter( 'wp_title', 'jp_date_wp_title', 10, 3 );




/* ------------------------------------------------------------
 pagination
------------------------------------------------------------ */
if( !function_exists('pagination') ){
	function pagination($pages = '', $range = ''){

		/* ----------------------------------------
		 ページ情報の取得
		---------------------------------------- */
		global $paged; //現在のページの値

		if( empty($paged) ){  //デフォルトのページ
			$paged = 1;
		}
		if( $pages == '' ){
			global $wp_query;
			$pages = $wp_query->max_num_pages;  //全ページ数を取得
			if( !$pages ){ //全ページ数が空の場合は、1にする
				$pages = 1;
			}
		}

		$booby = $pages;
		$booby--;

		if( $pages > 5 ){
			if( $paged == 1 || $paged == $pages ){
				$range = 3;
			} else if( $paged == 2 || $paged == $booby ){
				$range = 2;
			} else{
				$range = 1;
			}
		} else{
			$range = 4;
		}

		$showitems = ($range * 1)+1;



		/* ----------------------------------------
		 出力
		---------------------------------------- */
		if( 1 != $pages ){  //全ページ数が1以外の場合は以下を出力する

			/* ---------- p-pagination ---------- */
			echo '<footer class="p-pagination">';
				echo '<div class="p-pagination__inner">';

					/* ---------- p-pagination__prev ---------- */
					if( get_previous_posts_link() ){
						$prev_href  = get_previous_posts_page_link();
						$prev_class = '';
					} else{
						$prev_href  = 'javascript:void(0);';
						$prev_class = 'is-disabled';
					}

					echo '<p class="p-pagination__pager -prev '. $prev_class .'">';
						echo '<a href="'. $prev_href .'">';
							echo '<i class="c-icon c-arrow u-reverse"></i>';
							echo '<span class="p-pagination__pager__txt">戻る</span>';
						echo '</a>';
					echo '</p>';

					/* ---------- p-pagination__number ---------- */
					echo '<ul class="p-pagination__num">';

						if( $pages > 5 && $paged > 2 ){
							echo '<li>';
								echo '<a href="'. get_pagenum_link(1) .'">';
									echo '<span class="p-pagination__num__txt">1</span>';
									echo '<span class="p-pagination__num__bg"></span>';
								echo '</a>';
							echo '</li>';
						}
						if( $pages > 5 && $paged > 3 ){
							echo '<li class="p-pagination__ellipsis"></li>';
						}
						for ($i=1; $i <= $pages; $i++){
							if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
								if($paged == $i){
									echo '<li class="is-current">';
										echo '<a href="javascript:void(0);">';
											echo '<span class="p-pagination__num__txt">'. $i .'</span>';
											echo '<span class="p-pagination__num__bg"></span>';
										echo '</a>';
									echo '</li>';
								} else{
									echo '<li>';
										echo '<a href="'. get_pagenum_link($i) .'">';
											echo '<span class="p-pagination__num__txt">'. $i .'</span>';
											echo '<span class="p-pagination__num__bg"></span>';
										echo '</a>';
									echo '</li>';
								}
							}
						}
						if( $pages > 5 && $paged < $booby-1 ){
							echo '<li class="p-pagination__ellipsis"></li>';
						}
						if( $pages > 5 && $paged < $booby ){
							echo '<li>';
								echo '<a href="'. get_pagenum_link($pages) .'">';
									echo '<span class="p-pagination__num__txt">'. $pages .'</span>';
									echo '<span class="p-pagination__num__bg"></span>';
								echo '</a>';
							echo '</li>';
						}

					echo '</ul>';

					/* ---------- p-pagination__next ---------- */
					if( get_next_posts_link() ){
						$next_href  = get_next_posts_page_link();
						$next_class = '';
					} else{
						$next_href  = 'javascript:void(0);';
						$next_class = 'is-disabled';
					}

					echo '<p class="p-pagination__pager -next '. $next_class .'">';
						echo '<a href="'. $next_href .'">';
							echo '<span class="p-pagination__pager__txt">次へ</span>';
							echo '<i class="c-icon c-arrow"></i>';
						echo '</a>';
					echo '</p>';

				echo '</div>';
			echo '</footer>';
		}

	}
}








/* ------------------------------------------------------------------------------
 管理画面カスタマイズ
------------------------------------------------------------------------------ */
/* ------------------------------------------------------------
 管理画面とログイン画面にタグを追加
------------------------------------------------------------ */
function login_tag() {
	echo '<link rel="stylesheet" type="text/css" href="'.get_home_url().'/assets/css/wp-admin.css">';
}
add_action( 'login_enqueue_scripts', 'login_tag' );

function my_admin_tag() {
	echo '<link rel="stylesheet" type="text/css" href="'.get_home_url().'/assets/css/wp-admin.css">';
	echo '<script src="'.get_home_url().'/assets/js/wp-admin.js"></script>';
}
add_action('admin_print_scripts', 'my_admin_tag');




/* ------------------------------------------------------------
 投稿画面 カスタマイズ
------------------------------------------------------------ */
/* ----------------------------------------
 投稿画面で入れ子になったカテゴリ選択ボックスの階層を保つ
---------------------------------------- */
function solecolor_wp_terms_checklist_args($args,$post_id){
	$args['checked_ontop'] = false;
	return $args;
}
add_filter('wp_terms_checklist_args','solecolor_wp_terms_checklist_args',10,2);



/* ----------------------------------------
 メディアの移動
---------------------------------------- */
function customize_menus(){
	global $menu;
	$menu[19] = $menu[10];
	unset($menu[10]);
}
add_action( 'admin_menu', 'customize_menus' );



/* ------------------------------------------------------------
 ビジュアルエディタ カスタマイズ
------------------------------------------------------------ */
/* ----------------------------------------
 ビジュアルエディタ内にタグ追加
---------------------------------------- */
add_editor_style( get_home_url() . '/assets/css/common.min.css' );
add_editor_style( get_home_url() . '/assets/css/wp-visual-editor.css' );


/* ----------------------------------------
 諸々ボタン追加
---------------------------------------- */
function ilc_mce_buttons($buttons){
	array_push( $buttons , "backcolor", "copy", "cut", "paste", "fontsizeselect", "cleanup" );
	return $buttons;
}
add_filter("mce_buttons", "ilc_mce_buttons");


/* ----------------------------------------
 段落、クラスのカスタマイズ
---------------------------------------- */
function custom_editor_settings($initArray) {
	global $post_type;

	if( $post_type === 'post' ){
		$post_original_class = 'news-single-main';
	} else{
		$post_original_class = 'works-single-free';
	}

	$initArray['body_class']      = 'wp-visual-editor s-editor ' . $post_original_class;
	$initArray['block_formats']   = "段落=p;見出し1=h2;見出し2=h3;";
	$settings['fontsize_formats'] = '10px=62.5% 12px=75% 14px=87.5% 16px=100% 18px=112.5% 20px=125% 24px=150% 28px=175% 32px=200%';
	return $initArray;
}
add_filter('tiny_mce_before_init', 'custom_editor_settings');



/* ------------------------------------------------------------
 固定ページでビジュアルモードを使用しない
------------------------------------------------------------ */
function stop_rich_editor($editor) {
	global $typenow;
	global $post;
	if(in_array($typenow, array('page','tinymcetemplates'))) {
		$editor = false;
	}
	return $editor;
}
add_filter('user_can_richedit', 'stop_rich_editor');




/* ------------------------------------------------------------
 一覧カラムカスタマイズ
------------------------------------------------------------ */
/* ----------------------------------------
 tableにcolumnを追加
---------------------------------------- */
function sort_custom_columns( $columns ) {
	global $post_type;
	if ( $post_type == 'post' ) {
		$columns = array(
			'cb'         => '<input type="checkbox" />',
			'title'      => 'タイトル',
			'categories' => 'カテゴリー',
			'thumbnail'  => 'サムネイル',
			'author'     => '作成者',
			'date'       => '日付'
		);
	} elseif( $post_type == 'works' ){
		$columns = array(
			'cb'               => '<input type="checkbox" />',
			'sticky_post'      => '固定',
			'title'            => 'タイトル',
			'scf-works_client' => 'クライアント',
			'thumbnail'        => 'サムネイル',
			'date'             => '日付'
		);
	} elseif( $post_type == 'member' ){
		$columns = array(
			'cb'                   => '<input type="checkbox" />',
			'title'                => 'タイトル',
			'scf-member_thumbnail' => '画像',
			'author'               => '作成者',
			'date'                 => '日付'
		);
	}
	return $columns;
}


/* ----------------------------------------
 columnsにカテゴリー名を表示
---------------------------------------- */
function getAdminTermList($post_name,$tax_name,$id){
	$terms = wp_get_object_terms( $id , $tax_name );
	if( $terms ){
		$count = 0;
		foreach ( $terms as $term ) {
			$term_name = $term->name;
			$term_slug = $term->slug;
			if( $cout > 0 ){
				echo ',';
			}
			echo '<a href="'. get_home_url() .'/wp/wp-admin/edit.php?post_type='. $post_name .'&'. $tax_name .'='. $term_slug .'">'. $term_name .'</a>';
			$cout++;
		}
	} else{
		echo '－';
	}
}


/* ----------------------------------------
 カラム内表示
---------------------------------------- */
function add_custom_column_id($column_name,$id) {
	global $post_type;
	/* ---------- common ---------- */
	if ( $column_name == 'thumbnail' ) {
		$value = get_the_post_thumbnail( $id, array( 100, 100 ), 'thumbnail' );
		echo ( $value ) ? $value : '－';
	}

	/* ---------- works ---------- */
	if( $column_name == 'scf-works_client' ) {
		$value  = get_post_meta($id,'works_client',false)[0];
		echo $value;
	}

	/* ---------- member ---------- */
	if( $column_name == 'scf-member_thumbnail' ) {
		$img_id  = get_post_meta($id,'member_thumbnail',false)[0];

		if( $img_id ){
			$img_url = wp_get_attachment_image_src( $img_id, 'thumbnail' )[0];
			$value   = '<img width="100" height="100" src="'. $img_url .'" class="attachment-100x100 size-100x100 wp-post-image" alt="" thumbnail="" decoding="async" loading="lazy">';
			echo $value;
		}
	}

}



/* ----------------------------------------
 action
---------------------------------------- */
/* ---------- post --------- */
add_action('manage_post_posts_custom_column', 'add_custom_column_id', 10, 2);
add_filter( 'manage_post_posts_columns', 'sort_custom_columns' );

/* ---------- works --------- */
add_action('manage_works_posts_custom_column', 'add_custom_column_id', 10, 2);
add_filter( 'manage_works_posts_columns', 'sort_custom_columns' );

/* ---------- works --------- */
add_action('manage_member_posts_custom_column', 'add_custom_column_id', 10, 2);
add_filter( 'manage_member_posts_columns', 'sort_custom_columns' );








/* ------------------------------------------------------------------------------
 管理者以外の管理画面カスタマイズ
------------------------------------------------------------------------------ */
if(!current_user_can('administrator')){
	/* ---------------------------------------------------
	 タグを追加
	-------------------------------------------------- */
	function wp_custom_admin_css(){
		echo '<link rel="stylesheet" type="text/css" href="'.get_home_url().'/assets/css/wp-editor.css">';
	}
	add_action('admin_head','wp_custom_admin_css',100);


	/* ---------------------------------------------------
	 ダッシュボードからリダイレクト
	-------------------------------------------------- */
	function redirect_dashboard() {
		global $pagenow;
		if ( is_admin() && 'index.php' == $pagenow ) {
			wp_redirect( admin_url( 'edit.php' ) );
		}
	}
	add_action( 'admin_init', 'redirect_dashboard' );


	/* ---------------------------------------------------
	 バージョン更新非表示
	-------------------------------------------------- */
	add_filter( 'pre_site_transient_update_core', '__return_zero' );
	remove_action( 'wp_version_check', 'wp_version_check' );
	remove_action( 'admin_init', '_maybe_update_core' );


	/* ---------------------------------------------------
	 機能の非表示
	-------------------------------------------------- */
	/* ----------------------------------------
	 ようこそ画面の非表示
	---------------------------------------- */
	remove_action( 'welcome_panel', 'wp_welcome_panel' );


	/* ----------------------------------------
	 メニュー項目非表示
	---------------------------------------- */
	function remove_menus(){
		remove_menu_page( 'index.php' );                            // ダッシュボード
		remove_menu_page( 'upload.php' );                           // メディア
		remove_menu_page( 'edit.php?post_type=page' );              // 固定ページ
		remove_menu_page( 'edit-comments.php' );                    // コメント
		remove_menu_page( 'themes.php' );                           // 外観
		remove_menu_page( 'plugins.php' );                          // プラグイン
		remove_menu_page( 'users.php' );                            // ユーザー
		remove_menu_page( 'tools.php' );                            // ツール
		remove_menu_page( 'options-general.php' );                  // 設定
		remove_menu_page('edit.php?post_type=smart-custom-fields'); //Smart Custom Fields
		remove_menu_page('siteguard');                              //SiteGuard
	}
	add_action( 'admin_menu', 'remove_menus' );


	/* ----------------------------------------
	 管理バーの項目の非表示
	---------------------------------------- */
	function remove_admin_bar_menus( $wp_admin_bar ) {
		$wp_admin_bar->remove_node( 'wp-logo' );      // WordPressマーク
		$wp_admin_bar->remove_node( 'view-site' );    // サイトを表示
		$wp_admin_bar->remove_node( 'dashboard' );    // ダッシュボード
		$wp_admin_bar->remove_menu( 'customize' );    // カスタマイズ
		$wp_admin_bar->remove_node( 'comments' );     // コメント
		$wp_admin_bar->remove_node( 'new-content' );  // 新規投稿
		$wp_admin_bar->remove_node( 'edit' );         // 〜の編集
		$wp_admin_bar->remove_menu( 'edit-profile' ); // ユーザー -> プロフィールを編集
		$wp_admin_bar->remove_menu( 'updates' );      // 更新
		$wp_admin_bar->remove_node( 'search' );       // 検索
	}
	add_action( 'admin_bar_menu', 'remove_admin_bar_menus', 100 );


	/* ----------------------------------------
	 ヘルプと表示オプションを非表示
	---------------------------------------- */
	function hide_help_and_options(){
		echo '<style type="text/css">'.
			'#contextual-help-link-wrap,'.
			'#screen-options-link-wrap'.
			'{display:none;}</style>'.PHP_EOL;
	}
	add_action( 'admin_head', 'hide_help_and_options' );


	/* ----------------------------------------
	 フッター
	---------------------------------------- */
	/* WordPress のご利用ありがとうございます。非表示 */
	function custom_admin_footer () { echo ''; }
	add_filter( 'admin_footer_text', 'custom_admin_footer' );

	/* バージョン非表示 */
	function custom_footer_update () { return false;}
	add_filter('update_footer', 'custom_footer_update', 11);

}










