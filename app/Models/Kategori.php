<?php 
namespace App\Models;
use App\Models\Model;

class Kategori extends Model {
   public function __construct(){
      parent::__construct();
      $this->table = "kategori";
   }
}