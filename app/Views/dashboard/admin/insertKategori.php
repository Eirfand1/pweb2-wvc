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