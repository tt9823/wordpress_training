<?php

add_theme_support('title-tag');
add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
add_theme_support('automatic-feed-links');
add_theme_support('post-thumbnails');

register_nav_menu('header-nav', ' ヘッダーナビゲーション ');
register_nav_menu('footer-nav', ' フッターナビゲーション ');

function widgetarea_init()
{
    register_sidebar(array(
        'name' => 'サイドバー',
        'id' => 'side-widget',
        'before_widget' => '<div id="%1$s" class="%2$s sidebar-wrapper">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="sidebar-title">',
        'after_title' => '</h4>'
    ));
}
add_action('widgets_init', 'widgetarea_init');








function register_style()
{
    wp_register_style('home', get_template_directory_uri()  . '/assets/css/front.css');
    wp_register_style('button', get_template_directory_uri()  . '/assets/css/button.css');
    wp_register_style('side-bar', get_template_directory_uri() . '/assets/css/side-bar.css');
    wp_register_style('archive', get_template_directory_uri()  . '/assets/css/archive.css');
    wp_register_style('single', get_template_directory_uri()  . '/assets/css/single.css');
    wp_register_style('contact', get_template_directory_uri()  . '/assets/css/contact.css');
    wp_register_style('works', get_template_directory_uri()  . '/assets/css/works.css');
    wp_register_style('nav', get_template_directory_uri()  . '/assets/css/navbar.css');
}

function my_enqueue_style()
{
    register_style();
    wp_enqueue_style('nav');
    if (is_front_page()) {
        wp_enqueue_style('home');
        wp_enqueue_style('button');
    } elseif (is_page(array('blog'))) {
        wp_enqueue_style('archive');
        wp_enqueue_style('side-bar');
    } elseif (is_single()) {
        wp_enqueue_style('single');
        wp_enqueue_style('side-bar');
    } elseif (is_page(array('contact'))) {
        wp_enqueue_style('contact');
    } elseif (is_page(array('works-archive'))) {
        wp_enqueue_style('works');
    }
}
add_action('wp_enqueue_scripts', 'my_enqueue_style');




function register_script()
{
    wp_register_script('front', get_template_directory_uri()  . '/assets/js/front.js', array('jquery'));
    wp_register_script('modal', get_template_directory_uri() . '/assets/js/works.js', array('jquery'));
    // wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', false, false, true);
}

function my_enqueue_script()
{
    register_script();
    if (is_front_page(array('front'))) {
        wp_enqueue_script('front');
        wp_enqueue_script('jquery-cdn', 'https://unpkg.com/splitting@1.0.0/dist/splitting.js');
    } elseif (is_page(array('works'))) {
        wp_deregister_script('jquery');
        wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), '3.3.1', true);
        wp_enqueue_script('modal', array('jquery'));
    }
}
add_action('wp_enqueue_scripts', 'my_enqueue_script');


add_action('init', 'create_post_type');
function create_post_type()
{
    register_post_type('works', [ // 投稿タイプ名の定義
        'labels' => [
            'name'          => 'works', // 管理画面上で表示する投稿タイプ名
            'singular_name' => 'work',    // カスタム投稿の識別名
            // 'support' => array('thumbnail')
        ],
        'public'        => true,  // 投稿タイプをpublicにするか
        'has_archive'   => false, // アーカイブ機能ON/OFF
        'menu_position' => 5,     // 管理画面上での配置場所
        'show_in_rest'  => true,  // 5系から出てきた新エディタ「Gutenberg」を有効にする
        'supports' => array('thumbnail', 'title', 'editor', 'custom-field', 'excerpt')
    ]);
}



function add_taxonomy()
{
    //お知らせカテゴリ
    register_taxonomy(
        'info-cat',
        'works',
        array(
            'label' => 'カテゴリ',
            'singular_label' => 'カテゴリ',
            'labels' => array(
                'all_items' => 'カテゴリ一覧',
                'add_new_item' => 'カテゴリを追加'
            ),
            'public' => true,
            'show_ui' => true,
            'show_in_nav_menus' => true,
            'hierarchical' => true,
            'has_archive' => true
        )
    );
}
add_action('init', 'add_taxonomy');


function custom_excerpt_length($length)
{
    return 200;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);



//抜粋末尾の省略文字変更
function my_excerpt_more($more)
{
    return '…';
}
add_filter('excerpt_more', 'my_excerpt_more');


function change_posts_per_page($query)
{
    if (is_admin() || !$query->is_main_query()) {
        return;
    }
    if ($query->is_post_type_archive('works')) {
        $query->set('posts_per_page', '3');
    }
}
add_action('pre_get_posts', 'change_posts_per_page');
