<?php
 $detail=$data->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?= $detail['judul'] ?></title>
</head>

<body class="min-h-screen" data-theme="garden">
   <?php require_once './components/navbar.php' ?>

   <div class="mx-auto py-4 px-2 sm:px-6 lg:px-8">
      <div class="bg-gray-100 border border-dotted border-black max-w-3xl mx-auto rounded-sm overflow-hidden">
         <div class="p-6">
            <h1 class="text-5xl font-bold mb-4"><?= $detail['judul'] ?></h1>
            <div class="flex items-center mb-4">
               <!-- <div class="mr-4">
                  <img src="https://via.placeholder.com/48" alt="<?= $detail['nama'] ?>" class="rounded-full">
               </div> -->
               <div>
                  <p class="font-medium">By : <?= $detail['nama'] ?></p>
                  <p class="text-gray-600"><?= $detail['bio'] ?></p>
               </div>
            </div>
            <div class="mb-4 font-serif text-xl">
               <p><?= $detail['konten'] ?></p>
            </div>
         </div>
         <div class="bg-gray-100 p-6">
            <h2 class="text-2xl font-bold mb-4">Komentar</h2>
            <form action="" method="post">
               <input type="number" name="artikel_id" value="<?=$aid?>" hidden>
               <div class="mb-4">
                  <label for="username" class="block mb-2">Username</label>
                  <select name="username" id="" class="select w-full" >
                     <?php foreach ($penulis as $row): ?>
                       <option value="<?= $row['nama'] ?>"><?= $row['nama'] ?></option> 
                     <?php endforeach ?>
                  </select>
               </div>
               <div class="mb-4">
                  <label for="isi_komentar" class="block mb-2">Komentar</label>
                  <textarea id="komentar" name="isi_komentar" class="w-full border border-gray-400 p-2 rounded"></textarea>
               </div>
               <div class="mb-4">
                  <button type="submit" class="btn">Kirim</button>
               </div>
             </form>
            <?php foreach ($komentar as $row): ?>
            <div class="bg-white p-4 rounded-lg shadow-sm mb-4">
               <p class="font-medium"><?= $row['username'] ?></p>
               <p><?= $row['isi_komentar'] ?></p>
            </div>
            <?php endforeach ?>
         </div>
      </div>
   </div>
</body>
</html>