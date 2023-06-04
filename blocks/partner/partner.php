<?php

/**
 * Partner Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */


// Load values and assign defaults.
$name             = get_field('name') ?: 'Nom du partenaire';
$description      = get_field('description') ?: 'Description du partenaire';
$picture          = get_field('picture') ?: '';
$url              = get_field('url');
$color            = get_field('color') ?: '#00C18B';

// Build a valid style attribute for background and text colors.
$styles = array('--partner-color: ' . $color);
$style  = implode('; ', $styles);

?>

<div class="partner-wrapper" style="<?php echo esc_attr($style); ?>">
    <div class="partner">
        <div class="partner-picture">
            <img src="<?php echo esc_html($picture) ?>" alt="<?php echo esc_html($name) ?>" />
        </div>
        <h3 class="partner-name"><?php echo esc_html($name) ?></h3>
        <p class="partner-description"><?php echo esc_html($description) ?></p>
        <?php if ($url): ?>
            <a href="<?php echo esc_html($url) ?>" class="partner-website">Voir le site web</a>
        <?php endif; ?>
    </div>
</div>