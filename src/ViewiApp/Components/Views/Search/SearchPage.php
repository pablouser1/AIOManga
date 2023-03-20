<?php
namespace Components\Views\Search;

use App\Models\Response;
use Viewi\BaseComponent;
use Viewi\Common\HttpClient;

class SearchPage extends BaseComponent {
    public string $title = 'Search';
    public string $term = "";
    public string $chosenPlugin = "";
    public array $plugins = [];
    public array $mangas = [];
    public bool $loading = true;
    private HttpClient $http;

    function __init(HttpClient $http) {
        $this->http = $http;
    }

    function __rendered() {
        $this->http->get("/api/plugins")->then(
            function (Response $res) {
                $this->plugins = $res->data;
                $this->loading = false;
            },
            function ($error) {
                $this->loading = false;
            }
        );
    }

    public function search() {
        $plugin = $this->chosenPlugin;
        $term = $this->term;
        $this->http->get("/api/plugins/" . $plugin . "/search/?term=" . $term)->then(
            function (Response $res) {
                $this->mangas = $res->data;
            },
            function ($error) {
                echo($error);
            }
        );
    }
}
