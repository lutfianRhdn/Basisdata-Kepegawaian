<?php
require_once "function/database.php";
$jabatan = findAll("jabatan");
$golongan = findAll("golongan");
$pendidikan = findAll("pendidikan");
$pegawai = findById("pegawai", $_GET['id']);
if(count($_POST) >0 ){
  $id = $_GET['id'];
  unset($_POST['id']);
  $_POST['status'] = isset($_POST['status']) ? "aktif" : "tidak aktif";
  update("pegawai", $_POST, $id);
  header("Location: index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
  <title>Document</title>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-900">
  <form action="" method="post" class=" px-5 px-10 bg-gray-800  shadow-lg modal-container w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
    <h1 class="text-3xl text-center text-white font-bold mt-5">Update Data Kepegawaian</h1>
    <div class="my-5 flex flex-col gap-5 text-white">
      <div class="flex flex-col ">
        <label for="name" class="block mb-2 text-sm font-medium  ">Name</label>
        <input type="text" name="nama" id="name" class="p-2 text-black border border-gray-300 rounded-md w-full focus:outline-none focus:ring focus:border-blue-500" placeholder="Jhon Doe" value="<?= $pegawai['nama'] ?>">
      </div>
      <div>
        <label for="gaji" class="block mb-2 text-sm font-medium  ">Gaji</label>
        <input type="number" name="gaji" id="gaji" class="p-2 text-black border border-gray-300 rounded-md w-full focus:outline-none focus:ring focus:border-blue-500" placeholder="Gaji" min="0" value="<?= $pegawai['gaji'] ?>">
      </div>

      <div>
        <label for="jabatan" class="block mb-2 text-sm font-medium  ">Jabatan</label>
        <select id="jabatan" name="jabatan_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " value="<?= $pegawai['jabatan_id'] ?>">
          <option selected disabled>Pilih Jabatan</option>
          <?php foreach ($jabatan as $j) : ?>
            <option value="<?= $j['id'] ?>" <?= $pegawai['jabatan_id'] = $j['id'] ? 'selected' : '' ?>><?= $j['nama_jabatan'] ?></option>
          <?php endforeach; ?>
        </select>

      </div>
      <div>
        <label for="jabatan" class="block mb-2 text-sm font-medium  ">Golongan</label>
        <select id="jabatan" name="golongan_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " value="<?= $pegawai['golongan_id'] ?>">
          <option selected disabled>Pilih Golongan</option>
          <?php foreach ($golongan as $g) : ?>
            <option value="<?= $g['id'] ?>" <?= $pegawai['golongan_id'] = $g['id'] ? 'selected' : '' ?>><?= $g['nama_golongan'] ?></option>
          <?php endforeach; ?>
        </select>

      </div>
      <div>
        <label for="jabatan" class="block mb-2 text-sm font-medium   ">Pendidikan</label>
        <select id="jabatan" name="pendidikan_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " value="<?= $pegawai['pendidikan_id'] ?>">
          <?php foreach ($pendidikan as $p) : ?>
            <option value="<?= $p['id'] ?>" <?= $pegawai['pendidikan_id'] = $p['id'] ? 'selected' : '' ?>>[<?= $p['tingkat'] ?>] <?= $p['tahun'] ?> - <?= $p['tempat_pendidikan'] ?> </option>
          <?php endforeach; ?>
        </select>

      </div>
      <div class="flex items-center gap-2">
        <div>
          Status
        </div>
        <label class="relative inline-flex cursor-pointer items-center">
          <input id="switch" type="checkbox" <?= $pegawai['status'] === 'aktif' ? 'checked' : '' ?> class="peer sr-only" name="status" />
          <label for="switch" class="hidden"></label>
          <div class="peer h-6 w-11 rounded-full border bg-slate-200 after:absolute after:left-[2px] after:top-0.5 after:h-5 after:w-5 after:rounded-full after:border after:border-green-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-green-400 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:ring-green-300"></div>
        </label>
      </div>
    </div>
    <div>
      <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded-md mb-10">Update</button>
    </div>
  </form>
</body>

</html>