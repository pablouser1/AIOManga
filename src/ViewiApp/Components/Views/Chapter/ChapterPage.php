<?php
namespace Components\Views\Chapter;

use App\Models\Response;
use Viewi\BaseComponent;
use Viewi\Common\HttpClient;

class ChapterPage extends BaseComponent {
    public string $title = 'Chapter';
    public array $pages;
    public bool $loading = true;
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
        $this->http->get("/api/plugins/" . $this->pluginId . '/manga/' . $this->mangaId . '/chapter/' . $this->chapterId)->then(
            function (Response $res) {
                $this->pages = $res->data;
                $this->loading = false;
            },
            function ($error) {
                $this->loading = false;
            }
        );
    }
}
