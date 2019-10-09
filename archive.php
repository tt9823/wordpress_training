<?php
/*
Template Name: Archives
*/
?>


<?php get_header(); ?>
<div class="container-fluid blog-list">
    <div class="row">
        <div class="col-lg-9 blog-inner">
            <h1 class="archive-title">ブログ一覧</h1>
            <!-- <pre>$wp_query->max_num_pages:<?php print_r($wp_query->max_num_pages); ?></pre> -->
            <?php
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => '5',
                'paged' => $paged
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
                        <a href="<?php the_permalink(); ?>" class="kiji">
                            <!--画像を追加-->
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium'); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.gif" alt="no-img" class="hoge" />
                            <?php endif; ?>
                            <div class="text">
                                <!--タイトル-->
                                <h2><?php the_title(); ?></h2>
                                <!--投稿日を表示-->
                                <span class="kiji-date">
                                    <i class="fas fa-pencil-alt"></i>
                                    <time datetime="<?php echo get_the_date('Y-m-d'); ?>">
                                        <?php echo get_the_date(); ?>
                                    </time>
                                </span>
                                <!--カテゴリ-->
                                <?php if (!is_category()) : ?>
                                    <?php if (has_category()) : ?>
                                        <span class="cat-data">
                                            <?php $postcat = get_the_category();
                                            echo $postcat[0]->name; ?>
                                        </span>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <!--抜粋-->
                                <?php the_excerpt(); ?>
                            </div>
                        </a>
                    </article>
                <?php endwhile;
            endif;
            if (function_exists('wp_pagenavi')) :
                wp_pagenavi(array('query' => $my_query));   ////wp_pagenavi()の呼び出し(ただし、引数の指定が必要！)
            endif;
            ?>
            <?php wp_reset_postdata(); ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>