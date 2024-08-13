<?php

namespace Realtyna\Core;

use Realtyna\Core\Abstracts\ComponentAbstract;
use Realtyna\Core\Utilities\App;
use Realtyna\Core\Utilities\Container;

abstract class StartUp
{
    private Config $config;
    protected Container $container;
    private array $components = [];

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->container = new Container();

        // Set the container in the App class for global access.
        App::setContainer($this->container);

        $this->components();
        $this->registerComponents();
    }

    public function addComponent(string $component): void
    {
        $this->components[] = $component;
    }

    private function registerComponents(): void
    {
        foreach ($this->components as $component) {
            $service = $this->container->get($component);
            if ($service instanceof ComponentAbstract && method_exists($service, 'register')) {
                $service->register();
            }
        }
    }

    abstract protected function components(): void;
    abstract protected function setting(): void;
}
