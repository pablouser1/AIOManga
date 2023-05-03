<?php
namespace App\Models;

class Chapter {
    public string $id;
    public string $name;
    public ?string $chapNum;
    public ?string $volNum;
    public string $lang;
    public string $scanlator;

    public function __construct(string $id, string $name, ?string $chapNum, ?string $volNum, string $lang, string $scanlator = "") {
        $this->id = $id;
        $this->name = $name;
        $this->chapNum = $chapNum;
        $this->volNum = $volNum;
        $this->lang = $lang;
        $this->scanlator = $scanlator;
    }
}
