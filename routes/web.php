<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return "api cnae-cid";
});


$router->group(['prefix' => 'cnae'], function() use ($router) {
    $router->get('/find/{rawCnae}', 'CnaeController@find');
    $router->get('/cids/{rawCnae}', 'CnaeController@getCidsByCnae');
});

$router->group(['prefix' => 'cid'], function() use ($router) {
    $router->get('/find/{rawCid}', 'CidController@find');
    $router->get('/cnaes/{rawCid}', 'CidController@getCnaesByCId');
});

$router->group(['prefix' => 'relationship'], function() use ($router) {
    $router->get('/exists/{rawCnae}/{rawCid}', 'RelecaoCnaeCidController@exists');
    $router->get('/exists-group', 'RelecaoCnaeCidController@exists_group');
});



