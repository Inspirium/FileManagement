<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/file', 'namespace' => 'Inspirium\FileManagement\Controllers', 'middleware' => ['web', 'auth']], function() {
    Route::get('{id?}', 'FileController@getFileInfo');
    Route::post('/', 'FileController@postFile');
    Route::patch('{id}', 'FileController@updateFile');
    Route::delete('{id}', 'FileController@deleteFile');
});
