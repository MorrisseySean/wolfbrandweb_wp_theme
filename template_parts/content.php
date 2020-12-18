<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="content__header">
        <?php the_title(
                sprintf('<h1 class="content__title"><a href="%s">', 
                    esc_url(get_permalink())),
                    '</a></h1>'
        );?>
    </header>
    <div class="content__main">
    <?php if(has_post_thumbnail()): ?>
        <div class='content__image'><?php the_post_thumbnail('thumbnail');?></div>
    <?php endif; ?>
    <div class="content__text">
        <?php the_content(); ?> 
    </div>
</article>