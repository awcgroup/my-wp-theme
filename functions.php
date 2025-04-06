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
// Регистрируем и подключаем стили/скрипты для акционных товаров
function sale_products_assets() {
    // Проверяем, нужно ли подключать наши стили на этой странице
    if (is_page() || is_shop() || is_product_category()) {
        // Регистрируем стили
        wp_register_style(
            'sale-products-style',
            get_template_directory_uri() . '/css/sale-products.css',
            array(),
            filemtime(get_template_directory() . '/css/sale-products.css')
        );
        
        // Регистрируем скрипт
        wp_register_script(
            'sale-products-scroll',
            get_template_directory_uri() . '/js/scroll.js',
            array('jquery'),
            filemtime(get_template_directory() . '/js/scroll.js'),
            true
        );
        
        // Подключаем стили и скрипты
        wp_enqueue_style('sale-products-style');
        wp_enqueue_script('sale-products-scroll');
    }
}
add_action('wp_enqueue_scripts', 'sale_products_assets');
 
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

//подключениее new.css только на шаблонах категории, товара и поиска
function enqueue_custom_styles() {
    if (is_product_category() || is_single() || is_search() ||is_page()) {
        wp_enqueue_style('custom-category-styles', get_template_directory_uri() . '/css/new.css');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');
 
function enqueue_search_styles() {
    if (is_search()) {
        wp_enqueue_style('search-styles', get_template_directory_uri() . '/css/new.css', array(), filemtime(get_template_directory() . '/css/new.css'));
    }
}
add_action('wp_enqueue_scripts', 'enqueue_search_styles');

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

function custom_woocommerce_search_template($template) {
    if (is_search() && get_query_var('post_type') === 'product') {
        $new_template = locate_template('woocommerce-search.php');
        if (!empty($new_template)) {
            return $new_template;
        }
    }
    return $template;
}
add_filter('template_include', 'custom_woocommerce_search_template');

//функция поиска только по товарам
function custom_search_filter( $query ) {
    if ( $query->is_search && !is_admin() && $query->get('s') ) {
        // Ограничиваем поиск только постами типа 'product' (товары WooCommerce)
        $query->set( 'post_type', 'product' );
    }
    return $query;
}
add_action( 'pre_get_posts', 'custom_search_filter' );

//очистить параметр в поисковой строке
function remove_e_search_props_from_url( $url ) {
    // Удаляем параметр e_search_props из URL
    $url = remove_query_arg( 'e_search_props', $url );
    return $url;
}
add_filter( 'redirect_canonical', 'remove_e_search_props_from_url' );

//вывод категорий при поиске только тех чьи товары найдены
function display_custom_product_categories() {
    $args = array(
        'taxonomy' => 'product_cat',
        'hide_empty' => true,
        'parent' => 0 // Только родительские категории
    );
    
    $categories = get_terms($args);
    
    if ($categories && !is_wp_error($categories)) {
        $output = '<div class="custom-category-sidebar">';
        $output .= '<h3 class="custom-category-title">Категории</h3>';
        $output .= '<ul class="category-list">';
        
        foreach ($categories as $category) {
            $category_link = get_term_link($category);
            $output .= '<li class="category-item"><a href="' . esc_url($category_link) . '" class="category-link">' . esc_html($category->name) . '</a>';
            
            // Получаем дочерние категории
            $child_args = array(
                'taxonomy' => 'product_cat',
                'hide_empty' => true,
                'parent' => $category->term_id
            );
            
            $child_categories = get_terms($child_args);
            
            if ($child_categories && !is_wp_error($child_categories)) {
                $output .= '<ul class="custom-child-categories">';
                foreach ($child_categories as $child) {
                    $child_link = get_term_link($child);
                    $output .= '<li><a href="' . esc_url($child_link) . '">' . esc_html($child->name) . '</a></li>';
                }
                $output .= '</ul>';
            }
            
            $output .= '</li>';
        }
        
        $output .= '</ul>';
        $output .= '</div>';
        
        return $output;
    }
    
    return '';
}

// Создаем шорткод для использования в Elementor
add_shortcode('custom_product_categories', 'display_custom_product_categories');

//вывод найденных товаров по одному в строке
function custom_search_products_output() {
    ob_start();
    
    // Получаем текущий запрос WooCommerce
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        's' => get_search_query()
    );
    
    $products = new WP_Query($args);
    
    echo '<div class="custom-product-list">';
    
    while ($products->have_posts()) {
        $products->the_post();
        global $product;
        
        $title = get_the_title();
        $price = $product->get_price();
        $condition = '';
        
        // Определяем состояние товара
        if (preg_match('/\bнов(ый|ая|ые|ое)\b/ui', $title)) {
            $condition = 'ТОВАР: НОВЫЙ';
        } elseif (preg_match('/\bб\/у\b/ui', $title)) {
            $condition = 'ТОВАР: Б/У';
        }
        
        $product_id = $product->get_id();

        // Определяем стиль для выравнивания цены
        $price_style = 'text-align: right;'; // По умолчанию выравнивание по правому краю

        // Если в заголовке есть слово "новый", "новая", "новые" или "Б/У", меняем выравнивание цены
        if (preg_match('/\bнов(ый|ая|ые|ое)\b/ui', $title) || preg_match('/\bб\/у\b/ui', $title)) {
            $price_style = 'text-align: left;'; // Изменяем выравнивание, если товар новый или Б/У
        }
        
        echo '<div class="custom-product-item" style="border: 1px solid #fff; padding: 15px; box-sizing: border-box;">';
        
        // Блок изображения
        echo '<div class="product-image">';
        echo '<a href="' . get_permalink() . '">' . woocommerce_get_product_thumbnail('thumbnail') . '</a>';
        echo '</div>';
        
        // Блок информации
        echo '<div class="product-info" style="padding: 10px 0;">';
        
        // Название товара
        echo '<h3 class="product-title"><a href="' . get_permalink() . '">' . $title . '</a></h3>';
        
        // Состояние и цена
        echo '<div class="product-condition-price">';
       echo '<span class="product-condition" style="flex-grow: 1;">' . ($condition ? $condition : '&nbsp;') . '</span>';
        echo '<span class="product-price">Цена: ' . wc_price($price) . '</span>';
        echo '</div>';
        
        // Контейнер для сообщения об актуальности цен
        echo '<div class="price-note-container" style="margin-top: 0; padding-top: 0; border-top: 1px solid #fff;">';
       //   echo '<p class="price-note">*Актуальные цены уточняйте у менеджеров</p>';
        echo '</div>';
        
        // Кнопка "Посмотреть" после всех элементов карточки
        echo '<div class="buy-button-container" style="text-align: right; margin-top: 10px;">';
        echo '<a href="' . esc_url(get_permalink($product->get_id())) . '" class="single_add_to_cart_button elementor-button button wp-element-button">Посмотреть</a>';
        echo '</div>';
        
        echo '</div>'; // закрываем search-item-info
        echo '</div>'; // закрываем custom-search-item
    }
    
    echo '</div>'; // закрываем custom-search-results
    
    wp_reset_postdata();
    return ob_get_clean();
}

//Изменяем текст Заголовок Найденные товары * Обновляем заголовок для Elementor
 function custom_elementor_search_title($title) {
    if (is_search() && !is_admin()) {
        global $wp_query;
        $found_posts = $wp_query->found_posts;
        $search_query = get_search_query();
        
        return sprintf(
            '<h1 class="elementor-heading-title elementor-size-default">%s</h1>',
            sprintf(
                __('В каталоге найдено "%s" товаров по запросу "%s"', 'your-text-domain'),
                number_format_i18n($found_posts),
                esc_html($search_query)
            )
        );
    }
    return $title;
}
add_filter('elementor/utils/get_the_archive_title', 'custom_elementor_search_title');

// Создаем шорткод
add_shortcode('custom_search_results', 'custom_search_products_output');

// Удаляем версии у всех стилей
function remove_style_versions($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'remove_style_versions', 9999);

// Удаляем версии стилей WooCommerce
function remove_woocommerce_style_versions($src) {
    if (strpos($src, 'woocommerce') && strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'remove_woocommerce_style_versions', 9999);

 
// Шорткод для вывода акционных товаров
add_shortcode('sale_products', 'display_sale_products');
function display_sale_products() {
    // Принудительно подключаем стили и скрипты, если шорткод используется
    wp_enqueue_style('sale-products-style');
    wp_enqueue_script('sale-products-scroll');
    ob_start();
    ?>
    <div class="sale-products-container">
        <div class="sale-products-scroll">
            <button class="scroll-button prev">‹</button>
            <div class="sale-products-wrapper">
                <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 10,
                    'meta_query' => array(
                        array(
                            'key' => '_sale_price',
                            'value' => 0,
                            'compare' => '>',
                            'type' => 'numeric'
                        )
                    )
                );
                $loop = new WP_Query($args);
                
                if ($loop->have_posts()) {
                    while ($loop->have_posts()) : $loop->the_post();
                        global $product;
                        $regular_price = $product->get_regular_price();
                        $sale_price = $product->get_sale_price();
                        $categories = get_the_terms(get_the_ID(), 'product_cat');
                        ?>
                        <div class="sale-product-card">
                            <?php if ($categories): ?>
                                <a href="<?php echo get_term_link($categories[0]); ?>" class="product-category">
                                    <?php echo esc_html($categories[0]->name); ?>
                                </a>
                            <?php endif; ?>
                            
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium'); ?>
                            </a>
                            
                            <div class="product-prices">
                                <span class="sale-price"><?php echo wc_price($sale_price); ?></span>
                                <?php if ($regular_price): ?>
                                    <span class="regular-price"><?php echo wc_price($regular_price); ?></span>
                                <?php endif; ?>
                            </div>
                            
                            <h3 class="product-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            
                            <button class="add-to-cart-button" 
                                    data-product_id="<?php echo esc_attr($product->get_id()); ?>">
                                В корзину
                            </button>
                        </div>
                    <?php
                    endwhile;
                } else {
                    echo __('No sale products found');
                }
                wp_reset_postdata();
                ?>
            </div>
            <button class="scroll-button next">›</button>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
