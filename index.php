<?php
include './function/database.php';
$pegawai = findAll('pegawai', 'JOIN jabatan ON pegawai.jabatan_id = jabatan.id JOIN golongan ON pegawai.golongan_id = golongan.id JOIN pendidikan ON pegawai.pendidikan_id = pendidikan.id','pegawai.*,jabatan.nama_jabatan,golongan.nama_golongan,pendidikan.tingkat,pendidikan.tahun,pendidikan.tempat_pendidikan');
$jabatan = findAll('jabatan');
$golongan = findAll('golongan');
$pendidikan = findAll('pendidikan');

if (count($_POST) > 0) {
  switch ($_POST['method']) {
    case 'insert':
      if (!$_POST['nama'] || !$_POST['jabatan_id'] || !$_POST['gaji'] || !$_POST['golongan_id'] || !$_POST['pendidikan_id'] || !$_POST['status']) {
        echo "<script>alert('Data tidak boleh kosong')</script>";
        break;
      } else {
        $_POST['status'] = $_POST['status'] == 'on' ? 'aktif' : 'nonaktif';
        unset($_POST['id']);
        unset($_POST['method']);
        insert('pegawai', $_POST);
        echo "<script>alert('Data berhasil ditambahkan')</script>";
        echo "<script>window.location.href = 'index.php'</script>";
      }
      break;
    
    case 'delete':
      
      delete('pegawai', $_POST['id']);

      echo "<script>alert('Data berhasil dihapus')</script>";
      echo "<script>window.location.href = 'index.php'</script>";

      break;
  }
}
$index = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kepegawaian</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
</head>

<body>

  <div class="flex items-center justify-center min-h-screen bg-gray-900">
    <div class="col-span-12">
      <div class="flex justify-between">
        <h1 class="text-3xl font-bold text-white"> Pegawai </h1>
        <button class="bg-green-400 text-gray-800 hover:scale-105 duration-100 rounded-md px-4 py-2" onclick="openModal()">
          <i class="material-icons-outlined text-base">add</i>
          Tambah
        </button>
      </div>
      <div class="overflow-auto lg:overflow-visible ">
        <table class="border-spacing-y-2 text-gray-400 border-separate space-y-6 text-sm">
          <thead class="bg-gray-800 text-gray-500">
            <tr>
              <th class="p-3">#</th>
              <th class="p-3 text-left">Nama</th>
              <th class="p-3 text-left">Jabatan</th>
              <th class="p-3 text-left">Gaji</th>

              <th class="p-3 text-left">Golongan</th>
              <th class="p-3 text-left">Pendidikan</th>
              <th class="p-3 text-left">Status</th>
              <th class="p-3 text-left">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($pegawai as $p) : ?>
              <tr class="bg-gray-800 table-row" data-nama="<?= $p['nama'] ?>" data-jabatan-id="<?= $p['jabatan_id'] ?>" data-gaji="<?= $p['gaji'] ?>" data-golongan-id="<?= $p['golongan_id'] ?>" data-pendidikan-id="<?= $p['pendidikan_id'] ?>" data-status="<?= $p['status'] ?>" data-id="<?= $p['id'] ?>">
                <td class=" p-3">
                  <?= $index++ ?> 
                </td>
                <td class="p-3">
                  <?= $p['nama'] ?>
                </td>
                <td class="p-3">
                  <?= $p['nama_jabatan'] ?>
                </td>
                <td class="p-3">
                  <?= $p['gaji'] ?>
                </td>
                <td class="p-3">
                  <?= $p['nama_golongan'] ?>
                </td>
                <td class="p-3">
                  [<?= $p['tingkat'] ?>] - <?= $p['tahun'] ?> <?= $p['tempat_pendidikan'] ?>
                </td>
                <td class="p-3">
                  <span class="<?= $p['status'] == 'aktif' ? 'bg-green-400 text-gray-800' : 'bg-red-400 text-gray-800' ?> bg-green-400 text-gray-50 rounded-md px-2"><?= $p['status'] ?></span>
                </td>
                <td class="p-3 flex">
                  <a href="/update.php?id=<?= $p['id'] ?>" class="text-gray-400 hover:text-gray-100  mx-1 button-edit">
                    <i class="material-icons-outlined text-lg text-yellow-300">edit</i>
                  </a>
                  <form action="" method="POST">
                    <input type="hidden" name="method" value="delete">
                    <input type="hidden" name="id" value="<?= $p['id'] ?>">

                    <button type="submit" class="text-gray-400 hover:text-gray-100  mx-2">
                      <i class="material-icons-round text-lg text-red-400">delete_outline</i>
                    </button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="main-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
    <form action="" method="post" class="border border-teal-500 shadow-lg modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
      <input type="hidden" name="method" value="insert">
      <div class="modal-content py-4 text-left px-6">
        <!--Title-->
        <div class="flex justify-between items-center pb-3">
          <p class="text-2xl font-bold">Tambah Pegawai</p>
          <div class="modal-close cursor-pointer z-50">
            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
              </path>
            </svg>
          </div>
        </div>
        <!--Body-->
        <div class="my-5 flex flex-col gap-5">
          <div class="flex flex-col ">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Name</label>
            <input type="text" name="nama" id="name" class="p-2 border border-gray-300 rounded-md w-full focus:outline-none focus:ring focus:border-blue-500" placeholder="Jhon Doe">
          </div>
          <div>
            <label for="gaji" class="block mb-2 text-sm font-medium text-gray-900 ">Gaji</label>
            <input type="number" name="gaji" id="gaji" class="p-2 border border-gray-300 rounded-md w-full focus:outline-none focus:ring focus:border-blue-500" placeholder="Gaji" min="0">
          </div>

          <div>
            <label for="jabatan" class="block mb-2 text-sm font-medium text-gray-900 ">Jabatan</label>
            <select id="jabatan" name="jabatan_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
              <option selected disabled>Pilih Jabatan</option>
              <?php foreach ($jabatan as $j) : ?>
                <option value="<?= $j['id'] ?>"><?= $j['nama_jabatan'] ?></option>
              <?php endforeach; ?>
            </select>

          </div>
          <div>
            <label for="jabatan" class="block mb-2 text-sm font-medium text-gray-900 ">Golongan</label>
            <select id="jabatan" name="golongan_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
              <option selected disabled>Pilih Golongan</option>
              <?php foreach ($golongan as $g) : ?>
                <option value="<?= $g['id'] ?>"><?= $g['nama_golongan'] ?></option>
              <?php endforeach; ?>
            </select>

          </div>
          <div>
            <label for="jabatan" class="block mb-2 text-sm font-medium text-gray-900 ">Pendidikan</label>
            <select id="jabatan" name="pendidikan_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
              <option selected disabled>Pilih Pendidikan</option>
              <?php foreach ($pendidikan as $p) : ?>
                <option value="<?= $p['id'] ?>">[<?= $p['tingkat'] ?>] <?= $p['tahun'] ?> - <?= $p['tempat_pendidikan'] ?> </option>
              <?php endforeach; ?>
            </select>

          </div>
          <div class="flex items-center gap-2">
            <div>
              Status
            </div>
            <label class="relative inline-flex cursor-pointer items-center">
              <input id="switch" type="checkbox" class="peer sr-only" name="status" />
              <label for="switch" class="hidden"></label>
              <div class="peer h-6 w-11 rounded-full border bg-slate-200 after:absolute after:left-[2px] after:top-0.5 after:h-5 after:w-5 after:rounded-full after:border after:border-green-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-green-400 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:ring-green-300"></div>
            </label>
          </div>
        </div>
      </div>
      <!--Footer-->
      <div class="flex justify-end pt-2 py-4 px-4">
        <button class="focus:outline-none modal-close px-4 bg-gray-400 p-3 rounded-lg text-black hover:bg-gray-300">Cancel</button>
        <button class="focus:outline-none px-4 bg-teal-500 p-3 ml-3 rounded-lg text-white hover:bg-teal-400" type="submit">Confirm</button>
      </div>
    </form>
  </div>
  </div>
  </div>

  <style>
    .main-modal {
      display: none;
    }

    [x-cloak] {
      display: none;
    }

    tr td:nth-child(n+5),
    tr th:nth-child(n+5) {
      border-radius: 0 .625rem .625rem 0;
    }

    tr td:nth-child(1),
    tr th:nth-child(1) {
      border-radius: .625rem 0 0 .625rem;
    }
  </style>

  <script>
    const modal = document.querySelector('.main-modal');
    const closeButton = document.querySelectorAll('.modal-close');
    const elSwitchs = document.querySelectorAll('.elSwitch')
    
    const modalClose = () => {
      modal.classList.remove('fadeIn');
      modal.classList.add('fadeOut');

      setTimeout(() => {
        modal.style.display = 'none';
      }, 500);

      document.querySelector('input[name="id"]').value = ''
      document.querySelector('input[name="nama"]').value = ''
      document.querySelector('input[name="gaji"]').value = ''
      document.querySelector('select[name="jabatan_id"]').value = 0
      document.querySelector('select[name="golongan_id"]').value = 0
      document.querySelector('select[name="pendidikan_id"]').value = 0
      document.querySelector('input[name="status"]').checked = false
      document.querySelector('input[name="method"]').value = 'insert'
    }

    const openModal = () => {
      modal.classList.remove('fadeOut');
      modal.classList.add('fadeIn');
      modal.style.display = 'flex';
    }

    elSwitchs.forEach(e => {
      e.addEventListener('click', function() {
        if (e.classList.contains('left-[155px]')) {
          e.classList.remove('left-[155px]')
          e.classList.add('left-1')
        } else {
          e.classList.remove('left-1')
          e.classList.add('left-[155px]')
        }

      })
    })

    for (let i = 0; i < closeButton.length; i++) {

      const elements = closeButton[i];

      elements.onclick = (e) => modalClose();

      modal.style.display = 'none';

      window.onclick = function(event) {
        if (event.target == modal) modalClose();
      }
    }
  </script>
</body>

</html>