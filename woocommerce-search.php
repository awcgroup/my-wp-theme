<?php
/**
 * Шаблон для страниц поиска товаров WooCommerce
 */

get_header(); ?>

<main id="primary" class="site-main">
    <div class="container">
        <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
            <h1 class="woocommerce-products-header__title page-title">
                <?php printf(__('Результаты поиска: %s', 'woocommerce'), get_search_query()); ?>
            </h1>
        <?php endif; ?>

        <?php do_action('woocommerce_before_main_content'); ?>

        <div class="search-layout">
            <!-- Боковая колонка с категориями -->
            <aside class="search-sidebar">
                <h2>Категории</h2>
                <nav class="woocommerce-categories">
                    <?php
                    wp_list_categories(array(
                        'taxonomy'   => 'product_cat',
                        'title_li'   => '',
                        'show_count' => true,
                    ));
                    ?>
                </nav>
            </aside>

            <!-- Основная область с результатами поиска -->
            <section class="search-results">
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
                    <p class="no-results"><?php esc_html_e('По вашему запросу ничего не найдено.', 'woocommerce'); ?></p>
                <?php endif; ?>
            </section>
        </div>

        <?php do_action('woocommerce_after_main_content'); ?>
    </div>
</main>

<?php get_footer(); ?>