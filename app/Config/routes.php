<?php
require_once APPROOT . '/Libries/Route.php';
require_once APPROOT . '/Libries/RouteClass.php';
require_once APPROOT.'/Static/HttpMethod.php';

use App\Core\Route;
use App\Statics\HttpMethod;
$class = new Route();

$class::route('/',"\App\Controllers\AppController",'index',null,HttpMethod::$GET);

$class::route('/', "\App\Controllers\AppController", 'index', null, HttpMethod::$GET);
$class::route('/formularz_kalkulacji', "\App\Controllers\AppController", 'formularzKalkulacji', null, HttpMethod::$GET);
$class::route('/zapisz_formularz_kalkulkacji', "\App\Controllers\AppController", 'zapiszFormularzKalkulacji', null, HttpMethod::$POST);
$class::route('/import_stref', "\App\Controllers\AppController", 'importStref', null, HttpMethod::$GET);
$class::route('/import_stref_do_bazy', "\App\Controllers\AppController", 'importStrefDoBazy', null, HttpMethod::$POST);
$class::route('/lista_kosztow', "\App\Controllers\AppController", 'listaKosztow', null, HttpMethod::$GET);

