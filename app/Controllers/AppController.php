<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\DelegacjaModel;
use App\Models\KontrahentModel;
use App\Models\UserModel;
use App\Models\CostModel;

class AppController extends Controller
{
    private $model;

   




    public function index()
    {

        
        $this->view('index');

    }



public function formularzKalkulacji()
{

    $this->view('formularz_kalkulacji');

}




public function zapiszFormularzKalkulacji()
{

  
    $data = array(
        'postcode' => $_POST['postcode'],
        'total' => $_POST['total'],
        'long_product' => $_POST['long_product'],

    );


    
    $Kontrahent= new CostModel();
    $Kontrahent->zapiszDaneDoBazy($data);
    var_dump(1);die;

}


  

}
