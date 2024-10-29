<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>list artikel</title>
</head>
<body class="min-h-screen" data-theme="garden">
   <?php require_once './components/navbar.php' ?>

   <div class="mx-auto min-h-screen flex">
   <?php require_once './components/sidebar.php' ?>
      <div class="bg-gray-100 w-4/5 border border-dotted border-black  p-6  rounded-sm overflow-hidden">
        <h1 class="text-2xl">Kategori Artikel</h1>
        <table id="myTable" class="table">
         <thead>
            <tr>
               <td>No</td>
               <td>Nama Kategori</td>
               <td>Aksi</td>
            </tr>
         </thead>
         <tbody>
            <?php $no=1; foreach($kategori as $row) :?>
               <tr>
                  <td><?=$no++?></td>
                  <td><?=$row['nama_kategori']?></td>
                  <td>
                     <a href="" class="btn btn-outline btn-sm btn-error">Hapus</a>
                     <a href="" class="btn btn-outline btn-sm btn-info">Edit</a>
                  </td>
               </tr>
            <?php endforeach?>
         </tbody>
        </table>
      </div>
   </div>
</body>
</html>