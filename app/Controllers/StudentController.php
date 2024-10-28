<?php 

namespace App\Controllers;

use App\Controller;
use App\Models\Student;

class StudentController extends Controller{
  private $table;

  public function __construct(){
    $this->table = new Student();
  }

  public function index(){
    $result = $this->table->all();

    return $this->render('/student/index', ['data'=> $result]);
  }
}

