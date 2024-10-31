<?php 
$current_url = $_SERVER['REQUEST_URI'];
$url_parts = explode('/', $current_url);
$dashboard_id = isset($url_parts[2]) ? $url_parts[2] : '1';

echo "<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-kategori');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const kategoriId = this.dataset.id;

                const confirmDelete = confirm('Anda yakin? Kategori akan dihapus secara permanen!');

                if (confirmDelete) {
                    fetch('deleteKategori.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ id_kategori: kategoriId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            alert('Berhasil! ' + data.message);
                            // Memuat ulang halaman setelah penghapusan berhasil
                            location.reload(); // Ini memuat ulang halaman
                        } else {
                            alert('Gagal! ' + data.message);
                        }
                    })
                    .catch(error => {
                        alert('Error! Terjadi kesalahan saat menghapus kategori.');
                    });
                }
            });
        });
    });
</script>";
echo "Haruse berhasil sih cok";
?>
