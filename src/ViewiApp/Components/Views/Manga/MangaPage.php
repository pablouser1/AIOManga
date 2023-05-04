<?php
namespace Components\Views\Manga;

use App\Models\Manga;
use App\Models\Response;
use Viewi\BaseComponent;
use Viewi\Common\HttpClient;

class MangaPage extends BaseComponent {
    public string $title = 'Manga';
    public Manga $manga;
    public array $chapters;
    public bool $loading = true;
    private HttpClient $http;
    public string $pluginId;
    public string $mangaId;

    function __init(HttpClient $http, string $pluginId, string $mangaId) {
        $this->http = $http;
        $this->pluginId = $pluginId;
        $this->mangaId = $mangaId;
    }

    function __rendered() {
        $this->http->get("/api/v1/plugins/" . $this->pluginId . '/manga/' . $this->mangaId)->then(
            function (Response $res) {
                $this->manga = $res->data;
                $this->title = $this->manga->name;
                $this->loading = false;
            },
            function ($error) {
                $this->loading = false;
            }
        );

        $this->http->get("/api/v1/plugins/" . $this->pluginId . '/manga/' . $this->mangaId . '/chapters')->then(
            function (Response $res) {
                $this->chapters = $res->data;
                $this->loading = false;
            },
            function ($error) {
                $this->loading = false;
            }
        );
    }
}
