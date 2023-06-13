<?php

//  SCRIPTS AND STYLES

    function my_scripts_and_styles()
    {
        if ( ! is_admin() )
        {            
            wp_enqueue_style ( 'theme-styles', get_stylesheet_uri(), '', filemtime ( get_template_directory() . '/style.css' ) );
        }
    }

    add_action ( 'wp_enqueue_scripts', 'my_scripts_and_styles' );

    

    

    //  CUSTOM POST TYPES AND TAXONOMIES

    function my_custom_post_types_and_taxonomies()
    {
        register_post_type ( 'recetas', array
        (
            'public' => true,
            'exclude_from_search' => false,
            'hierarchical' => false,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-format-gallery',
            'supports' => array
            (
                'title',
                'editor',
                'thumbnail',
                'author',
                'revisions'
            ),
            'show_in_rest' => true,
            'labels' => array
            (
                'name' => __( 'Recetas', 'bocaverda' ),
                'singular_name' => __( 'Receta', 'bocaverda' ),
                'add_new' => __( 'Añadir nueva Receta', 'bocaverda' ),
                'add_new_item' => __( 'Añadir nuevas Recetas', 'bocaverda' ),
                'all_items' => __( 'Todas las Receta', 'bocaverda' ),
                'edit_item' => __( 'Editar Recetas', 'bocaverda' ),
                'new_item' => __( 'Nueva Recetas', 'bocaverda' ),
                'view_item' => __( 'Ver Recetas', 'bocaverda' ),
                'search_items' => __( 'Buscar Receta', 'bocaverda' ),
                'not_found' => __( 'No se han encontrado Recetas', 'bocaverda' ),
                'not_found_in_trash' => __( 'No se han encontrado Recetas en la papelera', 'bocaverda' )
            )
        ));

        register_taxonomy ( 'categoria', 'recetas', array
        (
            'show_admin_column' => true,
            'hierarchical' => false,
            'show_in_rest' => true,
            'labels' => array
            (
                'name' => __( 'Categorias', 'bocaverda' ),
                'singular_name' => __( 'Categoria', 'bocaverda' ),
                'search_items' => __( 'Buscar Categorias', 'bocaverda' ),
                'all_items' => __( 'Todas las Categorias', 'bocaverda' ),
                'view_item' => __( 'Ver Categorias', 'bocaverda' ),
                'edit_item' => __( 'Editar Categoria', 'bocaverda' ),
                'update_item' => __( 'Actualizar Categoria', 'bocaverda' ),
                'add_new' => __( 'Añadir nueva Categoria', 'bocaverda' ),
                'add_new_item' => __( 'Añadir nueva Categoria', 'bocaverda' ),
                'new_item_name' => __( 'Nuevo nombre de Categoria', 'bocaverda' ),
                'not_found' => __( 'No se han encontrado Categorias', 'bocaverda' ),
                'back_to_items' => __( 'Volver a Categorias', 'bocaverda' ),
                'menu_name' => __( 'Categorias', 'bocaverda' )
            )
        ));

        register_post_type ( 'productos', array
        (
            'public' => true,
            'exclude_from_search' => false,
            'hierarchical' => false,
            'menu_position' => 6,
            'menu_icon' => 'dashicons-format-gallery',
            'supports' => array
            (
                'title',
                'editor',
                'thumbnail',
                'author',
                'revisions'
            ),
            'show_in_rest' => true,
            'labels' => array
            (
                'name' => __( 'Productos', 'bocaverda' ),
                'singular_name' => __( 'Productos', 'bocaverda' ),
                'add_new' => __( 'Añadir nuevo producto', 'bocaverda' ),
                'add_new_item' => __( 'Añadir nuevo producto', 'bocaverda' ),
                'all_items' => __( 'Todos los producto', 'bocaverda' ),
                'edit_item' => __( 'Editar producto', 'bocaverda' ),
                'new_item' => __( 'Nuevo producto', 'bocaverda' ),
                'view_item' => __( 'Ver productos', 'bocaverda' ),
                'search_items' => __( 'Buscar producto', 'bocaverda' ),
                'not_found' => __( 'No se han encontrado productos', 'bocaverda' ),
                'not_found_in_trash' => __( 'No se han encontrado productos en la papelera', 'bocaverda' )
            )
        ));

        

        register_post_type ( 'Restaurantes', array
        (
            'public' => true,
            'exclude_from_search' => false,
            'hierarchical' => false,
            'menu_position' => 7,
            'menu_icon' => 'dashicons-format-gallery',
            'supports' => array
            (
                'title',
                'editor',
                'thumbnail',
                'author',
                'revisions'
            ),
            'show_in_rest' => true,
            'labels' => array
            (
                'name' => __( 'Restaurantes', 'bocaverda' ),
                'singular_name' => __( 'Restaurantes', 'bocaverda' ),
                'add_new' => __( 'Añadir nuevo restaurante', 'bocaverda' ),
                'add_new_item' => __( 'Añadir nuevo restaurante', 'bocaverda' ),
                'all_items' => __( 'Todos los restaurantes', 'bocaverda' ),
                'edit_item' => __( 'Editar restaurantes', 'bocaverda' ),
                'new_item' => __( 'Nuevo restaurante', 'bocaverda' ),
                'view_item' => __( 'Ver restaurantes', 'bocaverda' ),
                'search_items' => __( 'Buscar restaurantes', 'bocaverda' ),
                'not_found' => __( 'No se han encontrado restaurantes', 'bocaverda' ),
                'not_found_in_trash' => __( 'No se han encontrado restaurantes en la papelera', 'bocaverda' )
            )
        ));
    }

    add_action ( 'init', 'my_custom_post_types_and_taxonomies' );



//  THEME SETUP

    function my_theme_setup()
    {
        remove_theme_support ( 'core-block-patterns' );
    }

    add_action ( 'after_setup_theme', 'my_theme_setup' );



//  GUTENBERG: LOCKING CONTENT FOR NON ADMINS

    function my_gutenberg_locks ( $settings, $context )
    {
        if ( ! current_user_can ( 'activate_plugins' ) )
        {
            $settings[ 'canLockBlocks' ] = false;
            $settings[ 'codeEditingEnabled' ] = false;
        }

        return $settings;
    }

    add_filter ( 'block_editor_settings_all', 'my_gutenberg_locks', 10, 2 );

?>