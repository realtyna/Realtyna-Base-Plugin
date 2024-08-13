<?php

namespace Realtyna\BasePlugin\Components\Test;

use Realtyna\BasePlugin\Components\Test\AdminPages\TestAdminPage;
use Realtyna\BasePlugin\Components\Test\PostTypes\TestPostType;
use Realtyna\BasePlugin\Components\Test\SubComponents\TestSubComponent;
use Realtyna\Core\Abstracts\ComponentAbstract;

class TestComponent extends ComponentAbstract
{

    public function register(): void
    {
        // TODO: Implement register() method.
    }
    public function postTypes(): void
    {
        $this->addPostType(TestPostType::class);
    }

    public function subComponents(): void
    {
        $this->addSubComponent(TestSubComponent::class);
    }

    public function adminPages(): void
    {
        $this->addAdminPage(TestAdminPage::class);
    }


}