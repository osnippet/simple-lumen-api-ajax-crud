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

$router->get('/version', function () use ($router) {
    // return $router->app->version();
    return '<h3>version: 1.5.1</h3>';
});

$router->get('/', function ()  {
    return view('homepage', ['name' => 'oSnippet']);
});


// -- INFO -- \\
/*
 * Activate Eloquent and Facades
 * Open up the bootstrap/app.php and uncomment this line, // app->withEloquent.
 * Once uncommented, Lumen hooks the Eloquent ORM with your database as configured in the .env file.
 * php artisan make:migration create_authors_table
 * run php -S localhost:8000 -t public to serve the project. Head over to your browser. 
 */

// Manually Added
$router->group(['prefix' => 'api'], function () use ($router) {

    $router->get('posts',  ['uses' => 'DataController@index']);
    $router->get('posts/{id}',  ['uses' => 'DataController@show']);
    $router->post('posts',  ['uses' => 'DataController@store']);
    $router->delete('posts/{id}', ['uses' => 'DataController@destroy']);
    $router->put('posts/{id}', ['uses' => 'DataController@update']);

    // ** * ** \\

    $router->get('authors',  ['uses' => 'AuthorController@showAllAuthors']);
  
    $router->get('authors/{id}', ['uses' => 'AuthorController@showOneAuthor']);
  
    $router->post('authors', ['uses' => 'AuthorController@create']);
  
    $router->delete('authors/{id}', ['uses' => 'AuthorController@delete']);
  
    $router->put('authors/{id}', ['uses' => 'AuthorController@update']);
  });