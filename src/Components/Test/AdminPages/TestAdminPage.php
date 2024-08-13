<?php

namespace Realtyna\BasePlugin\Components\Test\AdminPages;

use Realtyna\Core\Abstracts\AdminPageAbstract;

class TestAdminPage extends AdminPageAbstract
{
    /**
     * Get the title of the admin page.
     *
     * @return string
     */
    protected function getPageTitle(): string
    {
        return __('Test Admin Page', 'text-domain');
    }

    /**
     * Get the title of the menu item.
     *
     * @return string
     */
    protected function getMenuTitle(): string
    {
        return __('Tests', 'text-domain');
    }

    /**
     * Get the capability required to access the admin page.
     *
     * @return string
     */
    protected function getCapability(): string
    {
        return 'manage_options';
    }

    /**
     * Get the slug for the admin page.
     *
     * @return string
     */
    protected function getMenuSlug(): string
    {
        return 'test-admin-page';
    }

    /**
     * Get the template file for the admin page.
     *
     * @return string
     */
    protected function getPageTemplate(): string
    {
        return REALTYNA_BASE_PLUGIN_DIR . 'templates/admin/test-admin-page.php';
    }

    /**
     * Enqueue the styles and scripts specific to the admin page.
     *
     * @return void
     */
    protected function enqueuePageAssets(): void
    {
    }

    /**
     * Determine if the page is a submenu.
     *
     * @return bool
     */
    protected function isSubmenu(): bool
    {
        return false; // Set to true if this is a submenu
    }

    /**
     * Get the parent slug for the submenu.
     *
     * @return string
     */
    protected function getParentSlug(): string
    {
        return ''; // Set the parent slug if this is a submenu
    }

    /**
     * Get the icon URL for the menu.
     *
     * @return string
     */
    protected function getIconUrl(): string
    {
        return 'dashicons-admin-tools'; // Set your desired icon
    }

    /**
     * Get the position of the menu item.
     *
     * @return int
     */
    protected function getPosition(): int
    {
        return 20; // Set the position in the admin menu
    }
}
