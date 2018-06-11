<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php wp_title('-',true,'right'); ?></title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta content="telephone=no" name="format-detection" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <meta name="full-screen" content="yes">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/lema_favicon32.ico">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/cui.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/less.css" />
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.js"></script>
    <?php wp_head(); ?>
</head>
<body>
<div id="hd">
    <div class="wp">
        <div class="logo"><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">
        <?php if ( docyc_get_option('docyc_logo') ) { ?>
        <img src="<?php echo docyc_get_option('docyc_logo'); ?>" />
        <?php }else{ ?>
            <h2><?php bloginfo('name'); ?></h2>
        <?php } ?>
        </a></div>
            <?php wp_nav_menu( array(
              'theme_location'              => 'zhudaohang',                                  //[保留]
              'menu'                                => '',                                  //[可删]
              'container'                           => 'div',                           //[可删]
              'container_class'             => '',                                  //[可删]
              'container_id'                    => 'nav',                                  //[可删]
              'menu_class'                  => 'menu',                      //[可删]
              'menu_id'                         => '',                                  //[可删]
              'echo'                                => true,                            //[可删]
              'fallback_cb'                     => 'wp_page_menu',      //[可删]
              'before'                              => '',                                  //[可删]
              'after'                                   => '',                                  //[可删]
              'link_before'                     => '',                                  //[可删]
              'link_after'                          => '',                                  //[可删]
              'items_wrap'                      => '<ul id="%1$s" class="%2$s">%3$s</ul>',  //[可删]
              'depth'                               => 0,                               //[可删]
              'walker'                              => ''                                   //[可删]
            ) );
            ?>
        <div class="tel"><?php echo docyc_get_option('docyc_tel1'); ?></div>
    </div>
</div><!-- .hd -->
<div class="c"></div>
<div id="m-hd">
    <a href="<?php bloginfo('url'); ?>"  class="m-logo">
        <?php if ( docyc_get_option('docyc_logo') ) { ?>
        <img src="<?php echo docyc_get_option('docyc_logo'); ?>" />
        <?php }else{ ?>
            <h2><?php bloginfo('name'); ?></h2>
        <?php } ?>
    </a>
    <div class="m-trigger"></div>
            <?php wp_nav_menu( array(
              'theme_location'              => 'mdaohang',                                  //[保留]
              'menu'                                => '',                                  //[可删]
              'menu_class'                  => 'menu',                      //[可删]
              'menu_id'                         => '',                                  //[可删]
              'echo'                                => true,                            //[可删]
              'fallback_cb'                     => 'wp_page_menu',      //[可删]
              'before'                              => '',                                  //[可删]
              'after'                                   => '',                                  //[可删]
              'link_before'                     => '',                                  //[可删]
              'link_after'                          => '',                                  //[可删]
              'items_wrap'                      => '<ul id="%1$s" class="%2$s m-nav">%3$s</ul>',  //[可删]
              'depth'                               => 1,                               //[可删]
              'walker'                              => ''                                   //[可删]
            ) );
            ?>
</div><!-- .m-hd -->
<div class="c"></div>
<script>
    $('.menu>li').hover(
        function () {
            $( this ).find( 'ul:first' ).css( { "visibility":"visible", "display":"block" } )
        },
        function () {
            $( this ).find('ul:first').css( { "visibility":"hidden"} )
        }
    );
</script>