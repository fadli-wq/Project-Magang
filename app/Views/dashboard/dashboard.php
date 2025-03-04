<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
        <a href="#" class="active"><i class="fa fa-home"></i> Dashboard</a>
        <a href="<?= base_url('kontrak')?>"><i class="fa fa-file-contract"></i> Kontrak <i class="fa fa-chevron-down float-end"></i></a>
        <ul class="list-unstyled ps-3">
            <li><a href="<?= base_url('kontrak/e-katalog')?>">• E-Katalog</a></li>
            <li><a href="<?= base_url('kontrak/pl')?>">• PL</a></li>
            <li><a href="<?= base_url('kontrak/tender')?>">• Tender</a></li>
        </ul>
        <a href="<?= base_url('termin') ?>"><i class="fa fa-calendar"></i> Termin</a>
        <img src="<?= base_url('assets/images/logo_white.png') ?>" alt="Logo">
        <a href="#"><i class="fa fa-sign-out-alt"></i> Log out</a>
    </div>

    <!-- Main Content -->
    <div class="container-fluid p-4">
        <h2>Welcome Admin!</h2>

        <!-- Overview -->
        <div class="dashboard-content mb-4">
            <h4>Over View</h4>
            <div class="row">
                <div class="col-md-3">
                    <button class="btn btn-outline-dark w-100">E-Katalog</button>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-outline-dark w-100">PL</button>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-outline-dark w-100">Tender</button>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-outline-dark w-100">Termin</button>
                </div>
            </div>
        </div>

        <!-- Vendor & Kontrak -->
        <div class="row">
            <div class="col-md-6">
                <div class="dashboard-content text-center">
                    <h5>Vendor</h5>
                </div>
            </div>
            <div class="col-md-6">
                <div class="dashboard-content text-center">
                    <button class="btn btn-outline-dark">Jumlah Kontrak Berjalanan</button>
                    <button class="btn btn-outline-dark">Jumlah Kontrak Selesai</button>
                </div>
            </div>
        </div>

        <!-- Rekap -->
        <div class="dashboard-content mt-4">
            <h4>Rekap</h4>
            <button class="btn btn-outline-dark">Tahunan</button>
            <button class="btn btn-outline-dark">2025</button>
        </div>
    </div>
</div>

</body>
</html>
