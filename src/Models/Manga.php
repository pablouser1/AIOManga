<?php
namespace App\Models;

class Manga {
    public string $id;
    public string $name;
    public string $description;
    public string $cover;

    public function __construct(string $id, string $name, string $description = "", string $cover = "") {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->cover = $cover;
    }
}
