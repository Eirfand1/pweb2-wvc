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