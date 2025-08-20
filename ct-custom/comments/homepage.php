<?php
/**
 * Template Name: Homepage
 */
get_header();
?>


<main class="container content-area">
    <div class="breadcrumb"><?php if(function_exists('bcn_display')) { bcn_display(); } ?></div>
    <h1 class="page-title"><?php the_title(); ?></h1>
    <div class="page-text"><?php the_content(); ?></div>

    <div class="contact-section">
        <div class="contact-form">
            <h2>CONTACT US</h2>
            <?php echo do_shortcode('[contact-form-7 id="ab5eaa9" title="Contact form 1"]'); ?>
        </div>
        <div class="contact-info">
            <h2>REACH US</h2>
            <p><?php echo nl2br(esc_html(get_option('theme_address'))); ?></p>
            <p>Phone: <?php echo esc_html(get_option('theme_phone')); ?><br>
               Fax: <?php echo esc_html(get_option('theme_fax')); ?></p>
            <div class="social-links">
    <?php
    $socials = get_option('theme_social_icons', array());
    if (!empty($socials)) {
        foreach ($socials as $social) {
            if (!empty($social['icon']) && !empty($social['url'])) {
                echo '<a href="'.esc_url($social['url']).'" target="_blank">
                        <img src="'.esc_url($social['icon']).'" alt="Social Icon" style="width:30px;height:30px;margin-right:5px;">
                      </a>';
            }
        }
    }
    ?>
</div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
