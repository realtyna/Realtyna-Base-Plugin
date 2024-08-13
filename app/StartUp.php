<?php

namespace Realtyna\Core;

use Realtyna\Core\Abstracts\ComponentAbstract;
use Realtyna\Core\Utilities\Container;

defined('ABSPATH') || exit('No direct script access allowed');

abstract class StartUp
{
    private Config $config;
    protected Container $container;
    private array $components = [];

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->container = new Container();
        $this->components(); // Call to bind components
        $this->registerComponents(); // Register all bound components
    }

    /**
     * Adds a component class to the list of components to be registered.
     *
     * @param string $component
     */
    public function addComponent(string $component): void
    {
        $this->components[] = $component;
    }

    /**
     * Registers all components that were added using the addComponent method.
     */
    private function registerComponents(): void
    {
        foreach ($this->components as $component) {
            $service = $this->container->get($component);
            if ($service instanceof ComponentAbstract && method_exists($service, 'register')) {
                $service->register();
            }
        }
    }

    /**
     * Abstract method to bind components to the container.
     * This method must be implemented by the extending class.
     */
    abstract protected function components(): void;

    /**
     * Abstract method to handle plugin settings.
     * This method must be implemented by the extending class.
     */
    abstract protected function setting(): void;
}
