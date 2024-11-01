<?php
 $detail=$user->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin</title>
</head>
<body class="min-h-screen" data-theme="garden">
   <div class="flex min-h-screen">
      <?php require_once './components/admin/sidebar.php' ?>
      <div class="w-5/6">
         <?php require_once './components/navDashboard.php' ?>
         <div class="mx-auto">
            <div class="bg-gray-100 min-h-screen   p-6 mx-auto rounded-sm overflow-hidden">
               <h1 class="text-2xl">Halo Admin</h1>
               <h1>Selamat datang di dashboard</h1> 
            </div>
         </div>
      </div>
      
   </div>
   
</body>
</html>