<?php

use App\Models\Manga;
use App\Models\Plugin;
use App\Plugins\BasePlugin;

class MangadexPlugin extends BasePlugin {
    function __construct() {
        $this->info = new Plugin(
            "mangadex",
            "MangaDex",
            "1.0.0",
            "MangaDex plugin",
            "/icons/mangadex.svg",
            ["Pablo Ferreiro"]
        );
    }

    protected string $baseUrl = "https://api.mangadex.org";

    /**
     * @return Manga[] List of mangas
     */
    public function search(string $term, int $limit = 10, int $offset = 0): array {
        $mangas = [];
        $res = $this->fetch('/manga', true, 'GET', [
            "title" => $term,
            "limit" => $limit,
            "offset" => $offset,
            "includes[]" => "cover_art"
        ]);

        $mangas = array_map(function (object $manga) {
            $id = $manga->id;
            $description = $manga->attributes->description->en ?? '';
            $cover = $this->getCoverUrl($id, $manga->relationships);
            return new Manga($manga->id, $manga->attributes->title->en, $description, $cover);
        }, $res->data->data);

        return $mangas;
    }

    private function getCoverUrl(string $id, array $relationships): string {
        $cover = '';
        $i = 0;
        $found = false;
        while (!$found && $i < count($relationships)) {
            if ($relationships[$i]->type === "cover_art") {
                $found = true;
                $filename = $relationships[$i]->attributes->fileName;
                $cover = "https://uploads.mangadex.org/covers/$id/$filename";
            }
            $i++;
        }
        return $cover;
    }
}

return MangadexPlugin::class;
