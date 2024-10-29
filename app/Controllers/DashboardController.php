<?php 

namespace App\Controllers;
use App\Controller;
use App\Models\Penulis;
use App\Models\Artikel;

class DashboardController extends Controller {
   private $penulis, $artikel, $userId;
   public function __construct(){
      $this->penulis = new Penulis();
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
}