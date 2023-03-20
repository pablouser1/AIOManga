<?php
namespace App;

use App\Models\Response;
use App\Plugins\PluginHandler;

class Api {
    public static function plugins() {
        $plugins = PluginHandler::getPlugins();
        return new Response(200, $plugins);
    }

    public static function search(string $id) {
        $plugin = PluginHandler::getPlugin($id);

        if (!$plugin) {
            return new Response(404, [], "Plugin not found");
        }

        $res = $plugin->search($_GET['term'] ?? '');
        return new Response(200, $res);
    }
}
