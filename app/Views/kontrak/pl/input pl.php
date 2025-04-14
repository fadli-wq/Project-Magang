<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pl</title>
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
        label{
          color: black;
        }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar">
        <h3 class="text-center">Admin</h3>
        <a href="<?= base_url('dashboard') ?>"><i class="fa fa-home"></i> Dashboard</a>
        <a href="<?= base_url('kontrak')?>" ><i class="fa fa-file-contract" ></i> Kontrak <i class="fa fa-chevron-down float-end"></i></a>
        <ul class="list-unstyled ps-3">
            <li><a href="<?= base_url('kontrak/e-katalog')?>">• E-Katalog</a></li>
            <li><a href="<?= base_url('kontrak/pl')?>" class="active">• PL</a></li>
            <li><a href="<?= base_url('kontrak/tender')?>" >• Tender</a></li>
        </ul>
        <a href="<?= base_url('termin') ?>"><i class="fa fa-calendar"></i> Termin</a>
        <img src="<?= base_url('assets/images/logo_white.png') ?>" alt="Logo">
        <a href="<?= base_url('logout') ?>"><i class="fa fa-sign-out-alt"></i> Log out</a>
    </div>

    <!-- Main Content -->
    <div class="container-fluid p-4">
        <h2 class="text-center">Input PL</h2>
        <div class="form-container">
            <form action="<?= base_url('kontrak/pl_simpan_session') ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label" for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan Nama" value="<?= session()->get('pl.nama') ?? '' ?>" required>
                </div>                
                <div class="row">
    <!-- Nomor Surat Perjanjian -->
    <div class="col-md-6">
        <div class="mb-3">
            <label for="nomor_perjanjian" class="form-label">SPK</label>
            <input type="text" name="nomor_perjanjian" id="nomor_Perjanjian" class="form-control"
                placeholder="Masukkan Nomor Surat Perjanjian"
                value="<?= session()->get('pl.nomor_perjanjian') ?? '' ?>">
        </div>
    </div>

    <!-- Nomor SPMK -->
    <div class="col-md-6">
        <div class="mb-3">
            <label for="nomor_spmk" class="form-label">Nomor SPMK</label>
            <input type="text" name="nomor_spmk" id="nomor_Spmk" class="form-control"
                placeholder="Masukkan SPMK"
                value="<?= session()->get('pl.nomor_spmk') ?? '' ?>">
        </div>
    </div>
</div>

<div class="row">
    <!-- Tanggal Perjanjian -->
    <div class="col-md-6">
        <div class="mb-3">
            <label for="tgl_spk" class="form-label">Tanggal SPK</label>
            <input type="date" name="tgl_perjanjian" id="tgl_spk" class="form-control"
                value="<?= session()->get('pl.tgl_spk') ?? '' ?>">
        </div>
    </div>

    <!-- Tanggal SPMK -->
    <div class="col-md-6">
        <div class="mb-3">
            <label for="tgl_spmk" class="form-label">Tanggal SPMK</label>
            <input type="date" name="tgl_spmk" id="tgl_Spmk" class="form-control"
                value="<?= session()->get('pl.tgl_spmk') ?? '' ?>">
        </div>
    </div>
</div>
                </div>    
                <div class="mb-3">
                    <label class="form-label">Tanggal Delivery</label>
                    <input type="date" class="form-control" name="tgl_delivery" value="<?= session()->get('pl.tgl_delivery') ?? '' ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Lama Pekerjaan (Hari)</label>
                    <input type="number" class="form-control" name="lama_pekerjaan" placeholder="Masukkan Lama Pekerjaan" value="<?= session()->get('pl.lama_pekerjaan') ?? '' ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nilai Kontrak</label>
                    <input type="number" class="form-control" name="nilai_kontrak" placeholder="Masukkan Nilai Kontrak" value="<?= session()->get('pl.nilai_kontrak') ?? '' ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Terbilang</label>
                    <input type="text" class="form-control" name="terbilang" placeholder="Masukkan Nilai Terbilang" value="<?= session()->get('pl.terbilang') ?? '' ?>" required>
                </div>
                <button type="submit" class="btn btn-submit w-100">Next</button>
            </form>
        </div>
    </div>
</div>
<script>
window.onload = function () {
    document.getElementById("nomor_spk").value = "<?= session()->get('pl.nomor_spk') ?? '' ?>";
    document.getElementById("nomor_spmk").value = "<?= session()->get('pl.nomor_spmk') ?? '' ?>";
    
    document.getElementById("tgl_spk").value = "<?= session()->get('pl.tgl_spk') ?? '' ?>";
    document.getElementById("tgl_spmk").value = "<?= session()->get('pl.tgl_spmk') ?? '' ?>";
};
</script>

</body>
</html>
