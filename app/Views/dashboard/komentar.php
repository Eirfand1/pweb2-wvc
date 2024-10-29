<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>list Komentar</title>
</head>
<body class="min-h-screen" data-theme="garden">
   <?php require_once './components/navbar.php' ?>

   <div class="mx-auto min-h-screen flex">
   <?php require_once './components/sidebar.php' ?>
      <div class="bg-gray-100 w-4/5 border border-dotted border-black  p-6  rounded-sm overflow-hidden">
        <h1 class="text-2xl">List Komentar</h1>
        <table id="myTable" class="table">
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
                     <a href="" class="btn btn-sm btn-error">Hapus</a>
                     <a href="" class="btn btn-sm btn-info">Edit</a>
                  </td>
               </tr>
            <?php endforeach?>
         </tbody>
        </table>
      </div>
   </div>
</body>
</html>