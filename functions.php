<?php

/*
Theme Name: MyTheme
Theme URI: https://example.com
Author: Your Name
Author URI: https://example.com
Description: Custom WordPress theme with WooCommerce support.
Version: 1.0
License: GNU General Public License v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: mytheme
*/

// Подключаем стили и скрипты
function mytheme_enqueue_scripts() {
    wp_enqueue_style('mytheme-style', get_stylesheet_uri());
    wp_enqueue_script('mytheme-script', get_template_directory_uri() . '/js/main.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');

// Support WooCommerce
function mytheme_woocommerce_support() {
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'mytheme_woocommerce_support');

// Register Menu
function mytheme_register_menus() {
    register_nav_menus(array(
        'main-menu' => __('Main Menu', 'mytheme'),
    ));
}
add_action('after_setup_theme', 'mytheme_register_menus');

// Register Sidebar
function mytheme_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'mytheme'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here.', 'mytheme'),
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'mytheme_widgets_init');

// Добавление поддержки логотипа в теме
function mytheme_custom_logo_setup() {
    add_theme_support( 'custom-logo', array(
        'height'      => 100, // Высота логотипа
        'width'       => 300, // Ширина логотипа
        'flex-width'  => true, // Позволяет логотипу быть гибким по ширине
        'flex-height' => true, // Позволяет логотипу быть гибким по высоте
        'header-text' => array( 'site-title', 'site-description' ), // Заголовок и описание сайта могут быть отображены рядом с логотипом
    ) );
}
add_action( 'after_setup_theme', 'mytheme_custom_logo_setup' );

// Добавление настройки логотипа в Customizer
function mytheme_customize_register( $wp_customize ) {
    // Добавляем секцию для логотипа
    $wp_customize->add_section( 'mytheme_logo_section' , array(
        'title'      => __( 'Логотип', 'mytheme' ),
        'priority'   => 30,
    ) );

    // Добавляем настройку для логотипа
    $wp_customize->add_setting( 'mytheme_logo' );

    // Добавляем поле для загрузки логотипа
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mytheme_logo', array(
        'label'    => __( 'Загрузить логотип', 'mytheme' ),
        'section'  => 'mytheme_logo_section',
        'settings' => 'mytheme_logo',
    ) ) );
}
add_action( 'customize_register', 'mytheme_customize_register' );
function my_theme_enqueue_styles() {
    wp_enqueue_style('sale-products-style', get_template_directory_uri() . '/css/sale-products.css');
     // Подключаем стиль для категорий товаров
    wp_enqueue_style( 'shop-categories-style', get_template_directory_uri() . '/css/shop-categories.css' );
    wp_enqueue_script('sale-products-js', get_template_directory_uri() . '/js/scroll.js', array(), null, true);
}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
 
function enqueue_category_styles() {
    wp_enqueue_style('category-style', get_template_directory_uri() . '/css/category-style.css', array(), null);
}
add_action('wp_enqueue_scripts', 'enqueue_category_styles');
 
function load_cart_checkout_styles() {
    if (is_cart() || is_checkout()) {
        wp_enqueue_style('cart-checkout-style', get_template_directory_uri() . '/css/cart-checkout-style.css');
    }
}
add_action('wp_enqueue_scripts', 'load_cart_checkout_styles');
function enqueue_custom_single_product_styles() {
    if (is_product()) { // Подключаем только на страницах товаров
        wp_enqueue_style('custom-single-product', get_template_directory_uri() . '/css/single-product.css', array(), '1.0', 'all');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_single_product_styles');
function custom_footer_widget_area() {
    // Регистрируем три области для футера
    register_sidebar( array(
        'name'          => 'Footer Column 1',
        'id'            => 'footer-widget-area-1',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-widget-title">',
        'after_title'   => '</h3>',
    ) );
    
    register_sidebar( array(
        'name'          => 'Footer Column 2',
        'id'            => 'footer-widget-area-2',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-widget-title">',
        'after_title'   => '</h3>',
    ) );
    
    register_sidebar( array(
        'name'          => 'Footer Column 3',
        'id'            => 'footer-widget-area-3',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'custom_footer_widget_area' );
function custom_woocommerce_sidebar() {
    register_sidebar(array(
        'name'          => __('WooCommerce Sidebar', 'your-theme'),
        'id'            => 'sidebar-shop',
        'description'   => __('Сайдбар для страниц магазина и товаров', 'your-theme'),
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'custom_woocommerce_sidebar');
function custom_scripts() {
    if (is_product()) {
        wp_enqueue_script('single-product-js', get_template_directory_uri() . '/js/single-product.js', array(), null, true);
    }
}
add_action('wp_enqueue_scripts', 'custom_scripts');
function remove_add_to_cart_param() {
    if (is_cart()) {
        echo "<script>
            if (window.location.href.indexOf('?add-to-cart=') !== -1) {
                window.history.replaceState({}, document.title, '".wc_get_cart_url()."');
            }
        </script>";
    }
}
add_action('wp_footer', 'remove_add_to_cart_param');

function custom_woocommerce_product_categories() {
    $args = array(
        'taxonomy'   => 'product_cat',
        'orderby'    => 'name',
        'order'      => 'ASC',
        'hide_empty' => true, // Скрывает пустые категории
    );

    $categories = get_terms($args);
    
    if ($categories) {
        $output = '<div class="custom-product-categories-wrapper">';
        $output .= '<h3 class="custom-category-title">Категории</h3>'; // Заголовок блока
        $output .= '<ul class="custom-product-categories">';
        foreach ($categories as $category) {
            $category_link = get_term_link($category);
            $output .= '<li><a href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a></li>';
        }
        $output .= '</ul>';
        $output .= '</div>';
        return $output;
    }
    
    return '';
}

// Регистрируем новый шорткод [custom_product_categories]
add_shortcode('custom_product_categories', 'custom_woocommerce_product_categories');
// Убираем <h2> для похожих товаров
add_filter('woocommerce_product_get_title', 'custom_related_products_title', 10, 2);

function custom_related_products_title($title, $product) {
    if (is_product()) {
        return $title; // Возвращаем обычный текст, если на странице товара
    }

    // Если на странице похожих товаров
    if (is_single() && is_product()) {
        return $title; // Возвращаем текст без изменений
    }

    // Здесь можно изменить название для секции "Похожие товары"
    // Можно оставить его без изменений или вернуть как обычный текст
    return esc_html($title); 
}
// Добавление текста "Стоимость:" перед ценой товара на странице товара
add_filter('woocommerce_get_price_html', 'add_price_label', 10, 2);

function add_price_label($price, $product) {
    // Проверяем, находимся ли мы на странице товара
    if (is_product()) {
        // Добавляем "Стоимость:" перед ценой
        $price = '<span class="price-label">Цена:</span> ' . $price;
    }
    return $price;
}
// Фильтр для удаления родительской категории из URL
add_filter('term_link', function ($url, $term, $taxonomy) {
    if ($taxonomy === 'product_cat') {
        $term_slug = $term->slug;
        $url = home_url('/product-category/' . $term_slug . '/');
    }
    return $url;
}, 100, 3);

// Редирект со старого URL на новый
add_action('template_redirect', function () {
    if (is_product_category()) {
        global $wp_query;
        $term = $wp_query->get_queried_object();
        if ($term && !empty($term->parent)) {
            $correct_url = home_url('/product-category/' . $term->slug . '/');
            if (trailingslashit($_SERVER['REQUEST_URI']) !== trailingslashit(parse_url($correct_url, PHP_URL_PATH))) {
                wp_redirect($correct_url, 301);
                exit;
            }
        }
    }
});

function custom_product_categories_sidebar() {
    $args = array(
        'taxonomy'     => 'product_cat',
        'orderby'      => 'name',
        'order'        => 'ASC',
        'hide_empty'   => true,
        'parent'       => 0,
    );

    $categories = get_categories($args);
    if (empty($categories)) {
        return '<p>Категории не найдены</p>';
    }

    $current_category = get_queried_object(); // Определяем текущую категорию

    $output = '<div class="custom-category-sidebar">';
    $output .= '<h3 class="custom-category-title">Категории</h3>';
    $output .= '<ul class="category-list">';

    foreach ($categories as $category) {
        $is_current_cat = ($current_category && $current_category->term_id == $category->term_id);
        
        $subcategories = get_categories(array(
            'taxonomy'   => 'product_cat',
            'parent'     => $category->term_id,
            'hide_empty' => true,
        ));

        $has_subcategories = !empty($subcategories);
        $is_parent_of_current = $current_category && $current_category->parent == $category->term_id;

        // Добавляем класс для активной категории
        $category_class = $is_current_cat ? ' current-cat' : '';
        $category_class .= $is_parent_of_current ? ' parent-of-current' : '';

        $output .= '<li class="category-item' . $category_class . '">';
        $output .= '<a href="' . get_term_link($category) . '" class="category-link">' . $category->name . '</a>';
        
        if ($has_subcategories) {
            $output .= '<span class="subcategory-toggle">+</span>';
        } else {
            $output .= '<span class="subcategory-placeholder"></span>';
        }

        if ($has_subcategories) {
            $output .= '<ul class="subcategory-list" ' . ($is_parent_of_current ? 'style="display:block;"' : '') . '>';
            foreach ($subcategories as $subcategory) {
                $is_current_subcat = ($current_category && $current_category->term_id == $subcategory->term_id);
                $subcat_class = $is_current_subcat ? ' current-subcat' : '';
                
                $output .= '<li class="' . $subcat_class . '"><a href="' . get_term_link($subcategory) . '">' . $subcategory->name . '</a></li>';
            }
            $output .= '</ul>';
        }

        $output .= '</li>';
    }

    $output .= '</ul>';
    $output .= '</div>';

    return $output;
}
add_shortcode('custom_product_categories_sidebar', 'custom_product_categories_sidebar');


function custom_enqueue_scripts() {
    // Подключаем jQuery (если не подключен)
    wp_enqueue_script('jquery');

    // Подключаем наш JS-файл
    wp_enqueue_script(
        'custom-open-js',
        get_stylesheet_directory_uri() . '/js/open.js',
        array('jquery'), // Зависимость от jQuery
        null,
        true // Подключаем в footer
    );
}
add_action('wp_enqueue_scripts', 'custom_enqueue_scripts');

function add_new_product_label() {
    global $product;

    // Получаем название товара
    $product_title = $product->get_name();

    // Проверяем наличие слов "новый", "новая", "новые"
    if (strpos(strtolower($product_title), 'новый') !== false || 
        strpos(strtolower($product_title), 'новая') !== false
        || 
        strpos(strtolower($product_title), 'новая') !== false
        || 
        strpos(strtolower($product_title), 'новое') !== false) {

        // Добавляем HTML-метку "Новый" в карточку товара
        echo '<span class="new-product-label">Новый</span>';
    }
}

// Добавляем лейбл "Новый" на странице товара (до заголовка товара)
add_action('woocommerce_before_single_product_summary', 'add_new_product_label', 5);

// Добавляем лейбл "Новый" в списке товаров и на странице related products
add_action('woocommerce_before_shop_loop_item_title', 'add_new_product_label', 10);
add_action('woocommerce_single_product_summary', 'add_new_product_label', 5);
function enqueue_custom_styles() {
    if (is_product_category() || is_single()) {
        wp_enqueue_style('custom-category-styles', get_template_directory_uri() . '/css/new.css');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

function custom_product_list_shortcode($atts) {
    if (!is_tax('product_cat')) {
        return '<p>Выберите категорию товаров.</p>';
    }

    $category = get_queried_object();
    $category_slug = $category->slug;

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'post_status'    => 'publish',
	  

							
        'tax_query'      => array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $category_slug,
            ),
        ),
    );

    $products = new WP_Query($args);

    if (!$products->have_posts()) {
        return '<p>В этой категории пока нет товаров.</p>';
    }
							

    ob_start();
										   
											 

    echo '<div class="custom-product-list" style="display: flex; flex-wrap: wrap; gap: 5px;">';

    while ($products->have_posts()) {
        $products->the_post();
        global $product;

        $title = get_the_title();
        $price = $product->get_price();
        $condition = '';

        // Определяем состояние товара
        if (preg_match('/\bнов(ый|ая|ые|ое)\b/ui', $title)) {
            $condition = 'Товар: Новый';
        } elseif (preg_match('/\bб\/у\b/ui', $title)) {
            $condition = 'Товар: Б/У';
        }
	 

        $product_id = $product->get_id();

        // Определяем стиль для выравнивания цены
        $price_style = 'text-align: right;'; // По умолчанию выравнивание по правому краю

        // Если в заголовке есть слово "новый", "новая", "новые" или "Б/У", меняем выравнивание цены
        if (preg_match('/\bнов(ый|ая|ые|ое)\b/ui', $title) || preg_match('/\bб\/у\b/ui', $title)) {
            $price_style = 'text-align: left;'; // Изменяем выравнивание, если товар новый или Б/У
        }

        // Контейнер для карточки товара
        echo '<div class="custom-product-item" style="border: 1px solid #fff; padding: 15px; box-sizing: border-box;">';
        
        // 1. Колонка с изображением
        echo '<div class="product-image">';
        echo '<a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), 'thumbnail') . '</a>';
        echo '</div>';
        
        // 2. Колонка с названием, состоянием и ценой
        echo '<div class="product-info" style="padding: 10px 0;">';
        echo '<h3 class="product-title"><a href="' . get_permalink() . '">' . $title . '</a></h3>';

        // Выводим состояние товара и цену в одну строку
        echo '<div class="product-condition-price">';
        if ($condition) {
            echo '<p class="product-condition" style="flex-grow: 1;">' . $condition . '</p>';
        }
        echo '<p class="product-price" style="' . $price_style . '">Цена: <span id="price-' . $product_id . '">' . $price . '</span> ₸</p>';
        echo '</div>';

        // Контейнер для сообщения об актуальности цен
        echo '<div class="price-note-container" style="margin-top: 0; padding-top: 0; border-top: 1px solid #fff;">';
       //   echo '<p class="price-note">*Актуальные цены уточняйте у менеджеров</p>';
        echo '</div>';

        // Кнопка "Купить" после всех элементов карточки
        echo '<div class="buy-button-container" style="text-align: right; margin-top: 10px;">';
        echo '<a href="' . esc_url($product->add_to_cart_url()) . '" class="single_add_to_cart_button elementor-button button wp-element-button">Добавить в корзину</a>';
        echo '</div>';

        echo '</div>'; // Закрываем product-info

        echo '</div>'; // Закрываем custom-product-item
    }

    echo '</div>'; // Закрываем custom-product-list
 
    wp_reset_postdata();
    return ob_get_clean();
}

add_shortcode('custom_product_list', 'custom_product_list_shortcode');