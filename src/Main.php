<?php

namespace Realtyna\BasePlugin;

use Realtyna\BasePlugin\Components\TestComponent;
use Realtyna\Core\StartUp;

class Main extends StartUp
{


    protected function components(): void
    {
        $this->addComponent(TestComponent::class);
    }

    protected function setting(): void
    {
        // TODO: Implement setting() method.
    }
}