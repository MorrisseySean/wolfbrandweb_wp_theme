<?php get_header(); ?>
<section id="hero" class="hero">
    <h1 class="header-text hero__header">Web<br/>Developer</h1>
    <div class="hero__text">
        <p>I'm Sean Morrissey, an expat web developer looking to help other expats 
        set up their online presence abroad.</p>
    </div>
</section>
<section id="first-divider" class="divider">
    <div class="divider__main"></div>
</section>
<section id="content-main" class="content">
    <section class="intro" id="intro">
        <div class="intro__shape intro__shape--triangledown"></div>
        <div class="intro__text">
            <p>A website is one of the best tools for setting yourself apart.<br/> 
            A purpose built website shows the world that you mean business.</p>            
        </div>
        <div class="intro__shape intro__shape--triangleup"></div>
    </section>
    <section class="cta">
        <div class="cta__content">
            <div class="cta__section cta__section--left">
                <h3 class ="cta__heading">Discovery<i class="fad fa-search cta__icon"></i></h3>
                <p class = "cta__text"> I start every client with a discovery session, where I get to know you and your brand,
                discuss your plans and get to know what the right design is for you.</p> 
            </div>
            <div class="cta__section cta__section--middle">
                <h3 class ="cta__heading">Design<i class="fad fa-pencil-paintbrush cta__icon"></i></h3>
                <p class = "cta__text">As your website is being designed, you're kept in the loop with regular updates on its progress.
                The design process is iterative, so you can tweak and change elements as you go.</p>
            </div>
            <div class="cta__section cta__section--right">
                <h3 class ="cta__heading">Success<i class="fad fa-magic cta__icon"></i></h3>
                <p class="cta__text">Once the design is ready, your website will be available to use for you and your clients. 
                Success is but an email away, so don't wait.</p>
            </div>
        </div>        
        <a href="#" class="cta__button">Contact Me</a>
    </section>
    <section class="featuredblog">
        <h1 class="featuredblog__header header-section">Blog
            <i class="fa fa-project-diagram header-section__icon"></i>
            <span>The Tech News</span>
        </h1>
        <div id= "blog-container" class="featuredblog__container">
            <?php 
                $args = array('type'=>'post', 'posts_per_page' => 3);
                $featuredBlogs = new WP_Query($args);
                if($featuredBlogs->have_posts()):
                    while($featuredBlogs->have_posts()):
                        $featuredBlogs->the_post(); ?>
                        <?php get_template_part('template_parts/blogcard', get_post_format()); ?>
                    <?php endwhile;
                endif;
                wp_reset_postdata();
            ?>
            <?php get_template_part('template_parts/blogcard', 'more'); ?>
        </div>
    </section>
    <section class="showcase">
        <h2 class="showcase__header header-section">Showcase
            <i class="fad fa-brackets-curly header-section__icon"></i>
            <span>See My Work</span>
        </h2>
        <div class="showcase__content">
            <?php get_template_part('template_parts/showcase_item'); ?>
            <?php get_template_part('template_parts/showcase_item'); ?>
            <?php get_template_part('template_parts/showcase_item'); ?>
            <?php get_template_part('template_parts/showcase_item'); ?>            
            <?php get_template_part('template_parts/showcase_item'); ?>
        </div>
    </section>
    <section class="last-cta">
        <div class="last-cta__image"></div>
        <div class="last-cta__content">
            <h2 class="last-cta__header header-secondary">Start Today!</h2>
            <p class="last-cta__text">Solo entrepreneur, craftperson or if you're 
                planning to get in to dropshipping. You can take the first step to 
                getting the website you need with just a click.
            </p>
            <a href="#" class="cta__button">Contact Me</a>
        </div>
        <div class="last-cta__icon">
            <i class="fad fa-code last-cta__icon"></i>
        </div>
        
    </section>
</section>
<?php get_footer(); ?>