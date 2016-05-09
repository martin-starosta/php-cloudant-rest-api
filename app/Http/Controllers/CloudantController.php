<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 4.5.2016
 * Time: 16:34
 */

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Laravel\Lumen\Routing\Controller;

abstract class CloudantController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->initializeClient();
    }

    public function initializeClient()
    {
        $this->client = new Client([
            'base_uri' => env('CLOUDANT_BASE_URL'),
            'timeout' => 10.0,
            'auth' => [
                env('CLOUDANT_USERNAME'),
                env('CLOUDANT_PASSWORD'),
            ]
        ]);

    }
}