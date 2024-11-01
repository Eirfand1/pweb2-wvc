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
   <title>list Komentar</title>
</head>
<body class="min-h-screen" data-theme="garden">

   <div class="mx-auto min-h-screen flex">
   <?php require_once './components/sideDashboard.php' ?>
   <div class="w-5/6">
      <?php require_once './components/navDashboard.php' ?>
      <div class="m-4 rounded bg-gray-50  p-6  rounded-sm overflow-hidden">
        <h1 class="text-2xl">List Komentar</h1>
        <a href="/dashboard/<?=$dashboard_id?>/komentar/tambah" class="btn btn-sm text-white btn-success btn-outline"> + Tambah Komentar </a>
        <table id="myTable" class="display border border-gray-400">
         <thead>
            <tr>
               <td>No</td>
               <td>Username</td>
               <td>Isi Komentar</td>
               <td>Tanggal Update</td>
               <td>Artikel Id</td>
               <td>Aksi</td>
            </tr>
         </thead>
         <tbody>
            <?php $no=1; foreach($data as $row) :?>
               <tr>
                  <td><?=$no++?></td>
                  <td><?=$row['username']?></td>
                  <td><?=$row['isi_komentar']?></td>
                  <td><?=$row['tanggal_update']?></td>
                  <td><?=$row['artikel_id']?></td>
                  <td>
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