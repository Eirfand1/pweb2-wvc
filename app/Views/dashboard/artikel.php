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
   <?php require_once './components/sideDashboard.php' ?>
      <div class="bg-gray-100 w-4/5 border border-dotted border-black rounded-sm overflow-hidden">
       <?php require_once './components/navDashboard.php' ?>
       <div class="p-6">
         <h1 class="text-2xl  font-semibold mb-2">List Artikel</h1>
         <a href="/dashboard/<?=$dashboard_id?>/artikel/tambah" class="btn btn-sm text-white btn-success btn-outline"> + Tambah Postingan </a>
         <table id="myTable" class="table">
            <thead>
               <tr>
                  <td>No</td>
                  <td>Judul</td>
                  <td>Aksi</td>
               </tr>
            </thead>
            <tbody>
               <?php $no=1; foreach($artikel as $row) :?>
                  <tr>
                     <td><?=$no++?></td>
                     <td><?=$row['judul']?></td>
                     <td>
                        <a href="/dashboard/<?=$dashboard_id?>/artikel/<?=$row['id_artikel']?>" class="btn btn-sm btn-error btn-outline">Hapus</a>
                        <a href="/dashboard/<?=$dashboard_id?>/artikel/edit/<?=$row['id_artikel']?>" class="btn btn-sm btn-info btn-outline">Edit</a>
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