<?php 
    // GET CATEGORIES
    $tp = 'works-categories';
    $cats = get_terms($tp);
    $count_cats = count($cats);
    $term = get_queried_object()->slug;
?>

<?php if ($count_cats > 0) { ?>
    <div class="works-nav">
        <?php foreach ($cats as $catd) { ?>
            <a href="<?= esc_attr(get_term_link($catd, $tp)); ?>" class="works-nav-item <?php if (isset($term) && $catd->slug == $term) { echo 'selected'; } ?>" 
                title="<?php if (isset($term)) echo $term->name; ?>"><?= $catd->name; ?></a>
        <?php } ?>
    </div>
<?php } ?>