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