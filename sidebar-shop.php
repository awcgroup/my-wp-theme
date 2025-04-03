<?php
// Получаем список всех категорий товаров (только родительские)
$product_categories = get_terms(array(
    'taxonomy'   => 'product_cat',
    'orderby'    => 'name',
    'order'      => 'ASC',
    'hide_empty' => false,
    'parent'     => 0
));

if (!empty($product_categories)) : ?>
    <div class="catalog-navigation">
        <h3>Каталог товаров</h3>
        <ul class="category-list">
            <?php foreach ($product_categories as $category) :
                // Проверяем, является ли категория родительской для текущего товара
                $is_current_category = false;
                if (is_product()) {
                    global $post;
                    $product_cats = wp_get_post_terms($post->ID, 'product_cat');
                    foreach ($product_cats as $cat) {
                        if ($cat->term_id == $category->term_id || $cat->parent == $category->term_id) {
                            $is_current_category = true;
                            break;
                        }
                    }
                }
                ?>
                <li class="category-item <?php echo $is_current_category ? 'active' : ''; ?>">
                    <a href="<?php echo get_term_link($category); ?>"><?php echo $category->name; ?></a>

                    <?php if ($is_current_category) : 
                        // Получаем подкатегории
                        $subcategories = get_terms(array(
                            'taxonomy'   => 'product_cat',
                            'parent'     => $category->term_id,
                            'hide_empty' => false,
                            'orderby'    => 'name',
                            'order'      => 'ASC'
                        ));
                        
                        // Получаем товары в категории
                        $products = new WP_Query(array(
                            'post_type'      => 'product',
                            'posts_per_page' => -1,
                            'tax_query'      => array(
                                array(
                                    'taxonomy' => 'product_cat',
                                    'field'    => 'term_id',
                                    'terms'    => $category->term_id
                                )
                            )
                        ));
                    ?>

                        <ul class="subcategory-list">
                            <?php foreach ($subcategories as $subcategory) : ?>
                                <li class="subcategory-item">
                                    <span class="toggle-icon" onclick="toggleSubcategory(this)">▶</span>
                                    <a href="<?php echo get_term_link($subcategory); ?>"><?php echo $subcategory->name; ?></a>
                                    <ul class="product-list hidden">
                                        <?php
                                        $sub_products = new WP_Query(array(
                                            'post_type'      => 'product',
                                            'posts_per_page' => -1,
                                            'tax_query'      => array(
                                                array(
                                                    'taxonomy' => 'product_cat',
                                                    'field'    => 'term_id',
                                                    'terms'    => $subcategory->term_id
                                                )
                                            )
                                        ));
                                        while ($sub_products->have_posts()) : $sub_products->the_post(); ?>
                                            <li class="product-item">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </li>
                                        <?php endwhile; wp_reset_postdata(); ?>
                                    </ul>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>