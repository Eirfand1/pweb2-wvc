<?php 
$current_url = $_SERVER['REQUEST_URI'];
$url_parts = explode('/', $current_url);
$dashboard_id = isset($url_parts[2]) ? $url_parts[2] : '1';

echo "<script>
  Swal.fire({
    title: 'Good job!',
    text: 'Kategori telah dihapus',
    icon: 'success'
  });
  location.href = '/dashboard/{$dashboard_id}/kategori'
</script>";
echo "Haruse berhasil sih cok";
?>
