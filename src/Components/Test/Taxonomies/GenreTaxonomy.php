<?php

namespace Realtyna\BasePlugin\Components\Test\Taxonomies;

use Realtyna\Core\Abstracts\CustomTaxonomyAbstract;

class GenreTaxonomy extends CustomTaxonomyAbstract
{

    /**
     * Get the taxonomy slug.
     *
     * @return string
     */
    protected function getTaxonomySlug(): string
    {
        return 'genre';
    }

    /**
     * Get the post types that the taxonomy applies to.
     *
     * @return array
     */
    protected function getPostTypes(): array
    {
        return ['test']; // Example post types
    }

    /**
     * Get the arguments for registering the taxonomy.
     *
     * @return array
     */
    protected function getTaxonomyArgs(): array
    {
        return [
            'labels'            => $this->getTaxonomyLabels(),
            'hierarchical'      => true,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => ['slug' => 'genre'],
        ];
    }

    /**
     * Get the labels for the taxonomy.
     *
     * @return array
     */
    protected function getTaxonomyLabels(): array
    {
        return [
            'name'              => _x('Genres', 'taxonomy general name', 'text-domain'),
            'singular_name'     => _x('Genre', 'taxonomy singular name', 'text-domain'),
            'search_items'      => __('Search Genres', 'text-domain'),
            'all_items'         => __('All Genres', 'text-domain'),
            'parent_item'       => __('Parent Genre', 'text-domain'),
            'parent_item_colon' => __('Parent Genre:', 'text-domain'),
            'edit_item'         => __('Edit Genre', 'text-domain'),
            'update_item'       => __('Update Genre', 'text-domain'),
            'add_new_item'      => __('Add New Genre', 'text-domain'),
            'new_item_name'     => __('New Genre Name', 'text-domain'),
            'menu_name'         => __('Genre', 'text-domain'),
        ];
    }
}
