<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\DelegacjaModel;
use App\Models\KontrahentModel;
use App\Models\UserModel;
use App\Models\CostModel;
use App\Models\ZonesModel;

class AppController extends Controller
{
    

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
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $postcode = isset($_POST['postcode']) ? intval($_POST['postcode']) : 0;
        $total = isset($_POST['total']) ? floatval($_POST['total']) : 0;
        $longProduct = isset($_POST['long_product']);

       

     
        if ($postcode <= 0 || strlen((string)$postcode) !== 5) {
            $this->view('formularz_kalkulacji', ['error' => 'Invalid postcode']);
            return;
        }

     
        if ($total <= 0) {
            $this->view('formularz_kalkulacji', ['error' => 'Invalid total order amount']);
            return;
        }

     
        $costModel = new CostModel();
        $shippingCost = $costModel->przeliczKosztyDostawy($postcode, $total, $longProduct);

     

        $costModel->zapiszKosztyDoBazy($postcode, $total, $longProduct);

      

        $this->view('index'); 
    }
}



public function importStref()
{
    $this->view('import_stref');
}
public function importStrefDoBazy()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $file = $_FILES['import_zones'];
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $response = ['success' => false, 'message' => 'Wystąpił błąd podczas przesyłania pliku.'];
            echo json_encode($response);
            return;
        }

        $handle = fopen($file['tmp_name'], 'r');

        if ($handle === false) {
            $response = ['success' => false, 'message' => 'Nie udało się otworzyć pliku CSV.'];
            echo json_encode($response);
            return;
        }

        $zonesModel = new ZonesModel();
        $existingData = $zonesModel->pobierzDaneStref();
        if (!empty($existingData)) {
            $response = ['success' => false, 'message' => 'W bazie już istnieją dane.'];
            echo json_encode($response);
            fclose($handle);
            return;
        }

        $zonesData = [
            'zone' => [],
            'shipping_price' => [],
        ];

        while (($row = fgetcsv($handle, 0, "\t")) !== false) {
            if (count($row) >= 1) {
                $explodedRow = explode(',', $row[0]);

                if (count($explodedRow) == 2) {
                    $zonesData['zone'][] = intval(trim($explodedRow[0]));
                    $zonesData['shipping_price'][] = intval(trim($explodedRow[1]));
                }
            } else {
                continue;
            }
        }

        fclose($handle);

        $zonesModel = new ZonesModel();

        for ($i = 0; $i < count($zonesData['zone']); $i++) {
            $data = [
                'zone' => $zonesData['zone'][$i],
                'shipping_price' => $zonesData['shipping_price'][$i],
            ];
            $zonesModel->zapiszDaneDoBazy($data);
        }

        $response = ['success' => true, 'message' => 'Import zakończony pomyślnie'];
        echo json_encode($response);
    }
}

public function listaKosztow()
{
    $costModel = new CostModel();
    $costs = $costModel->pobierzListeKosztow();

    $this->view('lista_kosztow', ['costs' => $costs]);
}

}
