<?php
namespace ZeZfDoctrineExtensions;

use ZeDoctrineExtensions\Utils as ZeDoctrineExtensionsUtilts;
use Laminas\ModuleManager\ModuleManager;
use Laminas\ModuleManager\ModuleEvent;

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
        if (isset($config['ze_zf_doctrine_extensions']['oracle_doctrine_driver_config_key'])) {
            $configKey = $config['ze_zf_doctrine_extensions']['oracle_doctrine_driver_config_key'];
            //Get existing map (if any) to be merged with the module map
            if (isset($config['doctrine']['configuration'][$configKey])) {
                $existingMap = $config['doctrine']['configuration'][$configKey];
            } else {
                $existingMap = array();
            }
            
            $config['doctrine']['configuration'][$configKey] = array_merge_recursive(
                $existingMap,
                ZeDoctrineExtensionsUtilts::getOracleDQLFunctions()
            );
        }

        // Modify the configuration; here, we'll add MySQL Custom DQL Functions:
        if (isset($config['ze_zf_doctrine_extensions']['mysql_doctrine_driver_config_key'])) {
            $configKey = $config['ze_zf_doctrine_extensions']['mysql_doctrine_driver_config_key'];
            //Get existing map (if any) to be merged with the module map
            if (isset($config['doctrine']['configuration'][$configKey])) {
                $existingMap = $config['doctrine']['configuration'][$configKey];
            } else {
                $existingMap = array();
            }
            
            $config['doctrine']['configuration'][$configKey] = array_merge_recursive(
                $existingMap,
                ZeDoctrineExtensionsUtilts::getMysqlDQLFunctions()
            );
        }

        // Pass the changed configuration back to the listener:
        $configListener->setMergedConfig($config);
    }
}
