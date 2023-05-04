<?php
namespace Components\Views\Home;

use App\Models\Response;
use Viewi\BaseComponent;
use Viewi\Common\HttpClient;

class HomePage extends BaseComponent {
    public string $title = 'Home';
    public array $plugins = [];
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
}
