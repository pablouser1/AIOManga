<?php
namespace App;

use App\Models\Response;
use App\Plugins\PluginHandler;

class Api {
    public static function plugins(): Response {
        $plugins = PluginHandler::getPlugins();
        return new Response(200, $plugins);
    }

    public static function catalog(string $id): Response {
        $plugin = PluginHandler::getPlugin($id);

        if (!$plugin) {
            return new Response(404, [], "Plugin not found");
        }

        $res = $plugin->catalog($_GET['term'] ?? '');
        return new Response(200, $res);
    }

    public static function manga(string $pluginId, string $mangaId): Response {
        $plugin = PluginHandler::getPlugin($pluginId);

        if (!$plugin) {
            return new Response(404, [], "Plugin not found");
        }

        $res = $plugin->manga($mangaId);
        return new Response(200, $res);
    }

    public static function chapters(string $pluginId, string $mangaId): Response {
        $plugin = PluginHandler::getPlugin($pluginId);

        if (!$plugin) {
            return new Response(404, [], "Plugin not found");
        }

        $res = $plugin->chapters($mangaId);
        return new Response(200, $res);
    }

    public static function pages(string $pluginId, string $mangaId, string $chapterId): Response {
        $plugin = PluginHandler::getPlugin($pluginId);

        if (!$plugin) {
            return new Response(404, [], "Plugin not found");
        }

        $res = $plugin->pages($chapterId);
        return new Response(200, $res);
    }
}
