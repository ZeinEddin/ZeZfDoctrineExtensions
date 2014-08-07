<?php
namespace ZfDoctrineExtensions;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

class Module implements AutoloaderProviderInterface
{
    public function getConfig()
    {
        $config = include __DIR__ . '/config/module.config.php';
        
        return $config;
    }
}
