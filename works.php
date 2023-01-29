<?php
// GET SELECTED THUMBNAIL SIZE
$thumb = of_get_option('md_post_featured_img_size');

/// CHECK CATEGORY
if (isset($term)) {
    $checkcat = $term;
}
// GET PORTFOLIO POSTS
$args = array(
    'posts_per_page' => 9999,
    'post_type' => 'works',
    'post_status' => array('publish'),
    'offset' => 1,
);

if (function_exists('CPTO_activated')) {
    $args = array_merge(
        $args,
        array(
            'orderby' => 'menu_order',
            'order' => 'asc'
        )
    );
}

query_posts($args);

// FRO BR
$p = 1;
$getbr = getThumb($thumb);
?>

<?php
// Get first projetct.
$first = new WP_Query(
    array(
        'posts_per_page' => 1,
        'post_type' => 'works',
        'post_status' => array('publish'),
    )
);
if ($first->have_posts()) {
    while ($first->have_posts()) {
        $first->the_post();
?>
        <div class="ra-work-first">
            <a href="<?php the_permalink(); ?>">
                <?php echo get_the_post_thumbnail(get_the_ID(), 'large'); ?>
                <span><?php the_title(); ?></span>
            </a>
        </div>
<?php
    }
}
?>

<div class="navibg withall border-color">
    <div class="sixteen columns omega" style="margin-left:0;margin-right:0;">
        <div id="portfolio-cats" class="navigate">
            <h1 class="page-title--primary text-center">My Works as a Freelance Art Director & Graphic Designer</h1>
            <hr class="resshow border-color" />
            <div class="fullnav text-center">
                <?php
                // GET CATEGORIES
                $tp = 'works-categories';
                $cats = get_terms($tp);
                $count_cats = count($cats);
                if ($count_cats > 0) {
                ?>
                    <a href="#" data-rel="all" class="activemenu-bg <?php if (!isset($term)) {
                                                                        echo 'selected';
                                                                    } ?>" data-th="<?php echo $getbr[3] ?>" title="<?php echo __("ALL", "dronetv"); ?>"><?php echo __("ALL", "dronetv"); ?></a>
                    <?php
                    foreach ($cats as $catd) {
                    ?>
                        <a href="<?php echo esc_attr(get_term_link($catd, $tp)); ?>" class="activemenu-bg <?php if (isset($term) && $catd->slug == $term) {
                                                                                                                echo 'selected';
                                                                                                            } ?>" data-th="<?php echo $getbr[3] ?>" data-rel="<?php echo $catd->slug; ?>" title="<?php if (isset($term)) echo $term->name; ?>"><?php echo strtoupper($catd->name); ?></a>
                    <?php } ?>
                <?php    } ?>
            </div>

            <div class="warning">Most of these projects were achieved at Saguez & Partners, a global design agency // La plupart de ces projets ont été réalisés pour des clients de l’agence Saguez & Partners</div>
            <select class="responsiveselect reschange border-color">
                <option value="all" selected=""><?php _e('Creative Fields...', 'dronetv') ?></option>
                <?php
                foreach ($cats as $catd) {
                ?>
                    <option value="<?php echo $catd->slug; ?>"><?php echo $catd->name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>
<div class="works-single hidden"></div>

<br class="clear">

<div id="post-list" class="row">
    <?php while (have_posts()) : the_post(); ?>
        <?php

        // THUMBNAIL & CSS CLASS
        $cthumbnail = getThumb($thumb);

        //forresponsive
        $getfull = getThumb('large');

        // RESET TO ARRAYS
        $draught_links = array();
        $draught_links_q = array();

        // AJAX TOKEN
        $token = wp_create_nonce("wp_token");

        // POST CATEGORIES
        $categories = "";
        $categories_q = "";

        $terms = get_the_terms($post->ID, 'works-categories', 'string');

        if ($terms && !is_wp_error($terms)) {
            $draught_links = array();
            $draught_links_q = array();
            foreach ($terms as $term) {
                $draught_links[] = $term->name;
                $draught_links_q[] = $term->slug;
            }
            $categories = join(", ", $draught_links);
            $categories_q = join(" ", $draught_links_q);
        }

        /// DECIDE WHICH CATEGORY TO SHOW	
        $paste = '';
        if (isset($checkcat)) {
            if (!in_array($checkcat, $draught_links_q)) {
                $paste = 'style="display:none"';
            }
        }

        // RESET TO ARRAYS
        $draught_links = array();
        $draught_links_q = array();

        ?>
        <div class="<?php echo $categories_q;
                    echo " " . $cthumbnail[1]; ?> project-item" <?php echo $paste; ?>>
            <div class="imgdiv">
                <a href="<?php the_permalink() ?>" class="getworks" data-type="works" data-id="<?php echo $post->ID ?>" data-token="<?php echo $token ?>">
                    <span></span>
                    <?php if ($cthumbnail[0]) : ?>
                        <img src="<?php echo $cthumbnail[0]; ?>" data-small="<?php echo $cthumbnail[0] ?>" data-large="<?php echo $getfull[0] ?>" title="<?php echo get_the_title() ?>" alt="<?php echo get_the_title() ?>" />
                    <?php endif; ?>
                </a>
            </div>
            <div class="thumb_large">
                <h5><a href="<?php the_permalink() ?>" class="getworks" data-type="works" data-id="<?php echo $post->ID ?>" data-token="<?php echo $token ?>"><?php the_title(); ?> / <?php echo $categories_q; ?></a></h5>
                <div style="display:none;"><?php the_excerpt(); ?></div>
            </div>
        </div>
        <?php if ($p == $cthumbnail[3] && $paste == '') {
            $p = 0;
            echo '<br class="clear rowseperator">';
        } ?>
        <?php if ($paste == '') {
            $p++;
        }  ?>
    <?php endwhile; ?>

</div>

<div id="logos" class="logos">
    <!-- Pour rajouter un logo copier ce block ci-dessous-->
    <img loading="lzay" alt="Les marques qui me font confiance" src="http://www.ramonylim.com/wp-content/uploads/2014/09/LOGOS-WEB1.png"/>
</div>