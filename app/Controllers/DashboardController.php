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
         alert('Data Artikel berhasil di tambah')
         location.href = '/dashboard/{$id}/artikel' </script>" 
        ;
      }
   }

   public function artikelPageUpdate($uid, $aid){
      $result = $this->artikel->find('id_artikel', $aid);
      $kategori = $this->kategori->all();
      $user = $this->penulis->find('id_penulis', $uid);

      return $this->render(
         'dashboard/editArtikel',
         [
            'user' => $user,
            'data'=> $result,
            'kategori'=>$kategori
            ]
      );
   }

   public function artikelUpdate($uid, $aid){
      $result = $this->artikel->update('id_artikel',$aid, $_POST);
      if($result){
         $this->render('/dashboard/editSuccess', ['']);
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

   public function penulisStore(){
      $result = $this->penulis->insert($_POST);
      if($result){
         echo "<script>
         alert('Data Penulis berhasil di tambah')
         location.href = '/dashboard/admin/penulis' </script>" 
        ;
      }
   }

   public function insertPagePenulis(){
      return $this->render('/dashboard/admin/insertPenulis');
   }

   public function deletePenulis($id){
      $result = $this->penulis->delete('id_penulis', $id);
      return $this->render('/dashboard/admin/deletePenulis');
   }

   public function editPagePenulis($id){ 
      $result = $this->penulis->find('id_penulis', $id);
      return $this->render('dashboard/admin/editPenulis', ['data'=>$result]);
   }  

   public function penulisUpdate($id){
      $result = $this->penulis->update('id_penulis', $id, $_POST);
      if($result){
         $this->render('dashboard/admin/editSuccesPenulis', ['']);
      }
   }

   public function insertPageKategori(){
      return $this->render('/dashboard/admin/insertKategori');
   }

   public function kategoriStore(){
      $result = $this->kategori->insert($_POST);
      if($result){
         echo "<script>
         alert('Data Kategori berhasil di tambah')
         location.href = '/dashboard/admin/kategori' </script>" 
        ;
      }
   }

   public function editPageKategori($id){
      $result = $this->kategori->find('id_kategori', $id);
      return $this->render('dashboard/admin/editKategori', ['data'=>$result]);
   }

   public function kategoriUpdate($id){
      $result = $this->kategori->update('id_kategori', $id, $_POST);
      if($result){
         $this->render('dashboard/admin/editSuccesKategori', ['']);
      }
   }
}