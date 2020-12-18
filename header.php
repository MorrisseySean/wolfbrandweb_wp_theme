<!doctype html>
<html <?php language_attributes() ?> >
    <head>
        <meta charset="<?php bloginfo( 'charset' )?>">
        <meta name="description" content="<?php bloginfo('description');?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            <?php if(is_front_page()):
                bloginfo('name');
            else: ?>
                WBT <?php wp_title('-');
            endif;
            ?>
        </title>        
        <?php wp_head(); ?> 
    </head>
    <body <?php body_class(); ?> >
        <div class="container-main"> 