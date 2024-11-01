<?php 

//Koneksi ke database pweb2kel4
namespace Config;
use mysqli;
use mysqli_sql_exception;
class Database{
   protected $conn;
   public function __construct() {
    $host = 'mdi.my.id';
    $db   = 'basdeat2_klp4';
    $user = 'basdeat2_usr4';
    $pass = '7.8fBotqbm&C~*.@#h';


    $this->conn = new mysqli($host, $user, $pass, $db);
    if($this->conn->connect_error) die('Koneksi error karena : '. $this->conn->connect_error);

  }
} 