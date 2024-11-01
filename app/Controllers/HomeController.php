<?php

namespace App\Controllers;

use App\Controller;

class HomeController extends Controller
{
   public function index(){
      
      $this->render('index', [
         "abogo"=> "boga",
         "message"=> "This is home view"
      ]);
   }
   public function AdminIndex()
   {
      $this->render('admin/index', [
         'user' => 'admin',
         'mhs'=> 'agus',
         'semester'=> "12",
         'matkul' => "gratis ongkir" 
      ]);
   }
}