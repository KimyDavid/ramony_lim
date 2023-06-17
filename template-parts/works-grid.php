<div class="works-senary-wrapper">
    <div class="works-senary-grid">
        <?php 
            $index = 0;
            while (have_posts()): the_post();
                $index++;

                if ($index == 1) : ?>
                    <div class="works-senary-row">
                <?php endif; ?>

                    <a href="<?php the_permalink(); ?>" class="works-senary">
                        <?php the_post_thumbnail('full'); ?>
                        <div class="works-senary-content">
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
                            <div class="works-senary-tags">
                                <div class="works-tags">
                                    <?php foreach ($categories as $category) : ?>
                                        <span class="works-tag"><?= $category ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </a>

                <?php if ($index == 4 || $i == 18) : ?>
                    </div>
                    <?php $index = 0;
                    endif;
            endwhile; ?>
    </div>
</div>