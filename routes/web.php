<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::group(['middleware'=>'user'], function (){
    Route::get('/', 'AdminController@index');
    Route::get('/logout', 'LoginController@logout');
    Route::group(['middleware'=>'commerciale'], function (){
        Route::get('/articles/categorie/ajouter', 'CategorieArticlesController@create');
        Route::get('/articles/categorie/{id}/modifier', 'CategorieArticlesController@edit');
        Route::get('/articles/categorie/{id}/supprimer', 'CategorieArticlesController@destroy');
        Route::get('/articles/categorie', 'CategorieArticlesController@index');
        Route::post('/articles/categorie/ajouter', 'CategorieArticlesController@store');
        Route::post('/articles/categorie/{id}/modifier', 'CategorieArticlesController@update');

        Route::get('/articles/ajouter', 'ArticleController@create');
        Route::get('/articles/{id}/modifier', 'ArticleController@edit');
        Route::get('/articles/{id}/supprimer', 'ArticleController@destroy');
        Route::get('/articles', 'ArticleController@index');
        Route::post('/articles/ajouter', 'ArticleController@store');
        Route::post('/articles/{id}/modifier', 'ArticleController@update');

        Route::get('/services/categories/ajouter', 'CategorieServiceController@create');
        Route::get('/services/categories/{id}/modifier', 'CategorieServiceController@edit');
        Route::get('/services/categories/{id}/supprimer', 'CategorieServiceController@destroy');
        Route::get('/services/categories', 'CategorieServiceController@index');
        Route::post('/services/categories/ajouter', 'CategorieServiceController@store');
        Route::post('/services/categories/{id}/modifier', 'CategorieServiceController@update');

        Route::get('/services/ajouter', 'ServiceController@create');
        Route::get('/services/{id}/modifier', 'ServiceController@edit');
        Route::get('/services/{id}/supprimer', 'ServiceController@destroy');
        Route::get('/services', 'ServiceController@index');
        Route::post('/services/ajouter', 'ServiceController@store');
        Route::post('/services/{id}/modifier', 'ServiceController@update');

        Route::get('/clients/ajouter', 'ClientController@create');
        Route::get('/clients/{id}/modifier', 'ClientController@edit');
        Route::get('/clients/{id}/supprimer', 'ClientController@destroy');
        Route::get('/clients', 'ClientController@index');
        Route::post('/clients/ajouter', 'ClientController@store');
        Route::post('/clients/{id}/modifier', 'ClientController@update');

        Route::get('/fournisseurs/ajouter', 'FournisseurController@create');
        Route::get('/fournisseurs/{id}/modifier', 'FournisseurController@edit');
        Route::get('/fournisseurs/{id}/supprimer', 'FournisseurController@destroy');
        Route::get('/fournisseurs', 'FournisseurController@index');
        Route::post('/fournisseurs/ajouter', 'FournisseurController@store');
        Route::post('/fournisseurs/{id}/modifier', 'FournisseurController@update');
    });
    Route::group(['middleware'=>'vendeur'], function (){
        Route::get('/entrees/ajouter', 'EntreeController@create');
        Route::get('/entrees/{id}/modifier', 'EntreeController@edit');
        Route::get('/entrees/{id}/show', 'EntreeController@show');
        Route::get('/entrees/{id}/supprimer', 'EntreeController@destroy');
        Route::get('/entrees', 'EntreeController@index');
        Route::post('/entrees/ajouter', 'EntreeController@store');
        Route::post('/entrees/{id}/modifier', 'EntreeController@update');

        Route::get('/sorties/ajouter', 'SortieController@create');
        Route::get('/sorties/{id}/modifier', 'SortieController@edit');
        Route::get('/sorties/{id}/show', 'SortieController@show');
        Route::get('/sorties/{id}/supprimer', 'SortieController@destroy');
        Route::get('/sorties', 'SortieController@index');
        Route::post('/sorties/ajouter', 'SortieController@store');
        Route::post('/sorties/{id}/modifier', 'SortieController@update');


        Route::get('/recus/{id}/payer', 'RecuController@create');
        Route::get('/recus/{id}/modifier', 'RecuController@edit');
        Route::get('/recus/{id}/afficher', 'RecuController@show');
        Route::get('/recus/{id}/supprimer', 'RecuController@destroy');
        Route::get('/recus/{id}', 'RecuController@index');
        Route::post('/recus/{id}/payer', 'RecuController@store');
        Route::post('/recus/{id}/modifier', 'RecuController@update');

        Route::get('/sortieCaisses/{id}/payer', 'SortieCaissesController@create');
        Route::get('/sortieCaisses/{id}/modifier', 'SortieCaissesController@edit');
        Route::get('/sortieCaisses/{id}/afficher', 'SortieCaissesController@show');
        Route::get('/sortieCaisses/{id}/supprimer', 'SortieCaissesController@destroy');
        Route::get('/sortieCaisses/{id}', 'SortieCaissesController@index');
        Route::post('/sortieCaisses/{id}/payer', 'SortieCaissesController@store');
        Route::post('/sortieCaisses/{id}/modifier', 'SortieCaissesController@update');
    });
    Route::group(['middleware'=>'admin'], function (){
        Route::get('/users/{id}/modifier', 'UserController@edit');
        Route::get('/users/{id}/show', 'UserController@show');
        Route::get('/users/{id}/supprimer', 'UserController@destroy');
        Route::get('/users/', 'UserController@index');
        Route::post('/users/{id}/modifier', 'UserController@modifier');
        Route::get('/users/ajouter', 'UserController@create');
        Route::post('/users/ajouter', 'UserController@store');

        Route::get('/billets/{id}/payer', 'BilletController@create');
        Route::get('/billets/{id}/modifier', 'BilletController@edit');
        Route::get('/billets/{id}/show', 'BilletController@show');
        Route::get('/billets/{id}/supprimer', 'BilletController@destroy');
        Route::get('/billets', 'BilletController@index');
        Route::get('/billets/charger', 'BilletController@load');
        Route::post('/billets/{id}/payer', 'BilletController@store');
        Route::post('/billets/{id}/modifier', 'BilletController@update');
    });

});
Route::group(['middleware'=>'visitors'], function (){
    Route::get('/login', 'LoginController@login');
    Route::post('/login', 'LoginController@postLogin');
    Route::post('/contact', 'ContactController@index');
});