<?php
namespace App\Plugins;

interface IPlugin {
    /**
     * @return Manga[] List of mangas
     */
    public function search(string $term, int $count = 10, int $offset = 0): array;
}
