<?php get_header(); ?>

    <div class="jumbotron jumbotron-extend">
        <div class="alrazy-title" data-splitting>This is Intro text</div>
        <script>
            Splitting();
        </script>
    </div>

<div class="container-fluid blog-section">
    <h1 class="section-title">Blog</h1>
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <?php
            $args = array(
                'posts_per_page' => '3',
            );
            $my_query = new WP_Query($args);
            if ($my_query->have_posts()) :
                while ($my_query->have_posts()) :
                    $my_query->the_post(); ?>
                    <article <?php post_class('kiji-list'); ?>>
                        <a href="<?php the_permalink(); ?>">
                            <!--画像を追加-->
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium'); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.gif" alt="no-img" class="hoge" />
                            <?php endif; ?>
                            <div class="text">
                                <!--タイトル-->
                                <h2><?php the_title(); ?></h2>
                                <!-- <h2><?php the_title(); ?></h2> -->
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
            wp_reset_postdata(); ?>
        </div>
        <div class="col-md-12">
            <a class="btn btn-default orange-circle-button blog-button" href="vccw2.test/blog/">Read more
                <span class="orange-circle-greater-than"></span></a>
        </div>
    </div>
</div>

<div class="container-fluid work-section">
    <h1 class="section-title">Work</h1>
    <div class="row works">
        <?php
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        $args = array(
            'post_type' => 'works',
            'posts_per_page' => '3',
            'paged' => $paged
        );
        $my_query = new WP_Query($args);
        $max_num_pages = $my_query->max_num_pages;
        ?>
        <?php
        if ($my_query->have_posts()) :
            while ($my_query->have_posts()) :
                $my_query->the_post(); ?>
            <div class="col-md-4 works-section1">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium'); ?>
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.gif" alt="no-img" class="works-img" />
                <?php endif; ?>
                <?php the_excerpt(); ?>
            </div>
            <?php endwhile;
        endif;
        wp_reset_postdata();
        ?>
        <div class="col-md-12">
            <a class="btn btn-default orange-circle-button works-button" href="vccw2.test/works">Read more
                <span class="orange-circle-greater-than"></span></a>
        </div>
    </div>
</div>

<div class="container-fluid contact-section">
    <h1 class="section-title">Contact</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="contact-content">
                お問い合わせはこちら
            </div>
        </div>
        <div class="col-md-12">
            <a class="btn btn-default orange-circle-button contact-button" href="vccw2.test/contact/">Read more
            <span class="orange-circle-greater-than"></span></a>
        </div>
    </div>
</div>

<?php get_footer(); ?>