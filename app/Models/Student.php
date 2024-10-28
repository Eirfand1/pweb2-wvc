<?php 

namespace App\Models;

class Student extends Model{
  public function __construct(){
    parent::__construct();
    $this->table = 'students';
  }
}

