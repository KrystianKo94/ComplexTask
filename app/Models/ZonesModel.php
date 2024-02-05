<?php

namespace App\Models;
use \PDO;

class ZonesModel
{
    protected $nameTable = "zones";
    protected $id = "id";
    protected $allowField = ['zone', 'shipping_price'];
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
    public function pobierzDaneStref()
    {
        $query = "SELECT * FROM {$this->nameTable}";
        $statement = $this->pdo->prepare($query);

        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function zapiszDaneDoBazy($data)
    {
        // Zmieniono pola w zapytaniu SQL na nowe pola tabeli
        $query = "INSERT INTO {$this->nameTable} (zone, shipping_price) 
                  VALUES (:zone, :shipping_price)";
        $statement = $this->pdo->prepare($query);

        $statement->bindParam(':zone', $data['zone'],);
        $statement->bindParam(':shipping_price', $data['shipping_price']);

        $statement->execute();
        return true;
    }

}

