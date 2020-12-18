<div class="blogcard">
    <?php echo sprintf('<a href="%s" class="blogcard__link">', esc_url(get_permalink())); ?>   
        <?php has_post_thumbnail() ? the_post_thumbnail( 'large', array("class"=>"blogcard__img") ) : ''; ?>
        <h2 class="blogcard__title"><?php the_title(); ?></h2>
    </a>
</div>  