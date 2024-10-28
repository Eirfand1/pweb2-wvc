<?php 
namespace App\Controllers;
use App\Controller;
use App\Models\Artikel;

class ArtikelController extends Controller {
   private $table;
   public function __construct(){
      $this->table = new Artikel();
   }
   public function index(){
      $result = $this->table->all();

      return $this->render('index', ['data'=> $result]);
   }

}