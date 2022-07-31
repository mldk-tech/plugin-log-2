<?php

function log2_register() {
    $labels = array(
        'name' => __('Logs2', LOG2_PLUGIN_URL),
        'singular_name' => __('Logs2', LOG2_PLUGIN_URL),
        'archives' => __('Logs2 Directory', LOG2_PLUGIN_URL),
        'add_new' => __('Add New Log2', LOG2_PLUGIN_URL),
        'add_new_item' => __('Add New Log2 Item', LOG2_PLUGIN_URL),
        'filter_items_list' => __('Filter Logs2', LOG2_PLUGIN_URL),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => 'log2',
        'rewrite' => array('has_front' => true),
        'menu_icon' => 'dashicons-welcome-view-site',
        'supports' => array('title', 'editor', 'author'),
        'show_in_rest' => true,
        'pages' => true,
        'capabilities' => array(
			    'create_posts'	=> 'do_not_allow'
		    ),
        

        
    );

    register_post_type('log2', $args);
}