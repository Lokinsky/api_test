<?php


namespace App\Response;


class Response
{
    private $data;
    private $headers;

    public function __construct($data, $headers = [])
    {
        $this->data = $data;
        $this->headers = empty($headers) ? [
            'Cache-Control: no-cache, must-revalidate',
            'Expires: ' . date('D, d M Y h:i:s').' GMT',
            'Content-type: application/json',
        ] : $headers;
    }

    public function send()
    {
        foreach ($this->headers as $header) {
            header($header);
        }
        echo json_encode($this->data);
    }
}