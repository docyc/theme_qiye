<?php get_header(); ?>

<div id="bd">
    <div id="ban-in" style="background-image:url(<?php echo get_template_directory_uri(); ?>/images/14415956337556.jpg)">
        <div class="ban-bg"></div>
    </div>
    <div class="wp">
        <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

            <div class="tit-i">
                <h3><?php the_title(); ?></h3>
                <h6>作者：<?php the_author(); ?>  发表日期：<?php the_date('Y-m-d H:i'); ?>  <span><?php the_category(','); ?></span></h6>
            </div>
            <div class="c"></div>
            <div class="about-info">
				<?php the_content(); ?>
            </div>
            
        <div class="c"></div>
        <?php endwhile; ?>
        <?php else : ?>
        <h3>暂无内容</h3>
        <?php endif; ?>
    </div>



<?php get_footer(); ?>