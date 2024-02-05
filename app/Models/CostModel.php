<?php

namespace App\Models;
use \PDO;

class CostModel
{
    protected $nameTable = "Cost";
    protected $id = "id";
    protected $allowField = ['postcode', 'total_order_amount', 'long_product','shipping_cost'];
    protected $pdo;

    public function __construct()
    {
        $driver = 'mysql';
        $host = 'localhost';
        $database = 'Complex';
        $username = 'tomek';
        $password = 'buraki';

        $this->pdo = new PDO("$driver:host=$host;dbname=$database;charset=UTF8", $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function zapiszKosztyDoBazy($postcode, $total, $longProduct)
    {
    
        $shippingCost = $this->przeliczKosztyDostawy($postcode, $total, $longProduct);
        $zonesModel = new ZonesModel();
        $zonesData = $zonesModel->pobierzDaneStref();
    
 
        $zone = strval(substr($postcode, 0, 2));
        $key = array_search($zone, array_column($zonesData, 'zone'));
    
        if ($key !== false) {


            if ($total > 12500) {
                $shippingCost +=$total*0.95;
            }
            
            $shippingCost = $zonesData[$key]['shipping_price'];
            $shippingCost+=$total;
    
        
            if ($longProduct) {
                $shippingCost += 1995;
            }
        } else {
            $shippingCost = 0;
        }
    
    
        $stmt = $this->pdo->prepare("INSERT INTO {$this->nameTable} (postcode, total_order_amount, long_product, shipping_cost) 
                                    VALUES (:postcode, :total, :longProduct, :shippingCost)");
    
        $stmt->bindParam(':postcode', $postcode, PDO::PARAM_INT);
        $stmt->bindParam(':total', $total, PDO::PARAM_STR);
        $stmt->bindParam(':longProduct', $longProduct, PDO::PARAM_BOOL);
        $stmt->bindParam(':shippingCost', $shippingCost, PDO::PARAM_STR);
    
  
        $stmt->execute();
    
        return true;
    }

    public function przeliczKosztyDostawy($postcode, $total, $longProduct)
    {
        $zonesModel = new ZonesModel();
        $zonesData = $zonesModel->pobierzDaneStref();
    
        if (empty($zonesData)) {
            return 0;
        }
    
        $zone = strval(substr($postcode, 0, 2));
    
        $zones = array_column($zonesData, 'zone');
    
      
        $key = array_search($zone, $zones);
    
        if ($key !== false) {
       
            $shippingCost = $zonesData[$key]['shipping_price'];
    
          
            if ($total > 12500) {
                $shippingCost = $total* 0.95;
            }


            if ($longProduct) {
                $shippingCost += 1995;
            }
          
            return $shippingCost;
        } else {
            return 0;
        }
    }

    public function pobierzListeKosztow()
{
    $query = "SELECT * FROM {$this->nameTable}";
    $statement = $this->pdo->prepare($query);

    $statement->execute();

    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

}

