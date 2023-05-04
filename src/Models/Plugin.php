<?php
namespace App\Models;

/**
 * Plugin info
 */
class Plugin {
    public string $id;
    public string $name;
    public string $version;
    public string $website;
    public string $description = "";
    public string $icon = "";
    public array $authors = [];

    public function __construct(string $id, string $name, string $version, string $website, string $description = "", string $icon = "", array $authors = []) {
        $this->id = $id;
        $this->name = $name;
        $this->version = $version;
        $this->website = $website;
        $this->description = $description;
        $this->icon = $icon;
        $this->authors = $authors;
    }
}
