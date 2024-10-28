<?php 
namespace Config;
use mysqli;
use mysqli_sql_exception;
class Database{
   protected $conn;
   public function __construct() {
    $host = 'localhost';
    $db   = 'tugas2';
    $user = 'root';
    $pass = '';


    $this->conn = new mysqli($host, $user, $pass, $db);
    if($this->conn->connect_error) die('Koneksi error karena : '. $this->conn->connect_error);

  }
} 