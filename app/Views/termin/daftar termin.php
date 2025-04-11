<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        h2{
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
        <a href="<?= base_url('kontrak')?>"><i class="fa fa-file-contract"></i> Kontrak <i class="fa fa-chevron-down float-end"></i></a>
        <ul class="list-unstyled ps-3">
            <li><a href="<?= base_url('kontrak/e-katalog')?>">• E-Katalog</a></li>
            <li><a href="<?= base_url('kontrak/pl')?>">• PL</a></li>
            <li><a href="<?= base_url('kontrak/tender')?>">• Tender</a></li>
        </ul>
        <a href="<?= base_url('termin') ?>" class="active"><i class="fa fa-calendar"></i> Termin</a>
        <img src="<?= base_url('assets/images/logo_white.png') ?>" alt="Logo">
        <a href="#"><i class="fa fa-sign-out-alt"></i> Log out</a>
    </div>

    <!-- Main Content -->
    <div class="container-fluid p-4">
        <h2>Data Termin</h2>
        <!-- List Termin -->
        <div class="dashboard-content">
            <h4>Daftar Termin</h4>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nomor Kontrak</th>
                        <th>Termin ke</th>
                        <th>Tanggal</th>
                        <th>Nilai Termin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($termins as $termin): ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?= $kontrakList[$termin['kontrak_id']] ?? 'Tidak Dikenal' ?></td>
                          <td><?= $termin['termin_ke'] ?></td>
                          <td><?= $termin['tgl_termin'] ?></td>
                          <td>Rp <?= number_format($termin['nilai_termin'], 0, ',', '.') ?></td>
                          <td>
                                  <!-- Tombol Edit -->
                            <form action="<?= base_url('termin/edit/' . $termin['id']) ?>" method="post" style="display:inline;">
                                <button type="submit" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                            </form>

                            <!-- Tombol Hapus -->
                            <form action="<?= base_url('termin/delete/' . $termin['id']) ?>" method="post" style="display:inline;">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus termin ini?');">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                            <form action="<?= base_url('termin/done' . $termin['id']) ?>" method="post" style="display:inline;">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Selesaikan Termin?');">
                                    <i class="fa fa-check"></i> Selesai
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

</body>
</html>
