<?php

namespace App\Http\Controllers\Cloudant;


use App\Http\Controllers\CloudantController;
use Illuminate\Http\Request;

class DocumentController extends CloudantController
{

    public $id;

    public function __construct()
    {
        parent::__construct();
        $this->id = -1;
    }


    public function document($id, $database)
    {
        try {
            $response = $this->client->get($database . '/' . $id, [
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

    /**
     * Function inserts document to specified Cloudant database. Values from
     * data field in POST request are stored in Cloudant.
     *
     * @param array $attributes key - value pairs
     */
    public function insert(Request $request, $database)
    {
        if (!is_array($request->data)) {
            echo "Attributes must be array containing pairs key - value";
            return false;
        }
        try {
            $response = $this->client->request('POST', $database, [
                'verify' => false,
                'json' => $request->data
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

    /**
     * Function updates document specified by _id in Cloudant database.
     * @param string $_id ID of the document
     * @param array $attributes document attributes
     */
    public function update(Request $request, $id, $database)
    {
        if (!is_array($request->data)) {
            echo "Attributes must be array containing pairs key - value";
            return false;
        }
        try {
            $prevRevision = json_decode($this->document($id, $database), true);

            $attributes = $this->addDiff($prevRevision, $request->data);

            $response = $this->client->request('PUT', $database . '/' . $id, [
                'verify' => false,
                'json' => $attributes
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

    public function deleteDocument($_id)
    {
        //TODO: To be implemented.
        ;
    }

    private function addDiff($sourceArray, $targetArray) {
        foreach($targetArray as $key => $value) {
            if(!isset($sourceArray[$key])) {
                $sourceArray[$key] = $value;
            } else {
                if(is_array($value)) {
                    $sourceArray[$key] = $this->addDiff($sourceArray[$key], $targetArray[$key]);
                } else {
                    $sourceArray[$key] = $value;
                }

            }
        }
        return $sourceArray;
    }

    public function listDocuments($database) {
        try {
            $response = $this->client->get($database . '/_all_docs?include_docs=true', [
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