<?php
namespace App\Models;

/**
 * API Response
 */
class ScrapeResponse {
    public int $status;
    public bool $success;
    public $data;

    function __construct(int $status, $data) {
        $this->status = $status;
        $this->success = $status >= 200 && $status < 400;
        $this->data = $data;
    }
}
