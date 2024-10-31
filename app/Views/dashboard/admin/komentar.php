<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>list Komentar</title>
</head>
<body class="min-h-screen" data-theme="garden">

   <div class="mx-auto min-h-screen flex">

   <?php require_once './components/admin/sidebar.php' ?>
      <div class="w-5/6 ">
   <?php require_once './components/navDashboard.php' ?>
      <div class=" m-4 rounded bg-gray-50  p-6  rounded-sm overflow-hidden">
        <h1 class="text-2xl">List Komentar</h1>
        <table id="myTable" class="display border border-gray-400">
         <thead>
            <tr>
               <td>No</td>
               <td>Username</td>
               <td>Isi Komentar</td>
               <td>Tanggal Update</td>
               <td>Artikel Id</td>
               <td>Aksi</td>
            </tr>
         </thead>
         <tbody>
            <?php $no=1; foreach($data as $row) :?>
               <tr>
                  <td><?=$no++?></td>
                  <td><?=$row['username']?></td>
                  <td><?=$row['isi_komentar']?></td>
                  <td><?=$row['tanggal_update']?></td>
                  <td><?=$row['artikel_id']?></td>
                  <td>

                     <button class="btn btn-sm btn-error btn-outline" onclick="confirmDelete(<?=$row['id_komentar']?>)">Hapus</button>
                  </td>
               </tr>
            <?php endforeach?>
         </tbody>
        </table>
      </div>
      </div>
   </div>

   <script>
      function confirmDelete(id) {
         Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus!',
            cancelButtonText: 'Batal'
         }).then((result) => {
            if (result.isConfirmed) {
               // Redirect to the delete URL
               window.location.href = '/dashboard/admin/komentar/' + id;
            }
         });
      }
   </script>
</body>
</html>