<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel Page</title>
</head>
<body class="min-h-screen">
     <?php require_once "./components/navbar.php" ?>
    <div class="container mx-auto px-4  md:w-10/12 w-full">
      <h1 class="text-4xl my-2 text-center font-semibold">List Artikel</h1>
        <div class="grid gap-4 p-6 grid-cols-1 lg:grid-cols-3 sm:grid-cols-2">
            <?php foreach($data as $artikel) : ?>
            <div class="card rounded-sm border border-black border-dashed w-full bg-base-100">
                <div class="card-body p-6 bg-gray-100">
                    <div class="badge font-semibold badge-secondary badge-outline"><?=$artikel['nama_kategori']?></div>
                    <h1 class="card-title text-2xl  font-serif "><?=$artikel['judul']?></h1>
                    <p class="text-base-content mt-4"><?=$artikel['konten']?></p>
                    <div class="card-actions justify-end mt-4">
                        <a href="<?=$artikel['id_artikel']?>" class="text-black btn-ghost rounded-sm p-2 font-bold ">Selengkapnya....</a>
                    </div>
                </div>
            </div>
            <?php endforeach?>
        </div>
    </div>
</body>
</html>