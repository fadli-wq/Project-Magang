<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Tender</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        h2 {
          color: black;
        }
        body {
            background: linear-gradient(to right, #E6F4FF, #95B4E1, #60A0E9);
            color: white;
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
        .dashboard-content {
            padding: 20px;
            background: white;
            color: black;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-submit {
            background: #5D56C6;
            color: white;
        }
        .btn-submit:hover {
            background: #4a47a3;
        }
        label {
          color: black;
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
        <h3 class="text-center">Admin</h3>
        <a href="<?= base_url('dashboard') ?>"><i class="fa fa-home"></i> Dashboard</a>
        <a href="<?= base_url('kontrak') ?>" ><i class="fa fa-file-contract"></i> Kontrak <i class="fa fa-chevron-down float-end"></i></a>
        <ul class="list-unstyled ps-3">
            <li><a href="<?= base_url('kontrak/e-katalog') ?>">• E-Katalog</a></li>
            <li><a href="<?= base_url('kontrak/pl') ?>">• PL</a></li>
            <li><a href="<?= base_url('kontrak/tender') ?>" class="active">• Tender</a></li>
        </ul>
        <a href="<?= base_url('termin') ?>"><i class="fa fa-calendar"></i> Termin</a>
        <img src="<?= base_url('assets/images/logo_white.png') ?>" alt="Logo">
        <a href="#"><i class="fa fa-sign-out-alt"></i> Log out</a>
    </div>

    <!-- Main Content -->
    <div class="container-fluid p-4">
        <h2 class="text-center">Input Item Tender</h2>
        <div class="form-container">
        <form action="<?= base_url('kontrak/tender/pembayaran/termin/item_submit') ?>" method="post">
          <?= csrf_field() ?>
          <label>Kode Paket</label>
          <input type="text" name="kode_paket" class="form-control" value="<?= session()->get('tender_item.kode_paket') ?? '' ?>" required>
          <label>Kode Item</label>
          <input type="text" name="kode_item" class="form-control" value="<?= session()->get('tender_item.kode_item') ?? '' ?>" required>
          <label>Nama Item</label>
          <input type="text" name="nama_item" class="form-control" value="<?= session()->get('tender_item.nama_item') ?? '' ?>" required>
          <label>Kuantitas</label>
          <input type="number" name="kuantitas" class="form-control" value="<?= session()->get('tender_item.kuantitas') ?? '' ?>" required>
          <label>Harga Satuan</label>
          <input type="number" name="harga_satuan" class="form-control" value="<?= session()->get('tender_item.harga_satuan') ?? '' ?>" required>
          <label class="form-label">Penyedia</label>
                    <select name="penyedia" class="form-control" required>
                        <option value="Raihan" <?= (session()->get('tender_item.penyedia') == 'Raihan') ? 'selected' : '' ?>>Raihan</option>
                        <option value="Rohan" <?= (session()->get('tender_item.penyedia') == 'Rohan') ? 'selected' : '' ?>>Rohan</option>
                    </select>
          <div class="d-flex justify-content-between">
              <a href="<?= base_url('kontrak/tender/pembayaran') ?>" class="btn btn-secondary mt-3">Back</a>
              <button type="submit" class="btn btn-submit mt-3 btn-md">Simpan</button>
          </div>
        </form>
        </div>
    </div>
</div>

</body>
</html>
