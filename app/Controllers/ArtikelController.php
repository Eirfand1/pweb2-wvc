<?php 
namespace App\Controllers;
use App\Controller;
use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\Komentar;

class ArtikelController extends Controller {
   private $artikel, $kategori, $komentar;
   public function __construct(){
      $this->artikel= new Artikel();
      $this->komentar = new Komentar();
   }
   public function index(){
      $result = $this->artikel
               ->select('artikel.*,kategori.nama_kategori')
               ->join('kategori', 'artikel.kategori_id', '=', 'kategori.id_kategori')
               ->get();

      return $this->render('index', ['data'=> $result]);
   }

   public function show($id){
      $result = $this->artikel
                ->select('artikel.*,kategori.nama_kategori, penulis.nama, penulis.bio')
                ->join('kategori','artikel.kategori_id','=','kategori.id_kategori')
                ->join('penulis','artikel.penulis_id', '=','penulis.id_penulis')
                ->where('artikel.id_artikel', $id)
                ->get();
      $komentar = $this->komentar->find('artikel_id',$id);

      return $this->render('show',
       ['data'=>$result,
              'komentar'=>$komentar]);
   }

}