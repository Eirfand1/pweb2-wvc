<?php 
namespace App\Controllers;
use App\Controller;
use App\Models\Artikel;
use App\Models\Kategori;

class ArtikelController extends Controller {
   private $artikel, $kategori;
   public function __construct(){
      $this->artikel= new Artikel();
   }
   public function index(){
      $result = $this->artikel->all();
      $result2 = $this->artikel
               ->select('artikel.*,kategori.nama_kategori')
               ->join('kategori', 'artikel.id_artikel', '=', 'kategori.id_kategori')
               ->get();

      return $this->render('index', ['data'=> $result2]);
   }

}