<?php

namespace Realtyna\BasePlugin;

use Realtyna\BasePlugin\Boot\App;
use Realtyna\BasePlugin\Components\Test\TestComponent;
use Realtyna\BasePlugin\Settings\MainPage;
use Realtyna\Core\StartUp;

class Main extends StartUp
{


    protected function components(): void
    {
        //WidgetAbstract
        //GutenbergBlockAbstract
        //CustomTaxonomyAbstract
        //CronJobAbstract
        //CustomCapabilityAbstract
        //CustomRewriteRuleAbstract
        $this->addComponent(TestComponent::class);
    }

    protected function adminPages(): void
    {
        $this->addAdminPage(MainPage::class);
    }

    protected function boot(): void
    {
        // Set the container in the App class for global access.
        App::setContainer($this->container);
    }

    public function activation()
    {

    }

    public function deactivation()
    {

    }

    public static function uninstallation()
    {

    }
}