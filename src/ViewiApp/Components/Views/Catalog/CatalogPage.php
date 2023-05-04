<?php
namespace Components\Views\Catalog;

use App\Models\Response;
use Viewi\BaseComponent;
use Viewi\Common\HttpClient;

class CatalogPage extends BaseComponent {
    public string $title = 'Catalog';
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
        $this->http->get("/api/v1/plugins")->then(
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
        $this->http->get("/api/v1/plugins/" . $plugin . "/catalog?term=" . $term)->then(
            function (Response $res) {
                $this->mangas = $res->data;
            },
            function ($error) {
                echo($error);
            }
        );
    }
}
