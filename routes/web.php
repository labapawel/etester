<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

$this->get('test', function(){
    
    $x = \wsiz\etester\Model\field::find(2)->losowanie()->limit(10)->get() ;
    dd(strlen("ŁĄĘ"));
    dd(\wsiz\etester\Model\field::find(2)->dodaj_biale_znaki("ŁĄĘ"));
    
});


use Faker\Factory as Faker;

//Route::get('/', function () {
//    return view('welcome');
//});


//Route::get('/fake', function () {
//$lista_kat = \wsiz\etester\Model\field::get()->pluck('id');
//    
//for($i=0; $i<1000; $i++){
//$faker = Faker::create();
//$faker->region='pl_PL';
////dd($faker->paragraph);
//$odpnr = rand(1,3); // odpowiedź losowa
//$katr = rand(0,count($lista_kat)-1); // kategoria losowa
//
//
//$dane = [
//    'title' => $faker->name." ".$odpnr,
//    'question' => $faker->paragraph." ".$odpnr,
//    'response1' => $faker->paragraph,
//    'response2' => $faker->paragraph,
//    'response3' => $faker->paragraph,
//    'correct'=>$odpnr,
//    'type'=>$lista_kat[$katr],
//    'active'=>1,
//   ];
////dd($dane);
//wsiz\etester\Model\Question::create($dane);
//}
//    
//});
