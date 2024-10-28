<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel Page</title>
</head>
<body class="min-h-screen bg-base-200">
     <?php require_once "./components/navbar.php" ?>
    <div class="container mx-auto px-4 py-8 md:w-10/12 w-full">
      <h1 class="text-3xl mb-4 text-center font-bold">List Artikel</h1>
        <div class="grid gap-4 grid-cols-1 lg:grid-cols-3 sm:grid-cols-2">
            <?php foreach($data as $artikel) : ?>
            <div class="card w-full bg-base-100">
                <div class="card-body">
                    <div class="badge font-semibold badge-primary badge-outline"><?=$artikel['nama_kategori']?></div>
                    <h1 class="card-title text-2xl font-bold"><?=$artikel['judul']?></h1>
                    <p class="text-base-content mt-4"><?=$artikel['konten']?></p>
                    <div class="card-actions justify-end mt-4">
                        <button class="btn text-white btn-primary">Selengkapnya...</button>
                    </div>
                </div>
            </div>
            <?php endforeach?>
        </div>
    </div>
</body>
</html>