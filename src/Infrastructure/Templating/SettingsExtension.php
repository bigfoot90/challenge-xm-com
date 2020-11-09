<?php

namespace Infrastructure\Templating;

use Infrastructure\SettingsPool;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class SettingsExtension extends AbstractExtension
{
    private SettingsPool $pool;

    public function __construct(SettingsPool $pool)
    {
        $this->pool = $pool;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('setting', [$this, 'getSetting']),
        ];
    }

    public function getSetting(string $name)
    {
        return $this->pool->get($name);
    }
}
