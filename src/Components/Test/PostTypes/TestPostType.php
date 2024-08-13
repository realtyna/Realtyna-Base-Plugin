<?php

namespace Realtyna\BasePlugin\Components\Test\PostTypes;

use Realtyna\Core\Abstracts\PostTypeAbstract;

class TestPostType extends PostTypeAbstract
{
    protected function definePostType(): string
    {
        return 'test';
    }

    protected function modifyArgs(array $args): array
    {
        $args['labels'] = [
            'name'               => __('Tests', 'text-domain'),
            'singular_name'      => __('Test', 'text-domain'),
            'menu_name'          => __('Tests', 'text-domain'),
            'name_admin_bar'     => __('Test', 'text-domain'),
            'add_new'            => __('Add New', 'text-domain'),
            'add_new_item'       => __('Add New Test', 'text-domain'),
            'new_item'           => __('New Test', 'text-domain'),
            'edit_item'          => __('Edit Test', 'text-domain'),
            'view_item'          => __('View Test', 'text-domain'),
            'all_items'          => __('All Tests', 'text-domain'),
            'search_items'       => __('Search Tests', 'text-domain'),
            'not_found'          => __('No tests found.', 'text-domain'),
            'not_found_in_trash' => __('No tests found in Trash.', 'text-domain'),
        ];

        $args['supports'] = ['title', 'editor', 'thumbnail', 'custom-fields'];
        $args['menu_icon'] = 'dashicons-admin-tools';

        return $args;
    }
}
