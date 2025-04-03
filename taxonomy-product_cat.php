<?php
/**
 * Шаблон для страниц категорий товаров WooCommerce
 */

get_header(); ?>

<main id="primary" class="site-main">
    <div class="container">
        <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
            <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
        <?php endif; ?>

        <?php do_action('woocommerce_before_main_content'); ?>

        <?php if (woocommerce_product_loop()) : ?>

            <?php do_action('woocommerce_before_shop_loop'); ?>

            <div class="products-wrapper">
                <?php woocommerce_product_loop_start(); ?>

                <?php while (have_posts()) : the_post(); ?>
                    <?php wc_get_template_part('content', 'product'); ?>
                <?php endwhile; ?>

                <?php woocommerce_product_loop_end(); ?>
            </div>

            <?php do_action('woocommerce_after_shop_loop'); ?>

        <?php else : ?>
            <?php do_action('woocommerce_no_products_found'); ?>
        <?php endif; ?>

        <?php do_action('woocommerce_after_main_content'); ?>
    </div>
</main>

<?php get_footer(); ?>