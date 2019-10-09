<?php
/* 
Template Name: Works
*/
$term_id = get_queried_object_id(); // タームIDの取得
?>


<?php get_header(); ?>

<div class="container-fluid blog-list">
    <div class="row">
        <div class="col-lg-9 blog-inner">
            <h1 class="archive-title">Works一覧</h1>
            <!-- <pre>$wp_query->max_num_pages:<?php print_r($wp_query->max_num_pages); ?></pre> -->
            <?php
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => 'works',
                'posts_per_page' => '3',
                'paged' => $paged,
            );
            $my_query = new WP_Query($args);
            $max_num_pages = $my_query->max_num_pages;
            ?>
            <!-- <pre>$my_query->max_num_pages:<?php print_r($my_query->max_num_pages); ?></pre> -->
            <?php
            if ($my_query->have_posts()) :
                while ($my_query->have_posts()) :
                    $my_query->the_post(); ?>
                    <article <?php post_class('kiji-list'); ?>>
                        <div class="kiji">
                            <!--画像を追加-->
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium'); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.gif" alt="no-img" class="hoge" />
                            <?php endif; ?>
                            <div class="text">
                                <!--タイトル-->
                                <h2><?php the_title(); ?></h2>
                                <!--カテゴリ-->
                                <?php if (has_term('', 'info-cat', $post->ID)) : ?>
                                    <span class="cat-data">
                                        <?php $post_term = get_the_terms($post->ID, 'info-cat');
                                        echo $post_term[0]->name; ?>
                                    </span>
                                <?php endif; ?>
                                <!--内容-->
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </article>
                <?php endwhile;
            endif; ?>
            <?php
            if (function_exists('wp_pagenavi')) :
                wp_pagenavi(array('query' => $my_query));   ////wp_pagenavi()の呼び出し(ただし、引数の指定が必要！)
            endif;
            wp_reset_postdata();
            ?>
            <?php
            
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>

