<?php 

namespace App\Models\View;

class View
{
    public string $title;
    private $httpcodes = [
            200 => '200 OK',
            201 => '201 Created',
            204 => '204 No Content',
            400 => '400 Bad Request',
            401 => '401 Unauthorized',
            403 => '403 Forbidden',
            404 => '404 Not Found',
            500 => '500 Internal Server Error',
    ];
    public int $http;
    public array $data;

    public function __construct(int $http, string $title, array $data = [])
    {
        $this->title = $title;
        $this->data = $data;

        if(in_array($http, $this->httpcodes)) {
            $this->http = $http;
        } else {
            $this->http = 500;
        }
    }

    public function toArray(): array
    {
        return [
            'title'=> $this->title,
            'data'=> $this->data,
            'http'=> $this->http,
        ];
    }
}