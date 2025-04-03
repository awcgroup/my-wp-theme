<?php
/**
 * Product Search Results Template
 */
get_header();
?>

<main id="primary" class="site-main">
    <header class="woocommerce-products-header">
        <h1 class="title">
            <?php 
            printf( 
                esc_html__( 'Список товаров по запросу: "%s"', 'my-theme' ), 
                '<span>' . esc_html( get_search_query() ) . '</span>' 
            ); 
            ?>
        </h1>
    </header>

    <div class="product-archive-container">
        <?php
        // Модифицируем запрос для поиска ТОЛЬКО товаров
        global $wp_query;
        $args = array_merge( 
            $wp_query->query_vars, 
            [ 'post_type' => 'product' ] 
        );
        query_posts( $args );

        if ( have_posts() ) {
            woocommerce_product_loop_start();
            
            while ( have_posts() ) : the_post();
                wc_get_template_part( 'content', 'product' ); // Используем ваш шаблон товара
            endwhile;
            
            woocommerce_product_loop_end();
            
            // Пагинация как в archive-product.php
            woocommerce_pagination();
        } else {
            echo '<p>' . esc_html__( 'В нашем каталоге нет данных позиций', 'my-theme' ) . '</p>';
        }
        
        wp_reset_query();
        ?>
    </div>
</main>

<?php 
get_footer();