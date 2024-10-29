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

   public function artikelStore($id){
      $result = $this->artikel->insert($_POST);

      if($result){
        echo "<script>
         alert('Data Mahasiswa berhasil di tambah')
         location.href = '/dashboard/{$id}/artikel' </script>" 
        ;
      }
   }

   public function artikelDelete($id,$idArtikel){
      $result = $this->artikel->delete('id_artikel',$idArtikel);
      return $this->render('dashboard/deleteArtikel');
   }

   public function insertPageArtikel($id){
     $user = $this->penulis->find('id_penulis',$id); 
     $kategori = $this->kategori->all();
     return $this->render('/dashboard/insertArtikel',[
      'user'=>$user,
      'kategori'=>$kategori
     ]);
   }

   //method untuk menampilkan list penulis 
   public function listPenulis() {
      $result = $this->penulis->all();
      return $this->render('dashboard/admin/penulis', ['data' => $result]);
   }

   public function listKomentar($id){
      $result = $this->komentar->all();
      return $this->render(view: 'dashboard/komentar', data: ['data' => $result]);

   }

   public function listKategori($id){
      $result = $this->kategori->all();
      return $this->render(view: 'dashboard/kategori', data: ['kategori' => $result]);
   }

   public function listKomentarAdmin(){
      $result = $this->komentar->all();
      return $this->render(view: 'dashboard/admin/komentar', data: ['data' => $result]);
   }
   public function listKategoriAdmin(){
      $result = $this->kategori->all();
      return $this->render(view: 'dashboard/admin/kategori', data: ['kategori' => $result]);
   }

   public function indexAdmin(){
      $user = $this->penulis->find('nama','admin');
      return $this->render(
         "dashboard/admin/index",
         ['user'=> $user]
      );
   }

   public function listArtikelAdmin(){
      $result = $this->artikel->all();
      return $this->render('/dashboard/admin/artikel', ['data'=> $result]);
   }
}