## MVC PHP app 
Dependency :
- Tailwindcss
- Daisyui

how to run :
1. Clone this repository ```git clone https://github.com/Eirfand1/php-mvc-boilerplate.git```
2. ```cd php-mvc-boilerplate```
4. ```composer install```
5. ```npm install```

6. Run the server
   - this will automatically run php server and node
```sh
npm run dev
```
7. Open http://localhost:8080


# Documentation Manajemen Artikel


### Config.php
Koneksi ke database mysqli
```php
<?php 
namespace Config;
use mysqli;
use mysqli_sql_exception;
class Database{
   protected $conn;
   public function __construct() {
    $host = 'mdi.my.id';
    $db   = 'basdeat2_klp4';
    $user = 'basdeat2_usr4';
    $pass = '7.8fBotqbm&C~*.@#h';


    $this->conn = new mysqli($host, $user, $pass, $db);
    if($this->conn->connect_error) die('Koneksi error karena : '. $this->conn->connect_error);

  }
} 
```

### Models
Model.php  
file model ini berisi semua querry yang bisa digunakan oleh kontroler nantinya
```php
<?php
//mendefinisikan nama class folder agar bisa dipakai ooleh file lain
namespace App\Models;
use Config\Database;

//class turunan dari database
class Model extends Database {
    protected $table;
    protected $select = "*";
    protected $joins = [];
    protected $where = [];
    
    //memanggil construct dari parent
    public function __construct() {
        parent::__construct();
    }

    //method insert
    public function insert($data) {
        $columns = implode(", ", array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
        return $this->conn->query($query) or die("Error: " . $this->conn->error);
    }

    //method delete
    public function delete($column,$id) {
        $query = "DELETE FROM {$this->table} WHERE {$column}='{$id}'";
        return $this->conn->query($query) or die("Error: " . $this->conn->error);
    }

    //method update
    public function update($column,$id, $data) {
        $updates = [];
        foreach($data as $key => $value) {
            $updates[] = "{$key}='{$value}'";
        }
        $updates = implode(", ", $updates);
        $query = "UPDATE {$this->table} SET {$updates} WHERE {$column}='{$id}'";
        return $this->conn->query($query) or die("Error: " . $this->conn->error);
    } 
```

# Artikel

## Model

```php

Ini akan otomatis Menggunakan table artikel
untuk query sudah tersedia di class parent yang nanti akan diwariskan
<?php
class Artikel extends Model {
   public function __construct(){
      parent::__construct();
      $this->table = "artikel";
   }
}
```

### Controller
// Panggil class artikel dengan menggunakan user
```php
<?php
use App\Models\Artikel;

```

contoh penggunaan controller
```php
<?php
public function index(){
      $result = $this->artikel
               ->select('artikel.*,kategori.nama_kategori')
               ->join('kategori', 'artikel.kategori_id', '=', 'kategori.id_kategori')
               ->get();
      // Artinya akan merener file index di folder Views, dan mengirim variabel $data yang berisi $result 

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
      $penulis = $this->penulis->all();
      return $this->render('show',
       ['data'=>$result,
              'komentar'=>$komentar, 'penulis'=>$penulis, 'aid'=>$id]);
   }

```

## Views

Contoh penggunaan views, tinggal panggil variabel yang telah kita kirim
```php
<?php

<?php foreach($data as $artikel) : ?>
            <div class="card rounded-sm border border-black border-dashed w-full bg-base-100">
                <div class="card-body p-6 bg-gray-100">
                    <div class="badge font-semibold badge-secondary badge-outline"><?=$artikel['nama_kategori']?></div>
                    <h1 class="card-title text-2xl  font-serif "><?=$artikel['judul']?></h1>
                    <p class="text-base-content mt-4"><?=$artikel['konten']?></p>
                    <div class="card-actions justify-end mt-4">
                        <a href="<?=$artikel['id_artikel']?>" class="text-black btn-ghost rounded-sm p-2 font-bold ">Selengkapnya....</a>
                    </div>
                </div>
            </div>
            <?php endforeach?>



```

## Routes
Lalu definisikan routenya
```php
<?php
$router->get('/', ArtikelController::class, 'index');
$router->get('/{id}',ArtikelController::class, 'show');
```

## CRUD Penulis (Mode Admin)

Penulis.php
Kelas penulis sebagai model untuk tabel penulis
model ini mewarisi fungsionalitas dari kelas Model induk 
```php
<?php 
namespace App\Models;   

//class turunan dari model
class Penulis extends Model{
   
   //memanggill construct dari parent
   public  function __construct() {
      parent ::__construct();
      //mendefinisikan nama tabel(model)
      $this->table = "penulis";
   }
   }  
?>
```
### Kontroler
DashboardController.php
ini adalah controller yang mengelola data Penulis. Controller ini yang memungkinkan admin untuk melakukan CRUD data penulis
```php
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

   //method untuk menampilkan list penulis 
   public function listPenulis() {
      $result = $this->penulis->all();
      return $this->render('dashboard/admin/penulis', ['data' => $result]);
   }

   // Method untuk ke page insert penulis
   public function insertPagePenulis(){
      return $this->render('/dashboard/admin/insertPenulis');
   }

   public function deletePenulis($id){
      // Hapus semua artikel yang ditulis oleh penulis ini
      $this->artikel->delete('penulis_id', $id);
  
      // Hapus data penulis
      $result = $this->penulis->delete('id_penulis', $id);
      return $this->render('/dashboard/admin/deletePenulis');
  }
  
      // Method ke page edit penulis
   public function editPagePenulis($id){ 
      $result = $this->penulis->find('id_penulis', $id);
      return $this->render('dashboard/admin/editPenulis', ['data'=>$result]);
   }  
      // Method untuk menyimpan data penulis yang baru
   public function penulisUpdate($id){
      $result = $this->penulis->update('id_penulis', $id, $_POST);
      if($result){
         $this->render('dashboard/admin/editSuccesPenulis', ['']);
      }
   }



```
### Views/dashboard/admin
Penulis.php
file ini menampilkan halaman daftar Penulis, dan juga untuk CRUD penulis
```php
<?php

$current_url = $_SERVER['REQUEST_URI'];
$url_parts = explode('/', $current_url);
$dashboard_id = isset($url_parts[2]) ? $url_parts[2] : '1';

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>list artikel</title>
</head>
<body class="min-h-screen" data-theme="garden">
   <div class="mx-auto min-h-screen flex">
   <?php require_once './components/admin/sidebar.php' ?>
      <div class="w-5/6">
   <?php require_once './components/navDashboard.php' ?>
      <div class=" m-4 rounded bg-gray-50  p-6  rounded-sm overflow-hidden">
        <h1 class="text-2xl">List Penulis</h1>
        <a href="/dashboard/<?= $dashboard_id?>/penulis/tambah" class="btn btn-primary">Tambah Penulis</a>
        <table id="myTable" class="display border border-gray-400">
         <thead>
            <tr>
               <td>No</td>
               <td>Nama</td>
               <td>Biografi</td>
               <td>Profil</td>
               <td>Aksi</td>
            </tr>
         </thead>
         <tbody>
            <?php $no=1; foreach($data as $row) :?>
               <tr>
                  <td><?=$no++?></td>
                  <td><?=$row['nama']?></td>
                  <td><?=$row['bio']?></td>
                  <td><?=$row['profil']?></td>
                  <td>
                  <button class="btn btn-sm btn-error btn-outline" onclick="confirmDelete(<?=$row['id_penulis']?>)">Hapus</button>
                     <a href="/dashboard/admin/penulis/edit/<?=$row['id_penulis']?>" class="btn btn-sm btn-info">Edit</a>
                     <a href="/dashboard/<?=$row['id_penulis']?>" class="btn btn-sm btn-success">Masuk</a>

                  </td>
               </tr>
            <?php endforeach?>
         </tbody>
        </table>
      </div>
      </div>
      
   </div>

   <script>
      function confirmDelete(id) {
         Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus!',
            cancelButtonText: 'Batal'
         }).then((result) => {
            if (result.isConfirmed) {
               // Redirect to the delete URL
               window.location.href = '/dashboard/admin/penulis/' + id;
            }
         });
      }
   </script>
</body>
</html>
```
insertPenulis.php
halaman ini digunakan untuk menambahkan data penulis baru
```php
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tambah Penulis</title>
</head>
<body class="min-h-screen" data-theme="garden">
   <div class="flex min-h-screen">

      <?php require_once './components/admin/sidebar.php' ?>

      <div class="w-5/6 ">
   <?php require_once './components/navDashboard.php' ?>
      <div class="mx-auto ">
         <div class="m-4 rounded bg-gray-50 min-h-screen  p-6  overflow-hidden">

            <form method="post" class="grid gap-4">
               <div class="flex flex-col gap-2">
                  <label for="judul">Nama</label>
                  <input type="text" name="nama" id="" class="input input-bordered">
               </div>
               <div class="flex flex-col gap-2">
                  <label for="konten">Bio</label>
                  <textarea name="bio" id="" cols="30" rows="10" class="textarea textarea-bordered textarea-lg"></textarea>
               </div>
               <div class="flex flex-col gap-2">
                  <label for="penulis_id">Profil</label>
                  <input type="text" name="profil" id="" class="input input-bordered">
               </div>
               <div>
                  <button type="submit" class="btn btn-primary">Tambah Penulis</button>
               </div>
            </form> 
         </div>
      </div>
      </div>
      
   </div>
   
</body>
</html>
```
edit.php
Halaman untuk edit data penulis
```php
<?php
$penulis=$data-> fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tambah Penulis</title>
</head>
<body class="min-h-screen" data-theme="garden">
   <div class="flex min-h-screen">

      <?php require_once './components/sideDashboard.php' ?>
<
      <div class="w-5/6 ">
   <?php require_once './components/navDashboard.php' ?>
      <div class="mx-auto ">
         <div class="m-4 rounded bg-gray-50 min-h-screen  p-6  overflow-hidden">

            <form method="post" class="grid gap-4">
               <div class="flex flex-col gap-2">
                  <label for="judul">Nama</label>
                  <input type="text" name="nama" id="" class="input input-bordered" value="<?=$penulis['nama']?>">
               </div>
               <div class="flex flex-col gap-2">
                  <label for="konten">Bio</label>
                  <textarea name="bio" id="" cols="30" rows="10" class="textarea textarea-bordered textarea-lg" value=""><?=$penulis['bio']?></textarea>
               </div>
               <div class="flex flex-col gap-2">
                  <label for="penulis_id">Profil</label>
                  <input type="text" name="profil" id="" class="input input-bordered" value ="<?=$penulis['profil']?>">
               </div>
               <div>
                  <button type="submit" class="btn btn-primary">Edit Penulis</button>
               </div>
            </form> 
         </div>
      </div>
      </div>
      
   </div>
   
</body>
</html>
```

editSuccesPenulis.php
kode untuk memberikan pesan notifikasi setelah data berhasil diedit. lalu akan otomatis kembali ke halaman daftar penulis 
```php
<?php 
$current_url = $_SERVER['REQUEST_URI'];
$url_parts = explode('/', $current_url);
$dashboard_id = isset($url_parts[2]) ? $url_parts[2] : '1';

echo "<script>
  alert('Data Mahasiswa berhasil di edit')
  location.href = '/dashboard/{$dashboard_id}/penulis'

</script>";
echo  "Haruse berhasil sih cok";
?>
```

deletePenulis.php
memberikan notifikasi menggunakan SweetAlert setelah daata penulis berhasil dihapus. lalu akan otomatis diarahkan ke daftar penulis lagi
```php
<?php 
$current_url = $_SERVER['REQUEST_URI'];
$url_parts = explode('/', $current_url);
$dashboard_id = isset($url_parts[2]) ? $url_parts[2] : '1';

echo "<script>
 Swal.fire({
  title: 'Good job!',
  text: 'Penulis telah dihapus',
  icon: 'success'
});
  location.href = '/dashboard/{$dashboard_id}/penulis'

</script>";
echo  "Haruse berhasil sih cok";
?>
`


## CRUD Kategori
### CONFIG (database.php)

```
<?php 

//Koneksi ke database pweb2kel4
namespace Config;
use mysqli;
use mysqli_sql_exception;
class Database{
   protected $conn;
   public function __construct() {
    $host = 'mdi.my.id';
    $db   = 'basdeat2_klp4';
    $user = 'basdeat2_usr4';
    $pass = '7.8fBotqbm&C~*.@#h';


    $this->conn = new mysqli($host, $user, $pass, $db);
    if($this->conn->connect_error) die('Koneksi error karena : '. $this->conn->connect_error);

  }
} 
```
1. Kode PHP di atas mendefinisikan kelas 'Database' di namespace 'Config'. Kelas ini digunakan untuk terhubung ke database 'basdeat2_klp4' di server 'mdi.my.id'.
2. Di dalam kelas ini terdapat construktor (`__construct`) yang secara otomatis dieksekusi ketika objek 'Database' dibuat. Construktor ini menyimpan informasi yang diperlukan untuk terhubung, seperti nama host ('$host'), nama database ('$db'), nama pengguna ('$user'), dan kata sandi ('$pass') .
3. Kelas mysqli membuat koneksi ke database dengan parameter yang telah ditentukan sebelumnya dan menyimpan objek koneksi di properti `$conn` untuk digunakan dalam operasi database lainnya.
4. Jika terjadi kesalahan selama koneksi, kode akan segera menampilkan pesan kesalahan dan menghentikan program yang berjalan. Kelas ini dimaksudkan untuk memfasilitasi pengelolaan koneksi database secara terstruktur dan menghindari pengulangan kode koneksi.


### Models
#### Model.php

```
<?php
//mendefinisikan nama class folder agar bisa dipakai ooleh file lain
namespace App\Models;
use Config\Database;

//class turunan dari database
class Model extends Database {
    protected $table;
    protected $select = "*";
    protected $joins = [];
    protected $where = [];
    
    //memanggil construct dari parent
    public function __construct() {
        parent::__construct();
    }

    //method insert
    public function insert($data) {
        $columns = implode(", ", array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
        return $this->conn->query($query) or die("Error: " . $this->conn->error);
    }

    //method delete
    public function delete($column,$id) {
        $query = "DELETE FROM {$this->table} WHERE {$column}='{$id}'";
        return $this->conn->query($query) or die("Error: " . $this->conn->error);
    }

    public function all() {
        $query = "SELECT * FROM {$this->table}";
        return $this->conn->query($query);
    }

    public function find($column,$id) {
        $query = "SELECT * FROM {$this->table} WHERE {$column}='{$id}'";
        $result = $this->conn->query($query);
        return $result;
    }

    //method update
    public function update($column,$id, $data) {
        $updates = [];
        foreach($data as $key => $value) {
            $updates[] = "{$key}='{$value}'";
        }
        $updates = implode(", ", $updates);
        $query = "UPDATE {$this->table} SET {$updates} WHERE {$column}='{$id}'";
        return $this->conn->query($query) or die("Error: " . $this->conn->error);
    }

    //method mencari data
    public function where($column, $value) {
        $this->where[] = "{$column}='{$value}'";
        return $this;
    }

    //method memilih
    public function select($columns) {
        if (is_array($columns)) {
            $this->select = implode(', ', $columns);
        } else {
            $this->select = $columns;
        }
        return $this;
    }

    //method menggabungkan table
    public function join($table, $first, $operator, $second, $type = 'INNER') {
        $this->joins[] = sprintf(' %s JOIN %s ON %s %s %s', 
            $type, $table, $first, $operator, $second
        );
        return $this;
    }
 

    public function leftJoin($table, $first, $operator, $second) {
        return $this->join($table, $first, $operator, $second, 'LEFT');
    }

    public function rightJoin($table, $first, $operator, $second) {
        return $this->join($table, $first, $operator, $second, 'RIGHT');
    }

    //method ambil data 
    public function get() {
        $query = "SELECT {$this->select} FROM {$this->table}";
        
        if (!empty($this->joins)) {
            $query .= implode(' ', $this->joins);
        }

        if (!empty($this->where)) {
            $query .= ' WHERE ' . implode(' AND ', $this->where);
        }

        $this->select = "*";
        $this->joins = [];
        $this->where = [];

        return $this->conn->query($query);
    } 
}
```

1. Kode PHP di atas mendefinisikan  kelas yang disebut "Model" di namespace "App\Models". Kelas ini bertindak sebagai kelas turunan dari "Database" dan menyediakan berbagai metode untuk mengelola data dalam database.
2. Kelas ini menggunakan koneksi database dari kelas "Database", yang diperoleh melalui perintah `parent: : __construct()` di construktor. Hal ini memungkinkan "model" untuk  mengakses database secara langsung melalui `$conn.`
3. Metode utama yang tersedia di kelas ini adalah ``insert'', ``delete'', ``all'', ``find'', ``update'', ``where'', ``select' '`, dan `join''`, yang masing-masing memiliki CRUD.
4. Metode `insert` digunakan untuk menambahkan data baru dan metode Hapus menghapus data berdasarkan kolom tertentu.
5. Metode `all` mengembalikan semua data dalam tabel, sedangkan metode `find` mencari data berdasarkan kolom dan nilai tertentu.
6. Metode  `update` memperbarui data berdasarkan kolom tertentu, dan `where` digunakan untuk menambahkan kondisi ke query yang dibuat.
7. Metode `select` memungkinkan pengguna memilih kolom tertentu untuk diambil. `join`, `leftJoin`,  `rightJoin` digunakan untuk menggabungkan tabel lain dalam query dengan tipe gabungan berbeda (INNER, LEFT, atau menghubungkan koneksi yang benar).
8. Metode `get` mengeksekusi query dan mengembalikan hasilnya. Setelah query dijalankan, variabel dalam kelas `select`, `join`, dan `where` direset sebagai persiapan untuk query berikutnya. Kelas "model" ini dimaksudkan untuk menyederhanakan manajemen database dengan menyediakan cara modular dan fleksibel untuk membangun dan mengeksekusi query.

#### Kategori.php

```
<?php 
//menunjukkan bahwa kelas Kategori berada dalam namespace App\Models, 
//yang memudahkan pengelompokan kode terkait dan menghindari konflik nama dengan kelas lain.
namespace App\Models;

use App\Models\Model;

class Kategori extends Model {
   //mengatur agar model Kategori otomatis menggunakan tabel kategori di database.
   public function __construct(){
      parent::__construct();
      $this->table = "kategori";
   }
}
```

1. Kode PHP di atas mendefinisikan kelas "Kategori" di namespace "App\Models". Digunakan untuk mengelompokkan kode secara terstruktur dan mencegah konflik nama kelas.
2. Kategori merupakan turunan dari kelas Model, maka kategori tersebut dapat mewarisi semua metode dan properti kelas induknya hingga kemampuan mengakses dan mengelola database menggunakan berbagai metode CRUD.
3. Dalam construktor `__construct`, kelas Kategori memanggil construktor kelas parent (`induk:: __construct()`) untuk memastikan bahwa koneksi ke database telah diinisialisasi.
4. Atribut $table diatur ke nilai "kategori" dan semua query secara otomatis dialihkan ke tabel "kategori" di database. Oleh karena itu, kelas Kategori dirancang untuk secara efisien melakukan operasi database tertentu pada tabel Kategori tanpa harus menentukan nama tabel secara manual untuk setiap operasi.

### Controllers (DashboardController.php untuk kategori)

```
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

   public function listKategori($id){
      $result = $this->kategori->all();
      return $this->render(view: 'dashboard/kategori', data: ['kategori' => $result]);
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

   public function deleteKategori($id) {
      // Cek apakah kategori sedang digunakan oleh artikel
      $artikel = $this->artikel->find('kategori_id', $id);
  
      // Jika kategori sedang digunakan oleh artikel
      if ($artikel && $artikel->num_rows > 0) {
         //  echo json_encode([
         //      'status' => 'error',
         //      'message' => 'Kategori tidak dapat dihapus karena sedang digunakan oleh artikel.'
         //  ]);

          echo "<script>
          alert('kategori sedang digunakan')
          location.href= '/dashboard/admin/kategori'
          </script>";
         return;
          //return $this->render('/dashboard/admin/kategori');
      }
  
      // Hapus kategori jika tidak digunakan
      $result = $this->kategori->delete("id_kategori", $id);
  
      if ($result) {
          //echo json_encode([
              //'status' => 'success',
              //'message' => 'Kategori berhasil dihapus.'
          //]);
      //} else {
          //echo json_encode([
              //'status' => 'error',
              //'message' => 'Gagal menghapus kategori.'
          //]);
          echo "<script>
          alert('kategori berhasil dihapus')
          location.href= '/dashboard/admin/kategori'
          </script>";
         return;
      }
  }
  
   public function editPageKategori($id){
      $result = $this->kategori->find('id_kategori', $id);
      $kategori= $this->kategori->all();
      return $this->render('dashboard/admin/editPageKategori', ['data'=>$result, 'kategori'=>$kategori]);
   }

   public function kategoriUpdate($id){
      $result = $this->kategori->update('id_kategori', $id, $_POST);
      if($result){
         $this->render('dashboard/admin/editSuccesKategori', ['']);
      }
   }
}
```

1. Kode PHP di atas mendefinisikan kelas `DashboardController` dalam namespace App\Controllers , yang berfungsi sebagai pengontrol utama untuk mengelola halaman dasbor dalam aplikasi. Kelas ini merupakan turunan dari `Controller`, sehingga memiliki akses ke metode dan properti di kelas induknya, seperti kemampuan untuk merender tampilan halaman.
2. Kelas `DashboardController` memanfaatkan beberapa model, yaitu `Penulis`, `Artikel`, `Komentar`, dan `Kategori`. Pada construktor `__construct`, beberapa properti diinisialisasi untuk menyimpan dari model-model dan memungkinkan akses ke data yang terkait dengan masing-masing model. Beberapa metode dalam kelas ini mengelola berbagai halaman dan operasi yang terkait dengan kategori dan penulis, serta mengatur tampilan halaman untuk pengguna dan admin.
3. Metode `index($id)` menampilkan halaman dashboard pengguna dengan mengambil data penulis berdasarkan `id_penulis`. Metode `listKategori($id)` dan `listKategoriAdmin()` masing-masing menampilkan daftar kategori untuk pengguna dan admin. `indexAdmin()` menampilkan halaman dashboard khusus admin. Metode `insertPageKategori()` menampilkan halaman untuk menambahkan kategori baru, sementara `kategoriStore()` menyimpan kategori baru ke database dengan data dari form POST.
4. Metode `deleteKategori($id)` menghapus kategori, tetapi sebelum melakukannya, ia memeriksa apakah kategori tersebut sedang digunakan oleh artikel. Jika digunakan, akan muncul pesan kesalahan, dan jika tidak, kategori dihapus dari database. 
5. Metode `editPageKategori($id)` mengambil data kategori yang ingin diedit dan menampilkannya di halaman edit. 
6. Metode `kategoriUpdate($id)` memperbarui data kategori di database berdasarkan perubahan yang dibuat oleh pengguna dan merender halaman konfirmasi. Kelas ini dirancang untuk mengelola tampilan dan data terkait kategori, artikel, dan pengguna di halaman dasbor, baik untuk pengguna umum maupun admin, dengan menyediakan operasi dasar seperti insert, delete, dan update.

### Views
#### /dashboard/admin/kategori.php

```
<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Kategori</title>
</head>
<body class="min-h-screen" data-theme="garden">
    <div class="flex min-h-screen">
        <?php require_once './components/admin/sidebar.php'; ?>
        
        <div class="flex-1 flex flex-col">
            <?php require_once './components/navDashboard.php'; ?>
            
            <div class="m-4 rounded bg-gray-50 p-6  flex-1">
                    <h1 class="text-2xl font-bold mb-6">Kategori Artikel</h1>
                    <a href="/dashboard/<?= $dashboard_id?>/kategori/tambah" class="btn btn-primary btn-outline">Tambah Kategori</a>
                        <table id="myTable" class="display border border-gray-400">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php 
                                $no = 1; 
                                foreach($kategori as $row): 
                                ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($no++) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($row['nama_kategori']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                    <button class="btn btn-sm btn-error btn-outline" onclick="confirmDelete(<?=$row['id_kategori']?>)">Hapus</button>
                                        <a href="/dashboard/admin/kategori/edit/<?=$row['id_kategori']?>" class="btn btn-sm btn-info">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
            </div>
            
        </div>

    </div>

    <script>
      function confirmDelete(id) {
         Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus!',
            cancelButtonText: 'Batal'
         }).then((result) => {
            if (result.isConfirmed) {
               // Redirect to the delete URL
               window.location.href = '/dashboard/admin/kategori/' + id;
            }
         });
      }
   </script>
</body>
</html>
```

1. Kode HTML di atas membangun halaman daftar kategori artikel di dalam dasbor admin. Halaman memiliki judul "List Kategori".
2. Pada bagian halaman utama, terdapat sidebar dan navbar, yang masing-masing disertakan melalui file `sidebar.php` dan `navDashboard.php` menggunakan `require_once`. Terdapat tabel yang menampilkan data kategori artikel, dengan kolom-kolom untuk nomor urut, nama kategori, serta aksi yang dapat dilakukan, yaitu edit dan hapus. Setiap baris pada tabel menampilkan informasi kategori, sementara tombol "Tambah Kategori" memungkinkan admin untuk menuju halaman untuk menambahkan kategori baru.
3. Fungsi `confirmDelete()` menggunakan library `SweetAlert` untuk menampilkan dialog konfirmasi sebelum data dihapus. Jika pengguna mengonfirmasi penghapusan, mereka akan diarahkan ke URL penghapusan yang relevan untuk memproses penghapusan data.

#### /dashboar/admin/deleteKategori.php
```
<?php 
$current_url = $_SERVER['REQUEST_URI'];
$url_parts = explode('/', $current_url);
$dashboard_id = isset($url_parts[2]) ? $url_parts[2] : '1';

echo "<script>
 Swal.fire({
  title: 'Good job!',
  text: 'Kategori telah dihapus',
  icon: 'success'
});
  location.href = '/dashboard/{$dashboard_id}/kategori'

</script>";
echo  "Haruse berhasil sih cok";
?>
```

Kode PHP diatas untuk menampilkan notifikasi bahwa kategori telah dihapus, kemudian mengarahkan pengguna kembali ke halaman kategori pada dasbor.

#### /dashboard/admin/editPageKategori.php
```
<?php
$data=$data->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Kategori</title>
</head>
<body class="min-h-screen" data-theme="garden">
   <div class="flex min-h-screen">

      <?php require_once './components/admin/sidebar.php' ?>
      <div class="w-4/5 ">
   <?php require_once './components/navDashboard.php' ?>
      <div class="mx-auto ">
         <div class="bg-gray-100 min-h-screen border border-dotted border-black  p-6 mx-auto rounded-sm overflow-hidden">
            <form method="post" class="grid gap-4">
               <div class="flex flex-col gap-2">
                  <label for="judul">Nama Kategori</label>
                  <input type="text" name="nama_kategori" id="" class="input input-bordered" value="<?=$data['nama_kategori']?>">
               </div>
               <div>
                  <button type="submit" class="btn btn-primary">Edit Kategori</button>
               </div>
            </form> 
         </div>
      </div>
      </div>
      
   </div>
   
</body>
</html>
```
1. Kode PHP yang diberikan membuat halaman web untuk mengedit nama kategori dalam dashboard admin. Kode ini mengambil data kategori dari database menggunakan metode `fetch_assoc()` dan mengisi dengan nama yang ada saat ini. 
2. Terdapat kolom input untuk nama kategori yang dapat diedit, yang sudah terisi dengan nama saat ini. 
3. Terdapat juga tombol "Edit Kategori" yang, ketika diklik, akan mengirim data yang diperbarui ke server menggunakan metode POST.

#### /dashboard/admin/editSuccesKategori.php
```
<?php 
$current_url = $_SERVER['REQUEST_URI'];
$url_parts = explode('/', $current_url);
$dashboard_id = isset($url_parts[2]) ? $url_parts[2] : '1';

echo "<script>
  alert('Data Kategori berhasil di edit')
  location.href = '/dashboard/{$dashboard_id}/kategori'

</script>";
echo  "Haruse berhasil sih cok";
?>
```

Kode PHP di atas digunakan untuk menampilkan pesan konfirmasi setelah data kategori berhasil diedit.

#### /dashboard/admin/insertKategori.php
```
<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tambah Kategori</title>
</head>
<body class="min-h-screen" data-theme="garden">
   <div class="flex min-h-screen">

      <?php require_once './components/admin/sidebar.php' ?>

      <div class="w-5/6 ">
   <?php require_once './components/navDashboard.php' ?>
      <div class="mx-auto ">
         <div class="m-4 rounded bg-gray-50 min-h-screen  p-6  overflow-hidden">

            <form method="post" class="grid gap-4">
               <div class="flex flex-col gap-2">
                  <label for="judul">Kategori</label>
                  <input type="text" name="nama_kategori" id="" class="input input-bordered">
               </div>
               <div>
                  <button type="submit" class="btn btn-primary">Tambah Kategori</button>
               </div>
            </form> 
         </div>
      </div>
      </div>
      
   </div>
   
</body>
</html>
```
1. Kode PHP di atas menciptakan sebuah halaman web untuk menambahkan kategori baru dalam dasbor admin. 
2. Halaman ini memiliki kolom input untuk nama kategori dan sebuah tombol "Tambah Kategori" untuk mengirimkan data ke server menggunakan metode POST.

### Routes (index.php untuk kategori)
```
<?php

use App\Controllers\ArtikelController;
use App\Controllers\DashboardController;
use App\Router;

$router = new Router();
$router->get('/dashboard/admin', DashboardController::class, 'indexAdmin');
$router->get('/dashboard/admin/kategori/tambah', DashboardController::class, 'insertPageKategori');
$router->post('/dashboard/admin/kategori/tambah', DashboardController::class, 'kategoriStore');
$router->get('/dashboard/admin/kategori/{id}', DashboardController::class, 'deleteKategori');
$router->get('/dashboard/admin/kategori/edit/{id}', DashboardController::class,'editPageKategori');
$router->post('/dashboard/admin/kategori/edit/{id}', DashboardController::class,'kategoriUpdate');
$router->get('/dashboard/admin/kategori', DashboardController::class, 'listKategoriAdmin');
$router->dispatch();
```
1. Kode PHP di atas mengatur routing untuk sebuah aplikasi web dengan menggunakan pendekatan Model-View-Controller (MVC). `Router` dibuat untuk menangani berbagai rute yang mengarahkan permintaan HTTP ke metode yang sesuai dalam `DashboardController`. 
2. GET `/dashboard/admin`, yang mengarahkan permintaan ke metode `indexAdmin`, kemungkinan untuk menampilkan halaman utama admin.
3. GET `/dashboard/admin/kategori/tambah`, mengarahkan ke metode `insertPageKategori`, yang menampilkan formulir untuk menambahkan kategori baru. 
4. POST `/dashboard/admin/kategori/tambah` digunakan untuk memproses penyimpanan kategori baru melalui metode `kategoriStore`. 
5. GET `/dashboard/admin/kategori/{id}` mengarahkan ke metode `deleteKategori` untuk menghapus kategori berdasarkan ID yang diberikan. 
6. GET `/dashboard/admin/kategori/edit/{id}` digunakan untuk menampilkan formulir pengeditan kategori, 
7. POST `/dashboard/admin/kategori/edit/{id}` memproses pembaruan kategori menggunakan metode `kategoriUpdate`. 
8. GET `/dashboard/admin/kategori` mengarahkan ke metode `listKategoriAdmin` untuk menampilkan daftar semua kategori yang ada. Pada kode akhir pemanggilan `dispatch()`, yang berfungsi untuk memproses rute sesuai dengan permintaan yang diterima, secara keseluruhan mengatur alur logika pengendalian untuk manajemen kategori dalam dasbor admin.



## CRUD Komentar (Mode Admin dan Pengguna)
Pada mode admin hanya bisa menghapus data komentar saja.
Sedangkan mode pengguna bisa tambah,hapus,edit.
### Config.php
Koneksi ke database mysqli
```
<?php 
namespace Config;
use mysqli;
use mysqli_sql_exception;
class Database{
   protected $conn;
   public function __construct() {
    $host = 'mdi.my.id';
    $db   = 'basdeat2_klp4';
    $user = 'basdeat2_usr4';
    $pass = '7.8fBotqbm&C~*.@#h';


    $this->conn = new mysqli($host, $user, $pass, $db);
    if($this->conn->connect_error) die('Koneksi error karena : '. $this->conn->connect_error);

  }
} 
```
Kode di atas adalah kelas `Database` dalam PHP yang digunakan untuk mengatur koneksi ke database MySQL menggunakan ekstensi `mysqli`.

- `namespace Config;`: Mendefinisikan namespace `Config` untuk kelas ini, sehingga kelas ini dapat dipanggil dengan `Config\Database`.
- `use mysqli;` dan `use mysqli_sql_exception;`: Mengimpor kelas `mysqli` untuk koneksi dan `mysqli_sql_exception` untuk menangani error khusus MySQLi (meskipun `mysqli_sql_exception` tidak digunakan dalam kode ini).
- `class Database{ ... }`: Mendeklarasikan kelas `Database`.
- `protected $conn;`: Mendefinisikan properti `$conn` untuk menyimpan objek koneksi ke database.
- `public function __construct() { ... }`: Mendefinisikan konstruktor yang otomatis dijalankan saat objek dibuat.
- Dalam konstruktor:
  - Variabel `host`, `db`, `user`, dan `pass` menyimpan informasi koneksi database, seperti alamat host, nama database, username, dan password.
  - `$this->conn = new mysqli($host, $user, $pass, $db);`: Membuat koneksi ke database menggunakan data di atas.
  - `if($this->conn->connect_error) die('Koneksi error karena : '. $this->conn->connect_error);`: Memeriksa apakah terjadi error saat koneksi. Jika ya, tampilkan pesan error dan hentikan eksekusi kode.

Kode ini berfungsi untuk memastikan koneksi ke database berhasil dibuat saat objek `Database` diinisialisasi.

### Models
#### Model.php
```
<?php
//mendefinisikan nama class folder agar bisa dipakai ooleh file lain
namespace App\Models;
use Config\Database;

//class turunan dari database
class Model extends Database {
    protected $table;
    protected $select = "*";
    protected $joins = [];
    protected $where = [];
    
    //memanggil construct dari parent
    public function __construct() {
        parent::__construct();
    }

    //method insert
    public function insert($data) {
        $columns = implode(", ", array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
        return $this->conn->query($query) or die("Error: " . $this->conn->error);
    }

    //method delete
    public function delete($column,$id) {
        $query = "DELETE FROM {$this->table} WHERE {$column}='{$id}'";
        return $this->conn->query($query) or die("Error: " . $this->conn->error);
    }

    public function all() {
        $query = "SELECT * FROM {$this->table}";
        return $this->conn->query($query);
    }

    public function find($column,$id) {
        $query = "SELECT * FROM {$this->table} WHERE {$column}='{$id}'";
        $result = $this->conn->query($query);
        return $result;
    }

    //method update
    public function update($column,$id, $data) {
        $updates = [];
        foreach($data as $key => $value) {
            $updates[] = "{$key}='{$value}'";
        }
        $updates = implode(", ", $updates);
        $query = "UPDATE {$this->table} SET {$updates} WHERE {$column}='{$id}'";
        return $this->conn->query($query) or die("Error: " . $this->conn->error);
    }

    //method mencari data
    public function where($column, $value) {
        $this->where[] = "{$column}='{$value}'";
        return $this;
    }

    //method memilih
    public function select($columns) {
        if (is_array($columns)) {
            $this->select = implode(', ', $columns);
        } else {
            $this->select = $columns;
        }
        return $this;
    }

    //method menggabungkan table
    public function join($table, $first, $operator, $second, $type = 'INNER') {
        $this->joins[] = sprintf(' %s JOIN %s ON %s %s %s', 
            $type, $table, $first, $operator, $second
        );
        return $this;
    }
 

    public function leftJoin($table, $first, $operator, $second) {
        return $this->join($table, $first, $operator, $second, 'LEFT');
    }

    public function rightJoin($table, $first, $operator, $second) {
        return $this->join($table, $first, $operator, $second, 'RIGHT');
    }

    //method ambil data 
    public function get() {
        $query = "SELECT {$this->select} FROM {$this->table}";
        
        if (!empty($this->joins)) {
            $query .= implode(' ', $this->joins);
        }

        if (!empty($this->where)) {
            $query .= ' WHERE ' . implode(' AND ', $this->where);
        }

        $this->select = "*";
        $this->joins = [];
        $this->where = [];

        return $this->conn->query($query);
    } 
}
```
Kode ini mendefinisikan kelas `Model` yang berfungsi sebagai model dasar untuk operasi CRUD di database menggunakan konsep OOP dalam PHP. Kelas ini merupakan turunan dari `Database` sehingga otomatis mewarisi koneksi ke database.

- **Namespace dan Inheritance**: 
  - `namespace App\Models;` menentukan lokasi `Model` dalam namespace `App\Models`.
  - `class Model extends Database` mewarisi semua metode dan properti dari kelas `Database`.

- **Properti Utama**:
  - `$table`: Menyimpan nama tabel yang akan diakses.
  - `$select`, `$joins`, dan `$where`: Menyimpan bagian query SQL seperti kolom yang dipilih (`select`), kondisi penggabungan tabel (`joins`), dan kondisi pencarian (`where`).

- **Metode CRUD**:
  - `insert($data)`: Menambahkan data baru ke tabel berdasarkan array `data`.
  - `delete($column, $id)`: Menghapus data berdasarkan kolom dan id tertentu.
  - `update($column, $id, $data)`: Memperbarui data berdasarkan kolom, id, dan array data baru.
  - `all()`: Mengambil semua data dari tabel.
  - `find($column, $id)`: Mengambil satu data berdasarkan kolom dan id.

- **Query Builder**:
  - `where($column, $value)`: Menambahkan kondisi pencarian.
  - `select($columns)`: Memilih kolom spesifik untuk diambil dari tabel.
  - `join`, `leftJoin`, `rightJoin`: Menggabungkan tabel lain dalam query dengan berbagai tipe join (`INNER`, `LEFT`, `RIGHT`).
  - `get()`: Menyusun dan mengeksekusi query berdasarkan kondisi `select`, `joins`, dan `where`.

Metode-metode ini dirancang untuk mempermudah operasi query yang sering digunakan, sehingga kode menjadi lebih rapi dan fleksibel.

#### Komentar.php
```
<?php
namespace App\Models;
class Komentar extends Model{
   public function __construct()
   {
    parent :: __construct();  
    $this->table = "komentar";
   }
}
?>
```

Kode ini mendefinisikan kelas `Komentar` yang merupakan turunan dari kelas `Model` dalam namespace `App\Models`.

- **Namespace dan Inheritance**:
  - `namespace App\Models;` menetapkan lokasi `Komentar` dalam namespace `App\Models`.
  - `class Komentar extends Model` menyatakan bahwa `Komentar` mewarisi semua metode dan properti dari kelas `Model`, termasuk koneksi database dan fungsi CRUD.

- **Konstruktor**:
  - `public function __construct()` mendefinisikan konstruktor untuk kelas `Komentar`.
  - `parent::__construct();` memanggil konstruktor dari kelas `Model`, memastikan koneksi database siap digunakan.
  - `$this->table = "komentar";` menetapkan nama tabel yang akan digunakan oleh model ini, yaitu tabel `komentar`.

Kelas `Komentar` ini siap untuk menjalankan operasi CRUD di tabel `komentar` menggunakan fungsi-fungsi yang diwarisi dari `Model`.

### Controllers
#### DashboardController.php
```
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

   public function listKomentar($id){
      $result = $this->komentar->all();
      return $this->render(view: 'dashboard/komentar', data: ['data' => $result]);

   }

   public function listKomentarAdmin(){
      $result = $this->komentar->all();
      return $this->render(view: 'dashboard/admin/komentar', data: ['data' => $result]);
   }

   public function deleteKomentarAdmin($id){
      $result = $this->komentar->delete('id_komentar', $id);
      return $this->render('/dashboard/admin/deleteKomentar');
   }

   public function listKategoriAdmin(){
      $result = $this->kategori->all();
      return $this->render(view: 'dashboard/admin/kategori', data: ['kategori' => $result]);
   }

   public function insertPageKomentar($id){
      $result = $this->komentar->find('artikel_id', $id);
      $artikel = $this->artikel->all();
      $username = $this->penulis->find('id_penulis', $id);
      return $this->render('dashboard/insertKomentar',['artikel'=>$artikel, 'uid'=>$username->fetch_assoc()]);
   }

   public function komentarStore($id){
      $result = $this->komentar->insert($_POST);
      if($result){
         echo "<script>
         alert('Data Komentar berhasil di tambah')
         location.href = '/dashboard/{$id}/komentar' </script>" 
        ;
      }
   }

   public function deleteKomentar($id,$kid){
      $result = $this->komentar->delete('id_komentar', id: $kid);
      return $this->render("/dashboard/deleteKomentar");
   }

   public function editPageKomentar($id,$kid){
      $result = $this->komentar->find('id_komentar', $kid);
      $artikel = $this->artikel->all();
      return $this->render('dashboard/editKomentar',['data'=>$result 'artikel'=>$artikel]);
   }

   public function komentarUpdate($id,$kid){
      $result = $this->komentar->update('id_komentar', $kid, $_POST);
      if($result){
         $this->render('dashboard/editSuccessKomentar', ['']);
      }
   }
}
```
Kode PHP di atas adalah definisi dari `DashboardController`, sebuah class yang digunakan untuk mengelola halaman dashboard di aplikasi. Class ini merupakan turunan dari `Controller` dan mengatur interaksi dengan berbagai model, yaitu `Penulis`, `Artikel`, `Komentar`, dan `Kategori`. Berikut penjelasan setiap method dalam class ini:

1. **`__construct()`**: 
   Constructor yang menginisialisasi objek untuk setiap model (`Penulis`, `Artikel`, `Komentar`, `Kategori`) agar dapat digunakan dalam method-method lain di `DashboardController`.

2. **`index($id)`**:
   Menampilkan halaman dashboard utama untuk penulis berdasarkan `id` yang diterima sebagai parameter. Method ini mengambil data penulis dan meneruskannya ke view `dashboard/index`.
tikel Id</td>
               <td>Aksi</td>irim menggunakan metode `POST`.

5. **Penutupan Elemen HTML**:
   ```html
   </div>
   </div>
   </div>
   </body>engguna untuk menambah komentar baru dengan memilih artikel dan mengisi informasi komentar. Data username ditampilkan secara otomatis dan tidak bisa diubah.

### Routes
#### Index.php
```
<?php

use App\Controllers\ArtikelController;
use App\Controllers\DashboardController;
use App\Router;

$router = new Router();

//DELETE KOMENTAR (ADMIN)
$router->get('/dashboard/admin/komentar/{id}', DashboardController::class, "deleteKomentarAdmin");
$router->get('/dashboard/{id}/komentar', DashboardController::class, "listKomentar");

//CRUD KOMENTAR
$router->get('/dashboard/{id}/komentar/tambah', DashboardController::class, 'insertPageKomentar');
$router->post('/dashboard/{id}/komentar/tambah', DashboardController::class, 'komentarStore');
$router->get('/dashboard/{id}/komentar/hapus/{kid}', DashboardController::class, 'deleteKomentar');
$router->get('/dashboard/{id}/komentar/edit/{kid}', DashboardController::class, 'editPageKomentar');
$router->post('/dashboard/{id}/komentar/edit/{kid}', DashboardController::class,'komentarUpdate');

$router->get('/dashboard/admin/komentar/{kid}', DashboardController::class, 'deleteKomentarAdmin');
$router->dispatch();
```
Kode ini adalah konfigurasi routing untuk mengelola operasi komentar di aplikasi. Berikut penjelasan singkat dari setiap bagian:

1. **Inisialisasi Router**:
   ```php
   $router = new Router();
   ```
   - Membuat instance router untuk menangani rute HTTP.

2. **Rute Penghapusan Komentar oleh Admin**:
   ```php
   $router->get('/dashboard/admin/komentar/{id}', DashboardController::class, "deleteKomentarAdmin");
   ```
   - Mengarahkan permintaan `GET` ke `deleteKomentarAdmin` dalam `DashboardController` untuk menghapus komentar sebagai admin.

3. **Rute Menampilkan Komentar**:
   ```php
   $router->get('/dashboard/{id}/komentar', DashboardController::class, "listKomentar");
   ```
   - Menampilkan daftar komentar berdasarkan `id` dashboard.

4. **Rute CRUD Komentar**:
   - **Tambah Komentar**:
     ```php
     $router->get('/dashboard/{id}/komentar/tambah', DashboardController::class, 'insertPageKomentar');
     $router->post('/dashboard/{id}/komentar/tambah', DashboardController::class, 'komentarStore');
     ```
     - Menampilkan halaman tambah komentar (GET) dan menyimpan komentar baru (POST).

   - **Hapus Komentar**:
     ```php
     $router->get('/dashboard/{id}/komentar/hapus/{kid}', DashboardController::class, 'deleteKomentar');
     ```
     - Menghapus komentar berdasarkan ID komentar (`kid`).

   - **Edit Komentar**:
     ```php
     $router->get('/dashboard/{id}/komentar/edit/{kid}', DashboardController::class, 'editPageKomentar');
     $router->post('/dashboard/{id}/komentar/edit/{kid}', DashboardController::class,'komentarUpdate');
     ```
     - Menampilkan halaman edit komentar (GET) dan memperbarui komentar (POST).

5. **Menjalankan Router**:
   ```php
   $router->dispatch();
   ```
   - Memproses permintaan sesuai dengan rute yang telah ditentukan. 

Kode ini mengatur rute untuk mengelola komentar, termasuk menambah, mengedit, dan menghapus komentar di dashboard.

   </html>truktur halaman.

Secara keseluruhan, halaman ini memungkinkan p
   ```
   - Menutup elemen yang dibuka sebelumnya, menyelesaikan s
            </tr>
         </thead>
              mengandung input untuk `username` (readonly), `isi komentar`, dan dropdown untuk memilih `artikel_id`.
   - Dropdown menampilkan semua artikel yang diambil dari variabel `$artikel`, setiap opsi memiliki `id_artikel` sebagai nilai dan `judul` sebagai tampilan.
   - Ketika tombol "Tambah Komentar" ditekan, data akan dik  <div class="flex flex-col gap-2">
                  <label for="isi">Isi Komentar</label>
                  <input type="text" name="isi_komentar" id="" class="input input-bordered">
               </div>
               <div class="flex flex-col gap-2">
                  <label for="id">Artikel ID</label>
                  <select name="artikel_id" id="" class="select select-bordered">
                     <?php foreach($artikel as $row) : ?>
                        <option value="<?=$row['id_artikel']?>"><?=$row['judul']?></option>
                     <?php endforeach?>
                  </select>
               </div>
               <div>2">
         <label for="isi">Isi Komentar</label>
         <input type="text" name="isi_komentar" class="input input-bordered">
      </div>
      <div class="flex flex-col gap-2">
         <label for="id">Artikel ID</label>
         <select name="artikel_id" class="select select-bordered">
            <?php foreach($artikel as $row) : ?>
               <option value="<?=$row['id_artikel']?>"><?=$row['judul']?></option>
            <?php endforeach?>
         </select>
      </div>
      <div>
         <button type="submit" class="btn btn-primary">Tambah Komentar</button>
      </div>
   </form>
   ```
   - Form ini
                  <button type="submit" class="btn btn-primary">Tambah Komentar</button>
               </div>
            </form> 
         </div>
      </div>
      </div>
      
   </div>
   
</body>
</html>
```
Kode ini adalah halaman untuk menambah komentar dalam aplikasi berbasis web. Berikut adalah penjelasan singkat mengenai setiap bagian:
tml
   <form method="post" class="grid gap-4">
      <div class="flex flex-col gap-2">
         <label for="isi">Username</label>
         <input type="text" name="username" class="input input-bordered" value="<?=$uid['nama']?>" readonly>
      </div>
      <div class="flex flex-col gap-
1. **Deklarasi PHP**:
   ```php
   <?php
   ?>
   ```html
   <body class="min-h-screen" data-theme="garden">
      <div class="flex min-h-screen">
         <?php require_once './components/sideDashboard.php' ?>
         <div class="w-5/6 ">
            <?php require_once './components/navDashboard.php' ?>
   ```
   - Membuat struktur tampilan dengan komponen sidebar dan navigasi.

4. **Formulir untuk Menambah Komentar**:
   ```h  ```
   - Blok PHP kosong, bisa digunakan untuk logika atau pengambilan data, tetapi saat ini tidak ada kode di dalamnya.

2. **Struktur HTML Dasar**:
   ```html
   <!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Tambah Komentar</title>
   </head>
   ```
   - Menentukan tipe dokumen, bahasa, serta meta tag untuk pengaturan karakter dan responsif.

3. **Tata Letak Halaman**:
  <tbody>
            <?php $no=1; foreach($data as $row) :?>
               <tr>
                  <td><?=$no++?></td>
                  <td><?=$row['username']?></td>
                  <td><?=$row['isi_komentar']?></td>
                  <td><?=$row['tanggal_update']?></td>
                  <td><?=$row['artikel_id']?></td>
                  <td>);
   $dashboard_id = isset($url_parts[2]) ? $url_parts[2] : '1';
   ```
   - Variabel `$current_url` mengambil URL halaman saat iniI_ASSOC);?>
       i adalah halaman untuk menambah komentar dalam aplikasi berbasis web. Berikut penjelasan singkat dan jelas mengenai setiap bagian:
isi">Username</label>
                  <input type="text" name="username" id="" class="input input-bordered" value="<?=$uid['nama']?>" readonly>
               </div>
        
1. **Mengambil Data Komentar**:
   ```php
   $komentar = $data->fetch_assoc();
   ```
   - Mengambil satu baris data komentar dari objek `$data` (biasanya hasil dari query basis data) dan menyimpannya dalam variabel `$komentar`.

2. **Struktur HTML Dasar**:
   ```html
   <!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <a charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tambah Komentar</title>
</head>
<body class="min-h-screen" data-theme="garden">
   <div class="flex min-h-screen">

      <?php require_once './components/sideDashboard.php' ?>

      <div class="w-5/6 ">
   <?php require_once './components/navDashboard.php' ?>
      <div class="mx-auto ">
         <div class=" m-4 rounded bg-gray-50 min-h-screen p-6  overflow-hidden">

            <form method="post" class="grid gap-4">
                <div class="flex flex-col gap-2">
                  <label for="meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Tambah Komentar</title>
   </head>
   ```
   - Menetapkan jenis dokumen, bahasa, dan meta tag untuk pengaturan karakter dan responsif.

3. **Tata Letak Halaman**:
   ```html
   <body class="min-h-screen" data-theme="garden">
      <div class="flex min-h-screen">
         <?php require_once './components/sideDashboard.php' ?>
         <div class="w-5/6 ">
            <?php require_once './components/navDashboard.php' ?>
   ```
   - Membuat struktur dasar untuk tampilan dengan menggunakan komponen sidebar dan navigasi.

4. **Formulir untuk Menambah Komentar**:
   ```html
   <form method="post" class="grid gap-4">
      <div class="flex flex-col gap-2">
         <label/insertKomentar.php
```
<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <met for="isi">Username</label>
         <input type="text" name="username" class="input input-bordered" value="<?=$komentar['username']?>" readonly>
      </div>
      <div class="flex flex-col gap-2">
         <label for="isi">Isi Komentar</label>
         <input type="text" name="isi_komentar" class="input input-bordered" value="<?=$komentar['isi_komentar']?>">
      </div>
      <div class="flex flex-col gap-2">
         <label for="id">Artikel ID</label>
         <input type="text" name="artikel_id" value="<?=$komentar['artikel_id']?>" readonly class="input input-bordered">
      </div>
      <div>
         <button type="submit" class="btn btn-primary">Tambah Komentar</button>
      </div>
   **Penutupan Elemen HTML**:
   ```html
   </div>
   </div>
   </div>
   </body>
   </html>
   ```
   - Menutup elemen yang dibuka sebelumnya, menyelesaikan struktur halaman.

Secara keseluruhan, halaman ini menampilkan form untuk menambah komentar baru dengan informasi yang diambil dari basis data, memungkinkan pengguna untuk memperbarui isi komentar yang sudah ada.

#### /dashboard</form>
   ```
   - Form ini mengandung input untuk `username` (readonly), `isi komentar`, dan `artikel_id` (readonly).
   - Ketika tombol "Tambah Komentar" diklik, data akan dikirim menggunakan metode `POST`.

5.               <input type="text" name="artikel_id" value="<?=$komentar['artikel_id']?>" readonly class="input input-bordered">
                  
                 
               </div>
               <div>
                  <button type="submit" class="btn btn-primary">Tambah Komentar</button>
               </div>
            </form> 
         </div>
      </div>
      </div>
      
   </div>
   
</body>
</html>
```
Kode in.
   - Fungsi `explode()` memecah URL berdasarkan karakter `/`, menyimpan bagian-bagiannya ke dalam array `$url_parts`.
   - `dashboard_id` mengambil nilai dari bagian ketiga URL (jika ada), atau menggunakan nilai default `1`.

2. **Struktur HTML Halaman**:
   - `sideDashboard.php` dan `navDashboard.php` di-include untuk menampilkan sidebar dan navbar.
   - Bagian utama halaman (`<div class="m-4 rounded bg-gray-50 p-6 ...">`) menampilkan judul, tombol tambah komentar, dan tabel daftar komentar.

3. **Tabel Daftar Komentar**:
   - Setiap komentar ditampilkan dalam tabel dengan kolom nomor, username, isi komentar, tanggal update, artikel ID, dan aksi.
   - Terdapat dua tombol aksi: `Hapus` dan `Edit`, yang masing-masing akan memuat URL dengan `dashboard_id` dan `id_komentar` untuk penghapusan dan pengeditan komentar.

Secara keseluruhan, kode ini menampilkan daftar komentar dan menyediakan navigasi untuk mengelola komentar.

#### /dashboard/admin/deleteKomentar.php
```
<?php 
$current_url = $_SERVER['REQUEST_URI'];
$url_parts = explode('/', $current_url);
$dashboard_id = isset($url_parts[2]) ? $url_parts[2] : '1';
Username</label>
                  <input type="text" name="username" id="" class="input input-bordered" value="<?=$komentar['username']?>" readonly>
               </div>
               <div class="flex flex-col gap-2">
                  <label for="isi">Isi Komentar</label>
                  <input type="text" name="isi_komentar" id="" class="input input-bordered" value="<?=$komentar['isi_komentar']?>">
               </div>
               <div class="flex flex-col gap-2">
                  <label for="id">Artikel ID</label>
               
                     <?php $row = $artikel->fetch_all(MYSQL
echo "<script>
  alert('Data Komentar berhasil di hapus')
  location.href = '/dashboard/{$dashboard_id}/komentar'

</script>";
echo  "Haruse berhasil sih cok";
?>
```unded bg-gray-50 min-h-screen  p-6  overflow-hidden">

            <form method="post" class="grid gap-4">
                <div class="flex flex-col gap-2">
                  <label for="isi">
Kode ini menampilkan pesan notifikasi dengan JavaScript saat data komentar berhasil dihapus dan kemudian mengarahkan pengguna kembali ke halaman komentar. Berikut penjelasan kode ini:

1. **Mengambil ID Dashboard**:
   ```php
   $current_url = $_SERVER['REQUEST_URI'];
   $url_parts = explode('/', $current_url);
   $dashboard_id = isset($url_parts[2]) ? $url_parts[2] : '1';
   ```
   - Mengambil URL saat ini dan memecahnya berdasarkan `/`.
   - Mengambil nilai bagian ketiga dari URL sebagai `dashboard_id`, atau menggunakan default `1` jika tidak ada.

2. **JavaScript untuk Notifikasi dan Redirect**:
   ```php
   echo "<script>
     alert('Data Komentar berhasil di hapus')
     location.href = '/dashboard/{$dashboard_id}/komentar'
   </script>";
   ```
   - Menampilkan pesan pop-up **"Data Komenta">
   <div class="flex min-h-screen">

      <?php require_once './components/sideDashboard.php' ?>

      <div class="w-5/6 ">
   <?php require_once './components/navDashboard.php' ?>
      <div class="mx-auto">
         <div class="m-4 ror berhasil di hapus"** menggunakan `alert()`.
   - Mengarahkan pengguna ke halaman daftar komentar (`/dashboard/{dashboard_id}/komentar`) menggunakan `location.href`.

3. **Pesan Debugging**:
   ```php
   echo "Haruse berhasil sih cok";
   ```
   - Menampilkan pesan "Haruse berhasil sih cok" di halaman untuk tujuan debugging atau pengecekan.

Kode ini memberikan feedback ke pengguna bahwa data telah berhasil dihapus dan otomatis mengarahkan mereka kembali ke daftar komentar.

#### /dashboard/editKomentar.php
```
<?php
$komentar = $data->fetch_assoc();
?>
<!DOCTYPE html>le=1.0">
   <title>Tambah Komentar</title>
</head>
<body class="min-h-screen" data-theme="garden
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-sca
                     <a href="/dashboard/<?=$dashboard_id?>/komentar/hapus/<?=$row['id_komentar']?>" class="btn btn-outline btn-sm btn-error">Hapus</a>
                     <a href="/dashboard/<?=$dashboard_id?>/komentar/edit/<?=$row['id_komentar']?>" class="btn btn-outline btn-sm btn-info">Edit</a>
                  </td>
               </tr>
            <?php endforeach?>
         </tbody>
        </table>
      </div>
            </div>
   </div>
</body>
</html>
```
Kode di atas adalah bagian dari tampilan halaman `List Komentar` yang menampilkan daftar komentar dengan tombol untuk menambah, mengedit, atau menghapus komentar. Berikut penjelasan singkat tentang fungsinya:

1. **Mendapatkan ID Dashboard**:
   ```php
   $current_url = $_SERVER['REQUEST_URI'];
   $url_parts = explode('/', $current_url
3. **`listArtikel($id)`**:
   Mengambil daftar artikel berdasarkan `penulis_id` dan menampilkannya pada view `dashboard/artikel`.
erta data artikel dan username penulis berdasarkan `id`.

10. **`komentarStore($id)`**:
    Menyimpan komentar baru dari ftar berdasarkan `id_komentar`, beserta daftar artikel.
<?php
$current_url   <td>No</td>
               <td>Username</td>
               <td>Isi Komentar</td>
               <td>Tanggal Update</td>
               <td>Ar= $_SERVER['REQUEST_URI'];
$url_parts = explode('/', $current_url);
$dashboard_id = isset($url_parts[2]) ? $url_parts[2] : '1';
?>
<!DOCTYPE html>o min-h-screen flex">
   <?php require_once './components/sideDashboard.php' ?>
   <div class="w-5/6">
      <?php require_once './components/navDashboard.php' ?>
      <div class="m-4 rounded bg-gray-50  p-6  rounded-sm overflow-hidden">
        <h1 class="text-2xl">List Komentar</h1>
        <a href="/dashboard/<?=$dashboard_id?>/komentar/tambah" class="btn btn-sm text-white btn-success btn-outline"> + Tambah Komentar </a>
        <table id="myTable" class="display border border-gray-400">
         <thead>
            <tr>
             
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>list Komentar</title>
</head>
<body class="min-h-screen" data-theme="garden">

   <div class="mx-aut
13. **`komentarUpdate($id, $kid)`**:cessKomentar`.

Secara keseluruhan, `DashboardController` ini berfungsi untuk mengelola proses CRUD (Create, Read, Update, Delete) pada artikel, komentar, dan kategori di halaman dashboard.

### Views
#### /dashboard/admin/komentar.php
```

    Memperbarui komentar berdasarkan `id_komentar` dengan data dari `$_POST`. Jika berhasil, menampilkan halaman `dashboard/editSucorm (data `$_POST`). Jika berhasil, menampilkan pesan sukses dan mengarahkan ke halaman daftar komentar.

11. **`deleteKomentar($id, $kid)`**:
    Menghapus komentar berdasarkan `id_komentar` yang diterima dan menampilkan halaman penghapusan komentar.

12. **`editPageKomentar($id, $kid)`**:
    Menampilkan halaman edit komen
4. **`artikelStore($id)`**:
   Menyimpan data artikel baru yang dikirimkan melalui form (dari `$_POST`) ke database. Jika berhasil, menampilkan pesan sukses dan mengarahkan pengguna ke halaman daftar artikel.

5. **`listKomentar($id)`**:
   Mengambil semua komentar dan menampilkannya pada view `dashboard/admin/kategori`.

9. **`insertPageKomentar($id)`**:
   Menampilkan halaman untuk menambah komentar, besnya pada view `dashboard/komentar`.

6. **`listKomentarAdmin()`**:
   Mengambil semua komentar dan menampilkannya pada view `dashboard/admin/komentar` khusus untuk admin.

7. **`deleteKomentarAdmin($id)`**:
   Menghapus komentar berdasarkan `id_komentar` yang diberikan dan menampilkan halaman penghapusan komentar untuk admin.

8. **`listKategoriAdmin()`**:
   Mengambil semua kategori dan menampilkan









