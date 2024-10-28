<?php 
namespace App\Models;

class Komentar extends Model{
   public function __construct(){
      parent::__construct();
      $this->table = 'komentar';
   }
   
}