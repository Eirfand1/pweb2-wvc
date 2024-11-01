<?php
$detail = $user->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?= $detail['nama'] ?></title>
</head>
<body class="min-h-screen" data-theme="garden">
   <div class="flex min-h-screen">

      <?php require_once './components/sideDashboard.php' ?>

      <div class="w-5/6 ">
         <?php require_once './components/navDashboard.php' ?>
         <div class="mx-auto ">
            <div class="m-4 bg-gray-50 min-h-screen  p-6 rounded overflow-hidden">

               <form id="articleForm" method="post" class="grid gap-4" onsubmit="return confirmSubmit()">
                  <div class="flex flex-col gap-2">
                     <label for="judul">Judul artikel</label>
                     <input type="text" name="judul" id="" class="input input-bordered" required>
                  </div>
                  <div class="flex flex-col gap-2">
                     <label for="konten">Konten</label>
                     <textarea name="konten" id="" cols="30" rows="10" class="textarea textarea-bordered textarea-lg" required></textarea>
                  </div>
                  <div class="flex flex-col gap-2">
                     <label for="penulis_id">Penulis</label>
                     <input type="number" name="penulis_id" id="" value="<?=$detail['id_penulis']?>" class="input input-bordered" readonly>
                  </div>
                  <div class="flex flex-col gap-2">
                     <label for="kategori_id">Kategori</label>
                     <select name="kategori_id" id="" class="select select-bordered" required>
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
   </div>

   <script>
      function confirmSubmit() {
         return Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan ditambahkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Tambahkan!',
            cancelButtonText: 'Batal'
         }).then((result) => {
            if (result.isConfirmed) {
               return true;
            } else {
               return false;
            }
         });
      }
   </script>
</body>
</html>
