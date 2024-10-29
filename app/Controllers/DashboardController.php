<?php 

namespace App\Controllers;
//menggunakan file lain
use App\Controller;
use App\Models\Penulis;
use App\Models\Artikel;

//class turunan dari controller
class DashboardController extends Controller {
   private $penulis, $artikel, $userId;
   public function __construct(){
      $this->penulis = new Penulis();
      //instansiasi model artikel
      $this->artikel = new Artikel();
   }
   public function index($id){
      $user = $this->penulis->find('id_penulis',$id);
      $this->userId = $id;
      return $this->render(
         "dashboard/index",
         ['user'=> $user]
      );
   }
   public function listArtikel($id){
     $artikel = $this->artikel->find('penulis_id',$id);
      return $this->render(
         'dashboard/artikel',
         ['artikel'=> $artikel]
      );
   }


   //method untuk menampilkan list penulis 
   public function listPenulis($id) {
      $result = $this->penulis->all();
      return $this->render('dashboard/penulis', ['data' => $result]);
   }
}