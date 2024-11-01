<?php
$komentar = $data->fetch_assoc();
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
      <div class="mx-auto">
         <div class="m-4 rounded bg-gray-50 min-h-screen  p-6  overflow-hidden">

            <form method="post" class="grid gap-4">
                <div class="flex flex-col gap-2">
                  <label for="isi">Username</label>
                  <input type="text" name="username" id="" class="input input-bordered" value="<?=$komentar['username']?>" readonly>
               </div>
               <div class="flex flex-col gap-2">
                  <label for="isi">Isi Komentar</label>
                  <input type="text" name="isi_komentar" id="" class="input input-bordered" value="<?=$komentar['isi_komentar']?>">
               </div>
               <div class="flex flex-col gap-2">
                  <label for="id">Artikel ID</label>
               
                     <?php $row = $artikel->fetch_all(MYSQLI_ASSOC);?>
                     <input type="text" name="artikel_id" value="<?=$komentar['artikel_id']?>" readonly class="input input-bordered">
                  
                 
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