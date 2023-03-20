<?php
namespace App\Models;

/**
 * API Response
 * @todo Add pagination
 */
class Response {
    public int $status;
    public bool $success;
    public string $msg;
    public $data;

    function __construct(int $status, $data, string $msg = "OK") {
        $this->status = $status;
        $this->success = $status >= 200 && $status < 400;
        $this->msg = $msg;
        $this->data = $data;
    }
}
