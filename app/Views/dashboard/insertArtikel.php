<?php
 $detail=$user->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?= $detail['nama'] ?></title>
</head>
<body class="min-h-screen" data-theme="garden">
   <?php require_once './components/navbar.php' ?>
   <div class="flex min-h-screen">
      <?php require_once './components/sidebar.php' ?>
      <div class="mx-auto w-4/5 ">
         <div class="bg-gray-100 min-h-screen border border-dotted border-black  p-6 mx-auto rounded-sm overflow-hidden">
            <form method="post" class="grid gap-4">
               <div class="flex flex-col gap-2">
                  <label for="judul">Judul artikel</label>
                  <input type="text" name="judul" id="" class="input input-bordered">
               </div>
               <div class="flex flex-col gap-2">
                  <label for="konten">Konten</label>
                  <textarea name="konten" id="" cols="30" rows="10" class="textarea textarea-bordered textarea-lg"></textarea>
               </div>
               <div class="flex flex-col gap-2">
                  <label for="penulis_id">Penulis</label>
                  <input type="number" name="penulis_id" id="" value="<?=$detail['id_penulis']?>" class="input input-bordered" readonly>
               </div>
               <div class="flex flex-col gap-2">
                  <label for="kategori_id">Kategori</label>
                  <select name="kategori_id" id="" class="select select-bordered">
                     <?php foreach($kategori as $row) : ?>
                        <option value="<?=$row['id_kategori']?>"><?=$row['nama_kategori']?></option>
                     <?php endforeach?>
                  </select>
               </div>
               <div>
                  <button type="submit" class="btn btn-primary">Tambah Postingan</button>
               </div>
            </form> 
         </div>
      </div>
   </div>
   
</body>
</html>