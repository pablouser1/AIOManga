<?php
namespace App\Plugins;

class PluginHandler {
    /**
     * @return BasePlugin[] All plugins available
     */
    static public function getPlugins(): array {
        $plugins = [];
        $pluginPaths = glob(__DIR__ . '/../../plugins/*.php');
        foreach ($pluginPaths as $pluginPath) {
            $plugin = include $pluginPath;
            $plugins[] = new $plugin();
        }
        return $plugins;
    }

    static public function getPlugin(string $id): ?BasePlugin {
        if (ctype_alnum($id)) {
            $pluginPath = __DIR__ . '/../../plugins/' . $id . '.php';
            if (file_exists($pluginPath)) {
                $plugin = include $pluginPath;
                return new $plugin(); 
            }
        }
        return null;
    }
}
