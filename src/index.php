<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Pendaftaran Mahasiswa</title>
</head>
<body>
<nav class="navbar navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">Universitas <strong>GGC</strong></a>
  </div>
</nav>
<div class="container">
    <form action="/daftar.php" method="post" class="row">
        <div class="col-12 my-2">
            <label for="nama">Masukan Nama Pada Form Dibawah</label>
        </div>
        <div class="col-4">
            <input type="text" name="nama" class="form-control" id="nama" required maxlength="25"/>
        </div>
        <div class="col-2">
        <button type="submit" class="btn btn-primary">Daftar</button>
        </div>
    </form>
</div>
</body>
</html>