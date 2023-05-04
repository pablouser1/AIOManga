<?php
namespace Components\Views\Chapter;

use App\Models\Response;
use Viewi\BaseComponent;
use Viewi\Common\HttpClient;
use Viewi\DOM\Events\DOMEvent;

class ChapterPage extends BaseComponent {
    public string $title = 'Chapter';
    public array $pages;
    public bool $loading = true;
    public int $pageIdx = 0;
    private HttpClient $http;
    private string $pluginId;
    private string $mangaId;
    private string $chapterId;

    function __init(HttpClient $http, string $pluginId, string $mangaId, string $chapterId) {
        $this->http = $http;
        $this->pluginId = $pluginId;
        $this->mangaId = $mangaId;
        $this->chapterId = $chapterId;
    }

    function __rendered() {
        $this->http->get("/api/v1/plugins/" . $this->pluginId . '/manga/' . $this->mangaId . '/chapter/' . $this->chapterId)->then(
            function (Response $res) {
                $this->pages = $res->data;
                $this->loading = false;
            },
            function ($error) {
                $this->loading = false;
            }
        );
    }

    public function onKeyDown(DOMEvent $e) {
        if ($e->keyCode === 37) { // left
            $this->changePage($this->pageIdx + 1);
        } elseif ($e->keyCode === 39) { // right
            $this->changePage($this->pageIdx - 1);
        }
    }

    public function changePage(int $index) {
        if (array_key_exists($index, $this->pages)) {
            $this->pageIdx = $index;
        }
    }
}
