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

   <div class="mx-auto py-4 px-2 sm:px-6 lg:px-8">
      <div class="bg-gray-100 border border-dotted border-black  p-6 mx-auto rounded-sm overflow-hidden">
         <h1 class="text-2xl">Halo <?=$detail['nama']?></h1>
        <h1>Selamat datang di dashboard</h1> 
      </div>
   </div>
</body>
</html>