<?php 
namespace App\Models;   

//class turunan dari model
class Penulis extends Model{
   
   //memanggill construct dari parent
   public  function __construct() {
      parent ::__construct();
      //mendefinisikan nama tabel(model)
      $this->table = "penulis";
   }
   }  
?>