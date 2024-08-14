<?php

namespace Realtyna\BasePlugin;

use Realtyna\BasePlugin\Boot\App;
use Realtyna\BasePlugin\Boot\Log;
use Realtyna\BasePlugin\Components\Test\TestComponent;
use Realtyna\BasePlugin\Database\CreateTestTable;
use Realtyna\BasePlugin\Settings\MainPage;
use Realtyna\BasePlugin\Settings\Settings;
use Realtyna\Core\StartUp;


class Main extends StartUp
{


    protected function components(): void
    {
        $this->addComponent(TestComponent::class);
    }

    protected function adminPages(): void
    {
//        $this->addAdminPage(MainPage::class);
    }

    protected function boot(): void
    {
        // Set the container in the App class for global access.
        App::setContainer($this->container);
        if($this->config->get('log.active')){
            Log::init($this->config->get('log.path'), $this->config->get('log.level'));
        }
    }

    /**
     * Check plugin requirements before activation.
     *
     * @return bool True if requirements are met, false otherwise.
     */
    public function requirements(): bool
    {
        return false;
    }

    /**
     */
    public function activation(): void
    {
        $this->migrate();
    }

    public function deactivation()
    {
    }

    public static function uninstallation(): void
    {
        Settings::delete_settings();
        self::rollback();
    }

    protected function migrations(): void
    {
        $this->addMigration(CreateTestTable::class);
    }
}