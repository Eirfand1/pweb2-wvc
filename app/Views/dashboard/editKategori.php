<?php
$edit = $data->fetch_assoc(); // Data kategori yang akan diedit
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Kategori: <?= $edit['nama_kategori'] ?></title>
</head>
<body class="min-h-screen" data-theme="garden">
   <div class="flex min-h-screen">
      <?php require_once './components/sideDashboard.php'; ?>
      <div class="w-4/5">
         <?php require_once './components/navDashboard.php'; ?>
         <div class="mx-auto">
            <div class="bg-gray-100 min-h-screen border border-dotted border-black p-6 mx-auto rounded-sm overflow-hidden">
               <form method="post" class="grid gap-4">
                  <div class="flex flex-col gap-2">
                     <label for="nama_kategori">Nama Kategori</label>
                     <input 
                        type="text" 
                        name="nama_kategori" 
                        id="nama_kategori" 
                        class="input input-bordered" 
                        value="<?= $edit['nama_kategori'] ?>" 
                        required>
                  </div>
                  <div>
                     <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</body>
</html>
