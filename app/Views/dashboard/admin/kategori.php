<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Artikel</title>
</head>
<body class="min-h-screen" data-theme="garden">
    <div class="flex min-h-screen">
        <?php require_once './components/admin/sidebar.php'; ?>
        
        <div class="flex-1 flex flex-col">
            <?php require_once './components/navDashboard.php'; ?>
            
            <div class="p-6 bg-gray-100 flex-1">
                    <h1 class="text-2xl font-bold mb-6">Kategori Artikel</h1>
                    <a href="/dashboard/<?= $dashboard_id?>/kategori/tambah" class="btn btn-primary btn-outline">Tambah Kategori</a>
                        <table id="myTable" class="table w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php 
                                $no = 1; 
                                foreach($kategori as $row): 
                                ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($no++) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($row['nama_kategori']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                    <button class="btn btn-sm btn-error btn-outline" onclick="confirmDelete(<?=$row['id_kategori']?>)">Hapus</button>
                                        <a href="/dashboard/admin/kategori/edit/<?=$row['id_kategori']?>" class="btn btn-sm btn-info">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
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
               window.location.href = '/dashboard/admin/kategori/' + id;
            }
         });
      }
   </script>
</body>
</html>