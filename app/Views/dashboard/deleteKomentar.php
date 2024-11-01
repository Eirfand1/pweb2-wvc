<?php 
$current_url = $_SERVER['REQUEST_URI'];
$url_parts = explode('/', $current_url);
$dashboard_id = isset($url_parts[2]) ? $url_parts[2] : '1';

echo "<script>
  alert('Data Komentar berhasil di hapus')
  location.href = '/dashboard/{$dashboard_id}/komentar'

</script>";
echo  "Haruse berhasil sih cok";
?>