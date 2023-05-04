<?php
use App\Models\Chapter;
use App\Models\Manga;
use App\Models\Plugin;
use App\Plugins\BasePlugin;

class MangadexPlugin extends BasePlugin {
    function __construct() {
        $this->info = new Plugin(
            "mangadex",
            "MangaDex",
            "1.0.0",
            "https://mangadex.org",
            "MangaDex plugin",
            "/icons/mangadex.svg",
            ["Pablo Ferreiro"]
        );
    }

    protected string $baseUrl = "https://api.mangadex.org";

    /**
     * @return Manga[] List of mangas
     */
    public function catalog(string $term, int $limit = 10, int $offset = 0): array {
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
            $cover = $this->_getCoverUrl($id, $manga->relationships);
            return new Manga($manga->id, $manga->attributes->title->en, $description, $cover);
        }, $res->data->data);

        return $mangas;
    }

    public function manga(string $id): Manga {
        $res = $this->fetch('/manga/' . $id, true, 'GET', [
            "includes[]" => "cover_art"
        ]);

        $data = $res->data->data;

        $description = $data->attributes->description->en ?? '';
        $cover = $this->_getCoverUrl($data->id, $data->relationships);
        return new Manga($data->id, $data->attributes->title->en, $description, $cover);
    }

    /**
     * @return Chapter[] List of chapters
     */
    public function chapters(string $id, int $limit = 10, int $offset = 0): array {
        $chapters = [];

        $res = $this->fetch('/manga/' . $id . '/feed', true, 'GET', [
            "limit" => $limit,
            "offset" => $offset,
            "includes[]" => "scanlation_group",
            "includeEmptyPages" => 0,
            "includeExternalUrl" => 0,
            "includeFuturePublishAt" => 0,
            "translatedLanguage" => ["en"],
            "order[readableAt]" => "desc"
        ]);

        $chapters = array_map(function (object $chapter) {
            $scanlator = $this->_getScanlator($chapter->relationships);
            return new Chapter($chapter->id, $chapter->attributes->title, $chapter->attributes->chapter, $chapter->attributes->volume, $chapter->attributes->translatedLanguage, $scanlator);
        }, $res->data->data);

        return $chapters;
    }

    /**
     * return string[] List of pages
     */
    public function pages(string $id): array {
        $pages = [];

        $res = $this->fetch('/at-home/server/' . $id, true);

        $baseUrl = $res->data->baseUrl;
        $hash = $res->data->chapter->hash;

        $pages = array_map(function (string $page) use ($baseUrl, $hash) {
            return $baseUrl . "/data/" . $hash . "/" . $page;
        }, $res->data->chapter->data);

        return $pages;
    }

    private function _getCoverUrl(string $id, array $relationships): string {
        $cover = '';
        $i = 0;
        $found = false;
        while (!$found && $i < count($relationships)) {
            if ($relationships[$i]->type === "cover_art" && isset($relationships[$i]->attributes)) {
                $found = true;
                $filename = $relationships[$i]->attributes->fileName;
                $cover = "https://uploads.mangadex.org/covers/$id/$filename";
            }
            $i++;
        }
        return $cover;
    }

    private function _getScanlator(array $relationships): string {
        $scanlator = '';
        $i = 0;
        $found = false;
        while (!$found && $i < count($relationships)) {
            if ($relationships[$i]->type === "scanlation_group" && isset($relationships[$i]->attributes)) {
                $found = true;
                $scanlator = $relationships[$i]->attributes->name;
            }
            $i++;
        }
        return $scanlator;
    }
}

return MangadexPlugin::class;
