<?php


\Route::group(['middleware'=>'web'], function() {
    route::get('/','testController@index');
    route::get('/logowaniedziekana','testController@logowaniedziekana');
    route::get('/generujpytania','testController@generujpytania');
    
    
});
\Route::group(['middleware'=>'auth'], function() {
});

