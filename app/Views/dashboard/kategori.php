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
        <?php require_once './components/sideDashboard.php'; ?>
        
        <div class="flex-1 flex flex-col">
            <?php require_once './components/navDashboard.php'; ?>
            
            <div class="p-6 bg-gray-100 flex-1">
                    <h1 class="text-2xl font-bold mb-6">Kategori Artikel</h1>
                    <h1>cekk</h1>
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
                                        <a href="delete.php?id=<?= htmlspecialchars($row['id'] ?? '') ?>" 
                                           class="btn btn-outline btn-sm btn-error"
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                            Hapus
                                        </a>
                                        <a href="editKategori.php?id=<?= htmlspecialchars($row['id'] ?? '') ?>" 
                                           class="btn btn-outline btn-sm btn-info">
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

</body>
</html>