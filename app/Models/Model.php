<?php
namespace App\Models;
use Config\Database;

class Model extends Database {
  protected $table;

  public function __construct() {
    parent::__construct();
  }

  public function insert($data) {
    $columns = implode(", ", array_keys($data));
    $values = "'" . implode("', '", array_values($data)) . "'";
    $query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";

    return $this->conn->query($query) or die("Error: " . $this->conn->error);
  }

  public function delete($id) {
    $query = "DELETE FROM {$this->table} WHERE id='{$id}'";

    return $this->conn->query($query) or die("Error: " . $this->conn->error);
  }

  public function all() {
    $query = "SELECT * FROM {$this->table}";
    return $this->conn->query($query);
  }

  public function find($id) {
    $query = "SELECT * FROM {$this->table} WHERE id='{$id}'";
    $result = $this->conn->query($query);
    return $result->fetch_assoc();
  }


  public function update($id, $data) {

    $updates = [];
    foreach($data as $key => $value) {
      $updates[] = "{$key}='{$value}'";
    }
    $updates = implode(", ", $updates);


    $query = "UPDATE {$this->table} SET {$updates} WHERE id='{$id}'";
    return $this->conn->query($query) or die("Error: " . $this->conn->error);
  }

  public function where($column, $value) {
    $query = "SELECT * FROM {$this->table} WHERE {$column}='{$value}'";

    return $this->conn->query($query);
  }
}


