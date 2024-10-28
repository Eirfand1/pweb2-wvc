<?php
namespace App\Models;
use Config\Database;

class Model extends Database {
    protected $table;
    protected $select = "*";
    protected $joins = [];
    protected $where = [];
    
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

    public function find($column,$id) {
        $query = "SELECT * FROM {$this->table} WHERE {$column}='{$id}'";
        $result = $this->conn->query($query);
        return $result;
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
        $this->where[] = "{$column}='{$value}'";
        return $this;
    }

    public function select($columns) {
        if (is_array($columns)) {
            $this->select = implode(', ', $columns);
        } else {
            $this->select = $columns;
        }
        return $this;
    }

    public function join($table, $first, $operator, $second, $type = 'INNER') {
        $this->joins[] = sprintf(' %s JOIN %s ON %s %s %s', 
            $type, $table, $first, $operator, $second
        );
        return $this;
    }
 

    public function leftJoin($table, $first, $operator, $second) {
        return $this->join($table, $first, $operator, $second, 'LEFT');
    }

    public function rightJoin($table, $first, $operator, $second) {
        return $this->join($table, $first, $operator, $second, 'RIGHT');
    }

    public function get() {
        $query = "SELECT {$this->select} FROM {$this->table}";
        
        if (!empty($this->joins)) {
            $query .= implode(' ', $this->joins);
        }

        if (!empty($this->where)) {
            $query .= ' WHERE ' . implode(' AND ', $this->where);
        }

        $this->select = "*";
        $this->joins = [];
        $this->where = [];

        return $this->conn->query($query);
    } 
}




