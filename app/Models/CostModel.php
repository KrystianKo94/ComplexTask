<?php

namespace App\Models;
use \PDO;

class CostModel
{
    protected $nameTable = "Cost";
    protected $id = "id";
    protected $allowField = ['postcode', 'total_order_amount', 'long_product'];
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

    public function pobierzDaneKontrahentow()
    {
        $query = "SELECT * FROM {$this->nameTable}";
        $statement = $this->pdo->prepare($query);

        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function zapiszDaneDoBazy($data)
    {
        
            $query = "INSERT INTO {$this->nameTable} (postcode, total_order_amount, long_product) 
                      VALUES (:postcode, :total_order_amount, :long_product)";
            $statement = $this->pdo->prepare($query);

            $statement->bindParam(':postcode', $data['postcode']);
            $statement->bindParam(':total_order_amount', $data['total_order_amount']);
            $statement->bindParam(':long_product', $data['long_product']);

            $statement->execute();
            return true;

      
    }
    public function pobierzKontrahenta($id)
    {
        $query = "SELECT * FROM {$this->nameTable} WHERE id = :id";
        $statement = $this->pdo->prepare($query);
    
        $statement->bindParam(':id', $id);
        $statement->execute();
    
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function aktualizujDaneKontrahenta($data)
    {
        $query = "UPDATE {$this->nameTable} 
            SET nip = :nip, regon = :regon, nazwa = :nazwa, 
                czy_platnik = :czy_platnik, ulica = :ulica, 
                numer_domu = :numer_domu, numer_mieszkania = :numer_mieszkania
            WHERE id = :id";
    
        $statement = $this->pdo->prepare($query);
    
        $statement->bindParam(':id', $data['id']);
        $statement->bindParam(':nip', $data['nip']);
        $statement->bindParam(':regon', $data['regon']);
        $statement->bindParam(':nazwa', $data['nazwa']);
        $statement->bindParam(':czy_platnik', $data['czy_platnik_vat']);
        $statement->bindParam(':ulica', $data['ulica']);
        $statement->bindParam(':numer_domu', $data['numer_domu']);
        $statement->bindParam(':numer_mieszkania', $data['numer_mieszkania']);
    
        $success = $statement->execute();
    
    }

    public function usunKontrahenta($id)
{
    $query = "DELETE FROM {$this->nameTable} WHERE id = :id";
    $statement = $this->pdo->prepare($query);

    $statement->bindParam(':id', $id);

    return $statement->execute();
}
}

