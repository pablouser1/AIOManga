<?php
namespace App\Plugins;

use App\Models\Manga;

interface IPlugin {
    /**
     * @return Manga[] List of mangas
     */
    public function catalog(string $term, int $count = 10, int $offset = 0): array;
    
    public function manga(string $id): Manga;

    /**
     * @return Chapter[] List of chapters
     */
    public function chapters(string $id, int $limit = 10, int $offset = 0): array;

    public function pages(string $id): array;
}
