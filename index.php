<?php get_header(); ?>
<div class="index__content">
    <?php if(have_posts()): 
        while(have_posts()): the_post(); ?>
            <?php get_template_part('template_parts/content', get_post_format()); ?>
        <?php endwhile;
    endif; ?>
</div> 
<?php get_footer(); ?>