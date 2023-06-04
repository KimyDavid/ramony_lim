<?php
/*
Template Name: Full Width
*/
?>
<?php get_header(); ?>
    <br class="clear" />
    <div class="row fitvids">
    	<div class="sixteen columns">
            <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
    	</div>
    </div>
    <?php 
        global $post;
        $post_slug = $post->post_name;
        if ($post_slug == "about"):
    ?>
        <div id="logos" class="logos">
            <img loading="lzay" alt="Les marques qui me font confiance" src="http://www.ramonylim.com/wp-content/uploads/2014/09/LOGOS-WEB1.png"/>
        </div>
    <?php endif; ?>
<?php get_footer(); ?>
	