<?php
namespace App\Plugins;

use App\Models\Plugin;
use App\Models\ScrapeResponse;
use Deemon47\UserAgent;

abstract class BasePlugin implements IPlugin, \JsonSerializable {
    public Plugin $info;

    protected string $baseUrl;

    protected function fetch(string $endpoint, bool $json, string $method = 'GET', array $query = [], array $headers = [], array $body = []) {
        $useragent = (new UserAgent())->generate('windows');
        $url = $this->baseUrl . $endpoint;
        $ch = curl_init();

        if (!empty($query)) {
            $url .= '?' . http_build_query($query);
        }

        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        if ($method === "POST") {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        }

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_USERAGENT => $useragent
        ]);

        $data = curl_exec($ch);
        // $err = curl_errno($ch);
        $code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);

        return new ScrapeResponse($code, $json ? json_decode($data) : $data);
    }

    public function jsonSerialize() {
        return $this->info;
    }
}
