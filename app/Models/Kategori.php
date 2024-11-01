<?php 
//menunjukkan bahwa kelas Kategori berada dalam namespace App\Models, 
//yang memudahkan pengelompokan kode terkait dan menghindari konflik nama dengan kelas lain.
namespace App\Models;

use App\Models\Model;

class Kategori extends Model {
   //mengatur agar model Kategori otomatis menggunakan tabel kategori di database.
   public function __construct(){
      parent::__construct();
      $this->table = "kategori";
   }
}