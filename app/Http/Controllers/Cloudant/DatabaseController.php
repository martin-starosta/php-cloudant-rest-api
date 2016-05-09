<?php
namespace App\Http\Controllers\Cloudant;


use App\Http\Controllers\CloudantController;

class DatabaseController extends CloudantController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function listDatabases() {
        try {
            $response = $this->client->get('/_all_dbs', [
                'verify' => false
            ]);
            $data = $response->getBody()->getContents();

            return $data;
        } catch (RequestException $e) {
            echo $e->getRequest();
            if ($e->hasResponse()) {
                echo $e->getResponse();
            }
        }
    }
}