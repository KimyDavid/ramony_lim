<?php
the_content();

$projects = [];
$categoriesToFilter = [];
            
foreach (get_field('projects') as $project):
    $projectInfo = $project['project'];

    // RESET TO ARRAYS
    $draught_links = array();
    $draught_links_q = array();

    // POST CATEGORIES
    $categories = "";
    $categories_q = "";

    $terms = get_the_terms($projectInfo->ID, 'works-categories', 'string');

    if ($terms && !is_wp_error($terms)) {
        $draught_links = array();
        $draught_links_q = array();

        foreach ($terms as $term) {
            $draught_links[] = $term->name;
            $draught_links_q[] = $term->slug;

            if (!in_array($term->slug, $categoriesToFilter)) {
                array_push($categoriesToFilter, $term->slug);
            }
        }

        $categories = join(" – ", $draught_links);
        $categories_q = join(" ", $draught_links_q);
    }

    array_push($projects, [
        'link' => $projectInfo->guid,
        'thumbnail' => $project['project_image'],
        'title' => $projectInfo->post_title,
        'terms' => $categories,
        'cat' => $categories_q
    ]);

    // RESET TO ARRAYS
    $draught_links = array();
    $draught_links_q = array();
endforeach; 

?>

<div class="about text-center">
    <h1 class="page-title--primary">Ramony Lim, directrice artistique & graphiste indépendante.</h1>
    <p>Je suis spécialisée dans la création & l’évolution des marques. C’est alors une création sur-mesure pour chaque marque, chaque projet ou support pour créer ou faire évoluer ses codes graphiques, afin qu’ils soient identitaire, et que la marque  soit singulière ! Quelque que soit la problématique, c'est une création en finesse de typographies, de couleurs, de formes qui est une alchimie créative, toujours  avec du sens & de la cohérence, en harmonie avec les valeurs de la marque.</p>
    <p>Car : « L’essence du design est de faire sens ».®</p>
    <p>Et si on en discute ensemble ?</p>
</div>

<div class="portfolio-wrapper">
    <aside class="portfolio-nav">
        <h2 class="page-title--primary"><?= get_field('section_title'); ?></h2>
        <?= get_field('section_description') ?>
        <a href="/works" class="btn--primary">See all projects</a>
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
                        <p data-rel="all" class="portfolio-filter <?= 'portfolio-filter--active' ?>" data-th="<?php echo $getbr[3] ?>" title="<?php echo __("All", "dronetv"); ?>"><?php echo __("All", "dronetv"); ?></p>
                        <?php
                        foreach ($cats as $catd) {
                            if (in_array($catd->slug, $categoriesToFilter)):
                        ?>
                            <p class="portfolio-filter <?php if (isset($term) && $catd->slug == $term) {
                                                                                                                    echo 'portfolio-filter--active';
                                                                                                                } ?>" data-th="<?php echo $getbr[3] ?>" data-rel="<?php echo $catd->slug; ?>" title="<?php if (isset($term)) echo $term->name; ?>"><?php echo $catd->name; ?></p>
                        <?php endif; } ?>
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
        <span class="portfolio-filter-back"><i class="fa-solid fa-arrow-up"></i><span>Back to top</span></span>
    </aside>

    <main class="portfolio-projects" id="main_portfolio">
        <?php
            $index = 1;
            $group = 1;
            $html = '';

            foreach ($projects as $key => $project):
                $section = '';

                $isLastItem = $key == (count($projects) - 1);

                if ($index == 1):
                    $section = '<div class="portfolio-projects-group">' . $section;
                endif; 
                
                $class = "";
                if ($group % 2 == 0) {
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
                } else {
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
                }
                
                $section = $section . '<a class="portfolio-project '.$class. ' ' . $project['cat'] . '" href="'.$project['link'].'">'.
                    '<h3>'.$project['title'].'<span>'.$project['terms'].'</span></h3>'.
                    '<img loading="lazy" src="'.$project['thumbnail'].'" alt="'.$project['title'].'" />'.
                    '</a>';

                if ($isLastItem && $index < 4) {
                    while ($index < 4) {
                        $index++;
                        
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

                        $section = $section . '<div class="portfolio-project '.$class.'">' . '</div>';
                    }
                }
                
                if ($index == 4):
                    $section = $section . '</div>';
                endif;

                if ($index == 5):
                    $index = 0;
                    $group++;
                endif;

                $html =  $html . $section;
                
                $index++; 
                
            endforeach; 
            
            echo $html;
            ?>
    </main>
</div>

<div id="logos" class="logos">
    <!-- Pour rajouter un logo copier ce block ci-dessous-->
    <img loading="lzay" alt="Les marques qui me font confiance" src="http://www.ramonylim.com/wp-content/uploads/2014/09/LOGOS-WEB1.png"/>
</div>