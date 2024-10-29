<?php 

namespace App\Models;

class Penulis extends Model {
   public function __construct(){
      parent::__construct();
      $this->table = 'penulis';
   }
}