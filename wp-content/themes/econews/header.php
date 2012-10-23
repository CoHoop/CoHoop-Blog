<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
    <head>
        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

        <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

        <meta name="medium" content="blog" />
        <meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style.min.css" type="text/css" media="screen" />
        <link href='http://fonts.googleapis.com/css?family=Marcellus' rel='stylesheet' type='text/css'>

        <link rel="icon" href="<?php echo ide_option('favicon_url') ? ide_option('favicon_url') : get_bloginfo('template_url') . '/favicon.ico'; ?>" type="images/x-icon" />


        <?php wp_head(); ?>
    </head>

    <body <?php body_class(ide_body_class()); ?>>
        <div id="header">

    <!--<form class="searchform" method="get" action="<?php //echo $_SERVER['PHP_SELF'];  ?>">
                        <div>
                                <input type="text" name="s" class="input" value="<?php //_e('search');  ?>" onfocus="javascript:(this.value == '<?php //_e('search');  ?>' ? this.value = '' : null );" />
                        </div>
                </form>-->

            <div class="content">
                <div class="logo">
                    <a href="<?php bloginfo('home'); ?>"><img src="<?php echo ide_option('logo_url') ? ide_option('logo_url') : get_bloginfo('template_url') . '/images/logo.png'; ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" /></a>
                    <p class="noIndent"><?php bloginfo('description'); ?></p>
                </div><!-- logo //-->

                <div class="banner"><?php echo ide_option('header_banner'); ?></div>

                <a href="https://www.facebook.com/cohoop" class="facebook socialBtn" title="Visit our Facebook page" target="_blank">Facebook</a>
                <a href="https://twitter.com/cohoop" class="twitter socialBtn" title="Follow us on Twitter !" target="_blank">Twitter</a>
                <a href="http://pinterest.com/cohoop/" class="pinterest socialBtn" title="See our works at Pinterest" target="_blank">Pinterest</a>

                <div class="clear"> </div>
            </div><!-- content //-->

            <div class="main_nav noul nav_categories">

                <?php
                if (ide_option('nav')):
                    if (function_exists('wp_nav_menu'))
                        wp_nav_menu(array('menu_class' => 'nav', 'theme_location' => 'menu_main'));
                endif;
                ?>
            </div>
        </div><!-- header //-->

        <div id="wrap">

            <div id="main">
