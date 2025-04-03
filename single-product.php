<?php
if (!defined('ABSPATH')) {
    exit; // Защита от прямого доступа
}

get_header(); ?>
<!-- Хлебные крошки -->
<div class="product-breadcrumbs-wrapper">
    <div class="container-1440">
        <?php woocommerce_breadcrumb(); ?>
    </div>
</div>
<div class="custom-single-product-wrapper">
    
    <div class="product-container">
        
        <aside class="product-sidebar">
            <?php get_sidebar('shop'); ?>
        </aside>

        <main class="product-main">
            <?php while (have_posts()) : the_post(); ?>
                <div class="product-content">
                    <div class="product-gallery">
                        <?php woocommerce_show_product_images(); ?>
                    </div>
                    <div class="product-summary">
                        <h1 class="product-title"><?php the_title(); ?></h1>
                        <div class="product-price"><?php woocommerce_template_single_price(); ?></div>
                        <div class="product-meta"><?php woocommerce_template_single_meta(); ?></div>
                        <div class="product-short-description"><?php woocommerce_template_single_excerpt(); ?></div>
                        
                         <!-- Форма добавления товара в корзину -->
                        <form class="cart" method="post" enctype="multipart/form-data">
                            <div class="order-button-container">
                                <?php woocommerce_template_single_add_to_cart(); ?>
                            </div>
                        </form>
                    </div>
				
                </div>
            <?php endwhile; ?>
            <!-- Описание товара (отдельный блок внизу) -->
            <div class="product-description">
                <h2>Описание</h2>
                <?php the_content(); ?>
            </div>
        </main>
    </div>
</div>

<?php get_footer(); ?>