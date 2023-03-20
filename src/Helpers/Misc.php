<?php
namespace App\Helpers;

class Misc {
    static public function env(string $key, $default_value) {
        return $_ENV[$key] ?? $default_value;
    }

    static public function debug(): bool {
        $isDebug = self::env('APP_DEBUG', false);
        return $isDebug;
    }
}
