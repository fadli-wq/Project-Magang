<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Termin</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
        h2{
          color: black;
        }
        body {
            background: linear-gradient(to right, #E6F4FF, #95B4E1, #60A0E9);
            color: black;
        }
        .sidebar {
            background: linear-gradient(to bottom, #5D56C6, #060334);
            width: 250px;
            min-height: 100vh;
            padding: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
        }
        .sidebar a:hover, .active {
            background: rgba(255, 255, 255, 0.2);
        }
        img{
          width: 150px;
        }
  </style>
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar">
        <h3 class="text-center" style="color: white;">Admin</h3>
        <a href="<?= base_url('dashboard') ?>"><i class="fa fa-home"></i> Dashboard</a>
        <a href="<?= base_url('kontrak')?>"><i class="fa fa-file-contract"></i> Kontrak <i class="fa fa-chevron-down float-end"></i></a>
        <ul class="list-unstyled ps-3">
            <li><a href="<?= base_url('kontrak/e-katalog')?>">• E-Katalog</a></li>
            <li><a href="<?= base_url('kontrak/pl')?>">• PL</a></li>
            <li><a href="<?= base_url('kontrak/tender')?>">• Tender</a></li>
        </ul>
        <a href="<?= base_url('termin') ?>" class="active"><i class="fa fa-calendar"></i> Termin</a>
        <img src="<?= base_url('assets/images/logo_white.png') ?>" alt="Logo">
        <a href="<?= base_url('logout') ?>"><i class="fa fa-sign-out-alt"></i> Log out</a>
    </div>
    <div class="container-fluid p-4">
      <h2 class="text-center">Input Termin</h2>
      <div class="dashboard-content mb-4">
          <form action="<?= base_url('termin/simpan') ?>" method="post">
              <?= csrf_field() ?>

              <div class="mb-3">
        <label class="form-label">Pilih Kontrak</label>
        <select name="kontrak_id" class="form-control" required>
            <option value="">-- Pilih Kontrak --</option>
            <optgroup label="E-Katalog">
                <?php foreach ($kontrak_ekatalog as $k) : ?>
                    <option value="<?= $k['id']; ?>">
                        <?= $k['nomor_kontrak'] ?? 'Tanpa Nomor' ?> - <?= $k['nama']; ?>
                    </option>
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="Tender">
                <?php foreach ($kontrak_tender as $t) : ?>
                    <option value="<?= $t['id']; ?>">
                        <?= $t['nomor_kontrak'] ?? 'Tanpa Nomor' ?> - <?= $t['nama']; ?>
                    </option>
                <?php endforeach; ?>
            </optgroup>
        </select>
    </div>
              <div class="mb-3">
                  <label class="form-label">Tanggal Termin</label>
                  <input type="date" name="tgl_termin" class="form-control" required>
              </div>

              <div class="mb-3">
                  <label class="form-label">Termin Ke</label>
                  <input type="number" name="termin_ke" class="form-control" required>
              </div>

              <div class="mb-3">
                  <label class="form-label">Nilai Termin</label>
                  <input type="number" name="nilai_termin" class="form-control" required>
              </div>

              <button type="submit" class="btn btn-primary w-100">Simpan</button>
              <?php if (session()->getFlashdata('success')) : ?>
                  <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
              <?php endif; ?>
              <?php if (session()->getFlashdata('error')) : ?>
                  <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
              <?php endif; ?>

          </form>
      </div>
</body>
</html>