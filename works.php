<?php

$tp = 'works-categories';
$selectedCat = get_queried_object()->slug;

// GET PORTFOLIO POSTS
if ($selectedCat !== '') {
    $args = array(
        'posts_per_page' => 9999,
        'post_type' => 'works',
        'post_status' => array('publish'),
        'tax_query' => array(
            array(
                'taxonomy' => $tp,
                'field' => 'slug',
                'terms' => $selectedCat
            )
        )
    );
} else {
    $args = array(
        'posts_per_page' => 9999,
        'post_type' => 'works',
        'post_status' => array('publish')
    );
}

query_posts($args);

$nb_works = wp_count_posts('works')->publish;

$title = get_the_title();
if ($selectedCat !== ''):
    $title = 'Works : ' . get_term_by( 'slug', $selectedCat, $tp )->name;
endif;
?>

<div class="works-wrapper">
    <?php if ($selectedCat !== ''): ?>
        <div class="works-return-wrapper"><a href="/works" class="works-return"><span class="fa-solid fa-arrow-left"></span>Retour aux projets</a></div>
    <?php endif; ?>
    
    <h1 class="text-center page-title--primary"><?= $title ?></h1>

    <?= get_template_part( 'template-parts/works-nav' );  ?>

    <?php if ($selectedCat == ''): ?>
        <?php the_post(); ?>
        <div class="works-main-wrapper">
            <div class="works-main">
                <?php the_post_thumbnail('full'); ?>
                <a class="works-main-content works-content" href="<?php the_permalink(); ?>">
                    <?php
                        $categories = array();
                        $terms = get_the_terms($post->ID, 'works-categories', 'string');
                        if ($terms && !is_wp_error($terms)) {
                            foreach ($terms as $term) {
                                $categories[] = $term->name;
                            }
                        } 
                    ?>
                    <div class="works-main-tags">
                        <div class="works-tags">
                            <?php foreach($categories as $category): ?>
                                <span class="works-tag"><?= $category ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <h2 class="works-title page-title--secondary"><?php the_title(); ?></h2>
                    <div>
                        <?php the_excerpt(); ?>
                    </div>
                    <p><span class="works-link"><span class="fa-solid fa-arrow-right"></span><span class="works-link-underline">Voir le projet</span></span></p>
                </a>
            </div>
        </div>

        <div class="works-secondary-wrapper">
            <?php for ($i = 1; $i <= 3; $i++): ?>
                <?php the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="works-secondary">
                    <?php the_post_thumbnail('full'); ?>
                    <div class="works-secondary-content">
                        <h2 class="works-title page-title--secondary"><?php the_title(); ?></h2>

                        <?php
                            $categories = array();
                            $terms = get_the_terms($post->ID, 'works-categories', 'string');
                            if ($terms && !is_wp_error($terms)) {
                                foreach ($terms as $term) {
                                    $categories[] = $term->name;
                                }
                            } 
                        ?>
                        <div class="works-secondary-tags">
                            <div class="works-tags">
                                <?php foreach($categories as $category): ?>
                                    <span class="works-tag"><?= $category ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endfor; ?>
        </div>
        
        <?php the_post(); ?>
        <div class="works-tertiary-wrapper">
            <div class="works-tertiary">
                <?php the_post_thumbnail('full'); ?>
                <a class="works-tertiary-content works-content" href="<?php the_permalink(); ?>">
                    <?php
                        $categories = array();
                        $terms = get_the_terms($post->ID, 'works-categories', 'string');
                        if ($terms && !is_wp_error($terms)) {
                            foreach ($terms as $term) {
                                $categories[] = $term->name;
                            }
                        } 
                    ?>
                    <div class="works-tertiary-tags">
                        <div class="works-tags">
                            <?php foreach($categories as $category): ?>
                                <span class="works-tag"><?= $category ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <h2 class="works-title page-title--secondary"><?php the_title(); ?></h2>
                    <div>
                        <?php the_excerpt(); ?>
                    </div>
                    <p><span class="works-link"><span class="fa-solid fa-arrow-right"></span><span class="works-link-underline">Voir le projet</span></span></p>
                </a>
            </div>
        </div>

        <div class="works-quaternary-wrapper">
            <?php for ($i = 1; $i <= 3; $i++): ?>
                <?php the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="works-quaternary">
                    <?php the_post_thumbnail('full'); ?>
                    <div class="works-quaternary-content">
                        <h2 class="works-title page-title--secondary"><?php the_title(); ?></h2>

                        <?php
                            $categories = array();
                            $terms = get_the_terms($post->ID, 'works-categories', 'string');
                            if ($terms && !is_wp_error($terms)) {
                                foreach ($terms as $term) {
                                    $categories[] = $term->name;
                                }
                            } 
                        ?>
                        <div class="works-quaternary-tags">
                            <div class="works-tags">
                                <?php foreach($categories as $category): ?>
                                    <span class="works-tag"><?= $category ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endfor; ?>
        </div>
        
        <?php the_post(); ?>
        <div class="works-quinary-wrapper">
            <div class="works-quinary">
                <?php the_post_thumbnail('full'); ?>
                <a class="works-quinary-content works-content" href="<?php the_permalink(); ?>">
                    <?php
                        $categories = array();
                        $terms = get_the_terms($post->ID, 'works-categories', 'string');
                        if ($terms && !is_wp_error($terms)) {
                            foreach ($terms as $term) {
                                $categories[] = $term->name;
                            }
                        } 
                    ?>
                    <div class="works-quinary-tags">
                        <div class="works-tags">
                            <?php foreach($categories as $category): ?>
                                <span class="works-tag"><?= $category ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <h2 class="works-title page-title--secondary"><?php the_title(); ?></h2>
                    <div>
                        <?php the_excerpt(); ?>
                    </div>
                    <p><span class="works-link"><span class="fa-solid fa-arrow-right"></span><span class="works-link-underline">Voir le projet</span></span></p>
                </a>
            </div>
        </div>
    <?php endif; ?>

    <?= get_template_part( 'template-parts/works-grid' );  ?>
</div>

<div id="logos" class="logos">
    <!-- Pour rajouter un logo copier ce block ci-dessous-->
    <img loading="lzay" alt="Les marques qui me font confiance" src="http://www.ramonylim.com/wp-content/uploads/2014/09/LOGOS-WEB1.png"/>
</div>