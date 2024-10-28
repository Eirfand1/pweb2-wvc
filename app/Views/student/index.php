<!Doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  </head>
  <body data-theme="light" class="min-h-screen bg-gray-100">

    <h1 class="text-center text-4xl font-bold py-2">Data Mahasiswa</h1>

    <div class="card p-5 bg-white rounded-sm w-10/12 mx-auto">
      <h1 class="text-2xl font-semibold">List Mahasiswa</h1>
      <div class="overflow-x-auto text-xs ">
        <table id="myTable" class="table">
          <thead>
            <tr>
              <td>Nama</td>  
              <td>Aalamat</td>
            </tr> 
          </thead> 
          <tbody>
            <?php foreach($data as $student) : ?>
            <tr>
              <td><?=$student['name']?></td> 
              <td><?=$student['address']?></td> 
            </tr> 
            <?php endforeach?>
          </tbody>

        </table> 
      </div>
    </div>
  </body>
</html>
