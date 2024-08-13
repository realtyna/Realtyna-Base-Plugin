<?php

namespace Realtyna\Core;

use Realtyna\Core\Abstracts\AdminPageAbstract;
use Realtyna\Core\Abstracts\ComponentAbstract;
use Realtyna\Core\Utilities\App;
use Realtyna\Core\Utilities\Container;

abstract class StartUp
{
    private Config $config;
    protected Container $container;
    private array $components = [];
    private array $adminPages = [];

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->container = new Container();

        $this->boot();
        $this->setting();
        $this->registerSettings();

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

    public function addAdminPage(string $adminPage): void
    {
        $this->adminPages[] = $adminPage;
    }

    /**
     * @throws \ReflectionException
     */
    private function registerSettings(): void
    {
        foreach ($this->adminPages as $adminPage) {
            $service = $this->container->get($adminPage);
            if ($service instanceof AdminPageAbstract && method_exists($service, 'register')) {
                $service->register();
            }
        }
    }

    abstract protected function boot(): void;
    abstract protected function components(): void;
    abstract protected function setting(): void;
}
