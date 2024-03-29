<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' ); 
	
	// Add the blog name.
	echo get_bloginfo( 'name' );
	
	
	if(!is_single()) { 
		if(of_get_option('md_header_logo_subtext')) { 
			echo " - ".of_get_option('md_header_logo_subtext'); 
			} 
	}
	
	/// CREATE DESCRIPTION
	if(is_single()) { 
		$post = $wp_query->post;
		$descrip = strip_tags($post->post_content);
		$descrip_more = '';
			if (strlen($descrip) > 155) {
				$descrip = substr($descrip,0,155);
				$descrip_more = ' ...';
			}
		$descrip = str_replace('"', '', $descrip);
		$descrip = str_replace("'", '', $descrip);
		$descripwords = preg_split('/[\n\r\t ]+/', $descrip, -1, PREG_SPLIT_NO_EMPTY);
		array_pop($descripwords);
		$descrip = implode(' ', $descripwords) . $descrip_more; 
	}else{ 
		$descrip = of_get_option('md_header_seo_description');
	}
	  ?></title>
	<meta name="description" content="<?php echo "Désormais Designer Graphique free-lance, mon expérience chez SAGUEZ & PARTNERS, agence de design global m’a permis de bien comprendre LA MARQUE."; ?>">
	<meta name="keywords" content="<?php echo of_get_option('md_header_seo_keywords'); ?>">
    
	<meta name="author" content="drone.tv" />

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
 
	<!-- CSS
  ================================================== -->
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <!--[if lt IE 9]>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri()?>/style_ie.css" />
	<![endif]-->
  
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri() ?>/images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri() ?>/images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri() ?>/images/apple-touch-icon-114x114.png">
        
	<!-- RSS
  ================================================== -->
  	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/rss">
  	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    
    
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	
    <!-- Head End
  ================================================== -->
    <?php wp_head(); ?>
    
</head>
 
 <body <?php body_class(); ?>>
    <div class="header-background">
        <div class="header-container container">
            <div class="header-wrapper">
                <div class="header">
                    <div class="header-logo">
                        <a href="#" class="button navbarbutton pull-right"><i class="menu-icon"></i></a>
                        <?php 
                        if(of_get_option('md_header_logo')) { 
                            echo '<a href="'.home_url().'" title="'.get_bloginfo( 'name' ).'"><img src="'.of_get_option('md_header_logo').'" class="" alt="'.get_bloginfo( 'name' ).'"></a>';
                        }elseif(of_get_option('md_header_logo_text')) {
                            echo '<a href="'.home_url().'" class="main-logo" title="drone">'.of_get_option('md_header_logo_text').'</a>';	
                        }else{
                            echo '<a href="'.home_url().'" class="main-logo" title="drone">'.get_bloginfo('name').'</a>';
                        }
                        ?>
                        
                        <!-- <a href="/"><img src="<?php echo get_template_directory_uri(); ?>/images/logo_white.svg" class="logo-white" style="display: none;"></a> -->

                        <div class="header-social">
                            <a href="http://instagram.com/ramony_lim/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                            <a href="https://www.linkedin.com/in/ramony-lim-da-graphiste/" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
                        </div>
                    </div>
                    <div class="ten columns omega header-right">
                            <div class="nav-div">
                            <?php 
                            $md_head_search = of_get_option('md_header_disable_search');
                            $md_head_subtext = of_get_option('md_header_logo_subtext');
                            if(!$md_head_search) : ?>
                            <form action="<?php echo get_site_url()?>">
                                <input type="text" name="s" class="medium" value=""><button type="submit"><i class='icon-search'></i></button>
                            </form>
                            <?php endif; ?>
                            
                            <?php 
                                if($md_head_search) { 
                                    echo '<div>';
                                    wp_nav_menu(array(
                                    'theme_location' => 'main_menu',
                                    'container' => '',
                                    'menu_class' => 'main-nav text-shadow',
                                    'before' => '',
                                    'fallback_cb' => ''
                                    ));
                                    echo '</div>';
                                    $menushowed=1;
                                } 
                            ?>
                    </div>
                </div>
            </div>
                <!-- <br class="clear" />
                <div class="six columns alpha">
                    <h6 class="subtext"><?php echo $md_head_subtext; ?></h6>
                </div>
                <?php if(!isset($menushowed)) { ?>
                <div class="ten columns omega header-right">
                        <?php wp_nav_menu(array(
                            'theme_location' => 'main_menu',
                            'container' => '',
                            'menu_class' => 'main-nav text-shadow',
                            'before' => '',
                            'fallback_cb' => ''
                        ));
                        ?> 
                </div>
                <?php } ?>
                <br class="clear" />
                <hr class="headerbottom border-color" /> -->
            </div>
            
            <div class="header_contact"></div>
        </div>
	</div>
	<div class="container">
    