<?php

namespace Realtyna\BasePlugin\Components;

use Realtyna\Core\Abstracts\ComponentAbstract;

class TestComponent extends ComponentAbstract
{

    public function register()
    {
        add_action('init', function (){
            return true;
        });
    }
}