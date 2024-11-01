<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
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
                  <label for="isi">Username</label>
                  <input type="text" name="username" id="" class="input input-bordered" value="<?=$uid['nama']?>" readonly>
               </div>
               <div class="flex flex-col gap-2">
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