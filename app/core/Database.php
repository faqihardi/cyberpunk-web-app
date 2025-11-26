<?php

require_once __DIR__ . '/../config/config.php';

class Database
{
    // Attribute to connect database
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASS;
    private $dbname = DB_NAME;
    private $dbport = DB_PORT;

    // Attribute to handle database operation
    private $pdo;
    private $stmt;
    private $error;

    // Constructor method to initialize database connection
    public function __construct()
    {
        // Data Source Name (DSN) 
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';port=' . $this->dbport;

        // Options
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->password, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
        
    }

    public function query($sql)
    {
        $this->stmt = $this->pdo->prepare($sql);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function results()
    {
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function result() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function bind($param, $value)
    {   
        $this->stmt->bindValue($param, $value);
    }
}

$konek = new Database();
if ($konek) {
    echo "Koneksi Berhasil";
}