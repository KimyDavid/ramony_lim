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

<div class="portfolio-wrapper">
    <aside class="portfolio-nav">
        <h2 class="page-title--primary">Discover my projects</h2>
        <p>Most of these projects were achieved at Saguez & Partners, a global design agency.</p>
        <p>La plupart de ces projets ont été réalisés pour des clients de l’agence Saguez & Partners</p>
        <hr class="portfolio-separator" />
        <span class="portfolio-filter-title">Filter by :</span>
        <div class="portfolio-filters">
                    <?php
                    // GET CATEGORIES
                    $tp = 'works-categories';
                    $cats = get_terms($tp);
                    $count_cats = count($cats);
                    if ($count_cats > 0) {
                    ?>
                        <a href="#" data-rel="all" class="portfolio-filter <?php if (!isset($term)) {
                                                                            echo 'portfolio-filter--active';
                                                                        } ?>" data-th="<?php echo $getbr[3] ?>" title="<?php echo __("All", "dronetv"); ?>"><?php echo __("All", "dronetv"); ?></a>
                        <?php
                        foreach ($cats as $catd) {
                        ?>
                            <a href="<?php echo esc_attr(get_term_link($catd, $tp)); ?>" class="portfolio-filter <?php if (isset($term) && $catd->slug == $term) {
                                                                                                                    echo 'portfolio-filter--active';
                                                                                                                } ?>" data-th="<?php echo $getbr[3] ?>" data-rel="<?php echo $catd->slug; ?>" title="<?php if (isset($term)) echo $term->name; ?>"><?php echo $catd->name; ?></a>
                        <?php } ?>
                    <?php    } ?>

                <select class="responsiveselect reschange border-color">
                    <option value="all" selected=""><?php _e('Creative Fields...', 'dronetv') ?></option>
                    <?php
                    foreach ($cats as $catd) {
                    ?>
                        <option value="<?php echo $catd->slug; ?>"><?php echo $catd->name; ?></option>
                    <?php } ?>
                </select>
        </div>
    </aside>

    <main class="portfolio-projects">
    
        <?php
            $projects = [];
            $postIndex = 1;
            $postGroup = 1;
            
            while (have_posts()) : the_post();

                // RESET TO ARRAYS
                $draught_links = array();
                $draught_links_q = array();

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
                    $categories = join(" – ", $draught_links);
                    $categories_q = join(" ", $draught_links_q);
                }

                $thumbnail = "";
                if ($postGroup % 2 == 0) {
                    switch ($postIndex) {
                        case 1:
                            $thumbnail = getThumb('portfolio_square');
                            break;
                        case 2:
                            $thumbnail = getThumb('portfolio_square_sibling');
                            break;
                        case 3:
                            $thumbnail = getThumb('portfolio_large_sibling');
                            break;
                        case 4:
                            $thumbnail = getThumb('portfolio_large');
                            break;
                    }
                } else {
                    switch ($postIndex) {
                        case 1:
                            $thumbnail = getThumb('portfolio_large');
                            break;
                        case 2:
                            $thumbnail = getThumb('portfolio_large_sibling');
                            break;
                        case 3:
                            $thumbnail = getThumb('portfolio_square_sibling');
                            break;
                        case 4:
                            $thumbnail = getThumb('portfolio_square');
                            break;
                        }
                }

                if ($postIndex == 5) {
                    $thumbnail = getThumb('portfolio_full');
                }

                array_unshift($projects, [
                    'link' => get_permalink(),
                    'thumbnail' => $thumbnail[0],
                    'title' => get_the_title(),
                    'excerpt' => get_the_excerpt(),
                    'terms' => $categories
                ]);

                // RESET TO ARRAYS
                $draught_links = array();
                $draught_links_q = array();

                if ($postIndex == 5):
                    $postIndex = 0;
                    $postGroup++;
                endif; 
                
                $postIndex++;
            
            endwhile; 
            
            $index = 1;
            $group = 1;
            $html = '';

            // array_reverse($projects);

            foreach ($projects as $project):
                $section = '';

                if ($index == 1):
                    $section = $section . '</div>';
                endif; 
                
                $class = "";
                if ($group % 2 == 0) {
                    switch ($index) {
                        case 1:
                            $class = 'square';
                            break;
                        case 2:
                            $class = 'square-sibling';
                            break;
                        case 3:
                            $class = 'large-sibling';
                            break;
                        case 4:
                            $class = 'large';
                            break;
                    }
                } else {
                    switch ($index) {
                        case 1:
                            $class = 'large';
                            break;
                        case 2:
                            $class = 'large-sibling';
                            break;
                        case 3:
                            $class = 'square-sibling';
                            break;
                        case 4:
                            $class = 'square';
                            break;
                    }
                }
                
                $section = '<a class="portfolio-project '.$class.'" href="'.$project['link'].'">'.
                    '<h3>'.$project['title'].'<span>'.$project['terms'].'</span></h3>'.
                    '<img src="'.$project['thumbnail'].'" alt="'.$project['title'].'" />'.
                    '</a>' . $section;
                
                if ($index == 4):
                    $section = '<div class="portfolio-projects-group">' . $section;
                endif;

                if ($index == 5):
                    $index = 0;
                    $group++;
                endif;

                $html =  $section . $html;
                
                $index++; 
                
            endforeach; 
            
            echo $html;
            ?>
    </main>
</div>

<div id="logos" class="logos">
    <!-- Pour rajouter un logo copier ce block ci-dessous-->
    <img src="http://www.ramonylim.com/wp-content/uploads/2014/09/LOGOS-WEB1.png"/>
</div>