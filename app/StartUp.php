<?php
namespace Realtyna\Core;

use Realtyna\Core\Interfaces\ComponentInterface;

defined('ABSPATH') || exit('No direct script access allowed');
abstract class StartUp
{
    private Config $config;
    private array $components;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function addComponent(ComponentInterface $component): void
    {
        $this->components[] = $component;
    }


    abstract protected function components();
    abstract protected function setting();

}