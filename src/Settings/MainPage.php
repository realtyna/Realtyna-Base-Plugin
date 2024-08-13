<?php

namespace Realtyna\BasePlugin\Settings;

use Realtyna\Core\Abstracts\AdminPageAbstract;

class MainPage extends AdminPageAbstract
{
    /**
     * Get the page title.
     *
     * @return string
     */
    protected function getPageTitle(): string
    {
        return 'Main Plugin Settings';
    }

    /**
     * Get the menu title.
     *
     * @return string
     */
    protected function getMenuTitle(): string
    {
        return 'Main Plugin';
    }

    /**
     * Get the required capability.
     *
     * @return string
     */
    protected function getCapability(): string
    {
        return 'manage_options';
    }

    /**
     * Get the menu slug.
     *
     * @return string
     */
    protected function getMenuSlug(): string
    {
        return 'main-plugin-settings';
    }

    /**
     * Get the template file for the page.
     *
     * @return string
     */
    protected function getPageTemplate(): string
    {
        return REALTYNA_BASE_PLUGIN_DIR . 'templates/admin/main-page.php';
    }

    /**
     * Enqueue styles and scripts for the admin page.
     *
     * @return void
     */
    protected function enqueuePageAssets(): void
    {
        wp_enqueue_style('main-plugin-admin', plugins_url('assets/css/main-admin-style.css', __FILE__));
        wp_enqueue_script('main-plugin-admin', plugins_url('assets/js/main-admin-script.js', __FILE__), ['jquery'], null, true);
    }
}
