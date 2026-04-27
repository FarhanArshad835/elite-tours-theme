<?php
/**
 * Experience Funnel — Section 1: Hero
 * Full-bleed cinematic. Breadcrumb top-left, meta top-right.
 * Asymmetric bottom grid: title + CTAs left, narrative + facts right.
 */
defined( 'ABSPATH' ) || exit;

$f = $args['funnel'] ?? [];

$hero_id  = get_post_thumbnail_id( $args['post_id'] ?? get_the_ID() );
$hero_url = $hero_id
    ? wp_get_attachment_image_url( $hero_id, 'full' )
    : get_template_directory_uri() . '/assets/images/hero-default.jpg';

$eyebrow         = $f['eyebrow']         ?? '';
$title_em        = $f['hero_title_em']   ?? '';
$deck            = has_excerpt() ? get_the_excerpt() : ( $f['hero_deck'] ?? '' );
$breadcrumb      = $f['hero_breadcrumb'] ?? [];   // array of strings
$meta_strip      = $f['hero_meta_strip'] ?? [];   // array of strings
$aside_text      = $f['hero_aside_text'] ?? '';
$aside_facts     = $f['hero_aside_facts'] ?? [];  // [ [label, value], ... ]
$cta_primary     = $f['hero_cta_primary'] ?? 'Begin Your Journey';
$cta_primary_url = $f['hero_cta_primary_url'] ?? '#et-exp-cta';
$cta_secondary   = $f['hero_cta_secondary'] ?? 'Speak to a Designer';
$cta_secondary_url = $f['hero_cta_secondary_url'] ?? '#et-exp-cta';

$title = get_the_title();
?>
<section class="et-exp__hero">
    <img class="et-exp__hero-img" src="<?php echo esc_url( $hero_url ); ?>" alt="<?php echo esc_attr( $title ); ?>">
    <div class="et-exp__hero-overlay"></div>

    <?php if ( ! empty( $breadcrumb ) || ! empty( $meta_strip ) ) : ?>
    <div class="et-exp__hero-meta">
        <div class="et-exp__hero-breadcrumb">
            <?php
            $crumbs = array_values( array_filter( array_map( 'trim', (array) $breadcrumb ) ) );
            $last   = count( $crumbs ) - 1;
            foreach ( $crumbs as $i => $crumb ) :
                $is_last = ( $i === $last );
            ?>
                <span class="<?php echo $is_last ? 'et-exp__hero-breadcrumb-current' : ''; ?>">
                    <?php echo esc_html( $crumb ); ?>
                </span>
                <?php if ( ! $is_last ) : ?>
                    <span class="et-exp__hero-breadcrumb-sep">/</span>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div class="et-exp__hero-meta-right">
            <?php
            $strips = array_values( array_filter( array_map( 'trim', (array) $meta_strip ) ) );
            $last   = count( $strips ) - 1;
            foreach ( $strips as $i => $strip ) :
            ?>
                <span><?php echo esc_html( $strip ); ?></span>
                <?php if ( $i !== $last ) : ?>
                    <span class="et-exp__hero-meta-dot">·</span>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="et-exp__hero-content">
        <div>
            <?php if ( $eyebrow ) : ?>
                <div class="eyebrow et-exp__hero-eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
            <?php endif; ?>

            <h1 class="et-exp__hero-title">
                <?php
                if ( $title_em ) {
                    // split title at the italic fragment
                    $pos = stripos( $title, $title_em );
                    if ( $pos !== false ) {
                        echo esc_html( substr( $title, 0, $pos ) );
                        echo '<span class="et-exp__hero-title-em">' . esc_html( $title_em ) . '</span>';
                        echo esc_html( substr( $title, $pos + strlen( $title_em ) ) );
                    } else {
                        echo esc_html( $title );
                    }
                } else {
                    echo esc_html( $title );
                }
                ?>
            </h1>

            <?php if ( $deck ) : ?>
                <div class="et-exp__hero-deck"><?php echo esc_html( $deck ); ?></div>
            <?php endif; ?>

            <div class="et-exp__hero-cta">
                <a href="<?php echo esc_url( $cta_primary_url ); ?>" class="et-exp__btn et-exp__btn--gold">
                    <?php echo esc_html( $cta_primary ); ?>
                </a>
                <a href="<?php echo esc_url( $cta_secondary_url ); ?>" class="et-exp__btn et-exp__btn--ghost">
                    <?php echo esc_html( $cta_secondary ); ?>
                </a>
            </div>
        </div>

        <div class="et-exp__hero-aside">
            <?php if ( $aside_text ) : ?>
                <p class="et-exp__hero-aside-text"><?php echo esc_html( $aside_text ); ?></p>
            <?php endif; ?>

            <?php if ( ! empty( $aside_facts ) ) : ?>
                <div class="et-exp__hero-aside-facts">
                    <?php foreach ( $aside_facts as $fact ) :
                        $label = $fact['label'] ?? '';
                        $value = $fact['value'] ?? '';
                        if ( ! $label && ! $value ) continue;
                    ?>
                        <div>
                            <div class="et-exp__hero-aside-fact-label"><?php echo esc_html( $label ); ?></div>
                            <div><?php echo esc_html( $value ); ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="et-exp__hero-scroll" aria-hidden="true">
        <span>Scroll</span>
        <span class="et-exp__hero-scroll-line"></span>
    </div>
</section>
