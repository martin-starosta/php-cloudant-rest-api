<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', 'CoreController@index');

/* Cloudant Document routes */
$app->get('api/document/{database}/read/{id}', 'Cloudant\DocumentController@document');
$app->get('/api/document/{database}/list', 'Cloudant\DocumentController@listDocuments');
$app->post('api/document/{database}/insert', 'Cloudant\DocumentController@insert');
$app->post('api/document/{database}/update/{id}', 'Cloudant\DocumentController@update');

/* Cloudant Databases routes */
$app->get('api/database/list', 'Cloudant\DatabaseController@listDatabases');

$app->post('/', function () use ($app) {
    return $app->version();
});