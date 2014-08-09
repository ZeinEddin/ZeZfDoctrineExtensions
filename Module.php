<?php
namespace ZfDoctrineExtensions;

use DoctrineExtensions\Utils as DoctrineExtensionsUtilts;
use Zend\ModuleManager\ModuleManager;
use Zend\ModuleManager\ModuleEvent;

class Module
{
    public function init(ModuleManager $moduleManager)
    {
        $events = $moduleManager->getEventManager();

        // Registering a listener at default priority, 1, which will trigger
        // after the ConfigListener merges config.
        $events->attach(ModuleEvent::EVENT_MERGE_CONFIG, array($this, 'onMergeConfig'));
    }

    public function onMergeConfig(ModuleEvent $e)
    {
        $configListener = $e->getConfigListener();
        $config         = $configListener->getMergedConfig(false);

        // Modify the configuration; here, we'll add Oracle Custom DQL Functions:
        if (isset($config['zf_doctrine_extensions']['oracle_doctrine_driver_config_key'])) {
            $configKey = $config['zf_doctrine_extensions']['oracle_doctrine_driver_config_key'];
            $config['doctrine']['configuration'][$configKey] =
                DoctrineExtensionsUtilts::getOracleDQLFunctions();
        }

        // Modify the configuration; here, we'll add MySQL Custom DQL Functions:
        if (isset($config['zf_doctrine_extensions']['mysql_doctrine_driver_config_key'])) {
            $configKey = $config['zf_doctrine_extensions']['mysql_doctrine_driver_config_key'];
            $config['doctrine']['configuration'][$configKey] =
                DoctrineExtensionsUtilts::getMysqlDQLFunctions();
        }

        // Pass the changed configuration back to the listener:
        $configListener->setMergedConfig($config);
    }
}