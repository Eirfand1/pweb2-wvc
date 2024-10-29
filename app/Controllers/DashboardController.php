<?php 

namespace App\Controllers;
//menggunakan file lain
use App\Controller;
use App\Models\Penulis;
use App\Models\Artikel;
use App\Models\Komentar;
use App\Models\Kategori;

//class turunan dari controller
class DashboardController extends Controller {
   private $penulis, $artikel, $userId, $komentar, $kategori;
   public function __construct(){
      $this->penulis = new Penulis();
      //instansiasi model artikel
      $this->artikel = new Artikel();
      $this->komentar = new Komentar();
      $this->kategori = new Kategori();
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

   public function listKomentar($id){
      $result = $this->komentar->all();
      return $this->render(view: 'dashboard/komentar', data: ['data' => $result]);

   }

   public function listKategori($id){
      $result = $this->kategori->all();
      return $this->render(view: 'dashboard/kategori', data: ['kategori' => $result]);
   }
}