<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kontrak Tender</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { background: linear-gradient(to right, #E6F4FF, #95B4E1, #60A0E9); }
        .container { margin-top: 20px; }
        .card-custom { background: white; padding: 20px; border-radius: 10px; box-shadow: 2px 2px 10px rgba(0,0,0,0.1); }
        .table thead { background: #5D56C6; color: white; }
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
        .menu-container {
            display: flex;
            gap: 20px;
        }
        .menu-card {
            background: white;
            color: black;
            padding: 20px;
            border-radius: 8px;
            width: 200px;
            text-align: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }
        .menu-card:hover {
            background: #5D56C6;
            color: white;
        }
        img{
          width: 150px;
        }
    </style>
</head>
<body>

<div class="d-flex">
  <div class="sidebar">
          <h3 class="text-center" style="color: white;">Admin</h3>
          <a href="<?= base_url('dashboard') ?>"><i class="fa fa-home"></i> Dashboard</a>
          <a href="<?= base_url('kontrak')?>" ><i class="fa fa-file-contract" ></i> Kontrak <i class="fa fa-chevron-down float-end"></i></a>
          <ul class="list-unstyled ps-3">
              <li><a href="<?= base_url('kontrak/e-katalog')?>">• E-Katalog</a></li>
              <li><a href="<?= base_url('kontrak/pl')?>">• PL</a></li>
              <li><a href="<?= base_url('kontrak/tender')?>" class="active">• Tender</a></li>
          </ul>
          <a href="<?= base_url('termin') ?>"><i class="fa fa-calendar"></i> Termin</a>
          <img src="<?= base_url('assets/images/logo_white.png') ?>" alt="Logo">
          <a href="<?= base_url('logout') ?>"><i class="fa fa-sign-out-alt"></i> Log out</a>
      </div>
<div class="container-fluid p-4">
    <h2 class="text-center">Daftar Kontrak Tender</h2>

    <!-- TABEL Perjanjian -->
    <div class="card-custom mt-4">
        <h4>Kontrak Perjanjian & SMPK</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Nomor Surat Perjanjian</th>
                    <th>Tanggal Perjanjian</th>
                    <th>Nilai Kontrak</th>
                    <th>Pagu</th>
                    <th>Metode</th>
                    <th>Jumlah Termin</th>
                    <th>Sumber Dana</th>
                    <th>Jumlah Item</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kontrakPerjanjian as $kontrak) : ?>
                <tr>
                    <td><?= $kontrak['id']; ?></td>
                    <td><?= $kontrak['nama']; ?></td>
                    <td><?= $kontrak['nomor_perjanjian']; ?></td>
                    <td><?= $kontrak['tgl_perjanjian']; ?></td>
                    <td>Rp <?= number_format($kontrak['nilai_kontrak'], 0, ',', '.'); ?></td>
                    <td>Rp <?= number_format($kontrak['pembayaran']['pagu'] ?? 0, 0, ',', '.'); ?></td>
                    <td><?= $kontrak['pembayaran']['metode'] ?? '-'; ?></td>
                    <td><?= $kontrak['pembayaran']['jumlah_termin'] ?? '-'; ?></td>
                    <td><?= $kontrak['pembayaran']['sumber_dana'] ?? '-'; ?></td>
                    <td><?= count($kontrak['items']); ?></td>
                    <td><a href="<?= base_url('kontrak/tender/daftar_kontrak_tender/' . $kontrak['id']); ?>" class="btn btn-primary btn-sm">Detail</a>
                    <a href="<?= base_url('kontrak/tender/generatePerjanjian/' . $kontrak['id']); ?>" class="btn btn-success btn-sm">
                          <i class="fa fa-download"></i> Unduh Perjanjian
                    </a>
                    <a href="<?= base_url('kontrak/tender/generateSPMK/' . $kontrak['id']); ?>" class="btn btn-success btn-sm">
                          <i class="fa fa-download"></i> Unduh SPMK
                    </a>
                    <form action="<?= base_url('tender/delete/' . $kontrak['id']) ?>" method="post" style="display:inline;">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus Data Tender ini?');">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
