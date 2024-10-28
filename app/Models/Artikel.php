<?php 
namespace App\Models;
use App\Models\Model;

class Artikel extends Model {
   public function __construct(){
      parent::__construct();
      $this->table = "artikel";
   }
}