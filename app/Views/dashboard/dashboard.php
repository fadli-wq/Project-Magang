<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
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
        <a href="<?= base_url('logout') ?>"><i class="fa fa-sign-out-alt"></i> Log out</a>
    </div>

<!-- Main Content -->
<div class="container-fluid p-4">
    <h2 class="mb-4"><i class="fa fa-chart-bar"></i> Dashboard</h2>

    <!-- Overview -->
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary shadow">
                <div class="card-body text-center">
                    <i class="fa fa-book fa-2x"></i>
                    <h5 class="card-title mt-2">E-Katalog</h5>
                    <h3 class="fw-bold"><?= count($e_katalog) ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success shadow">
                <div class="card-body text-center">
                    <i class="fa fa-shopping-cart fa-2x"></i>
                    <h5 class="card-title mt-2">PL</h5>
                    <h3 class="fw-bold"><?= count($pl) ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning shadow">
                <div class="card-body text-center">
                    <i class="fa fa-file-contract fa-2x"></i>
                    <h5 class="card-title mt-2">Tender</h5>
                    <h3 class="fw-bold"><?= count($tender) ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger shadow">
                <div class="card-body text-center">
                    <i class="fa fa-calendar-alt fa-2x"></i>
                    <h5 class="card-title mt-2">Termin</h5>
                    <h3 class="fw-bold"><?= count($termin) ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor & Kontrak -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa fa-building"></i> Vendor</h5>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($vendors as $vendor) : ?>
                            <li class="list-group-item"><?= $vendor['penyedia'] ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="fa fa-tasks"></i> Kontrak Status</h5>
                    <button class="btn btn-outline-dark me-2">Kontrak Berjalan</button>
                    <button class="btn btn-outline-dark">Kontrak Selesai</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Rekap -->
    <!-- Rekap -->
<div class="card shadow mt-4" style="background: white; border-radius: 10px;">
  <div class="card-body text-center">
    <h5 class="card-title mb-4"><i class="fa fa-chart-pie"></i> Rekap Nilai Kontrak</h5>
    <div class="d-flex justify-content-center">
      <div style="width: 400px;">
        <canvas id="rekapChart"></canvas>
      </div>
    </div>
  </div>
</div>

</div>


</div>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
<script>
  const ctx = document.getElementById('rekapChart').getContext('2d');

  const totalKontrak = <?= $nilai_kontrak['e_katalog'] + $nilai_kontrak['tender'] + $nilai_kontrak['pl']; ?>;

  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['E-Katalog', 'Tender', 'PL'],
      datasets: [{
        label: 'Total Nilai Kontrak',
        data: [
          <?= $nilai_kontrak['e_katalog']; ?>,
          <?= $nilai_kontrak['tender']; ?>,
          <?= $nilai_kontrak['pl']; ?>
        ],
        backgroundColor: ['#0d6efd', '#ffc107', '#198754'],
        borderColor: '#fff',
        borderWidth: 2
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom'
        },
        tooltip: {
          callbacks: {
            label: function (context) {
              let value = context.raw.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
              });
              return `${context.label}: ${value}`;
            }
          }
        },
        datalabels: {
          color: '#fff',
          formatter: (value, context) => {
            let percentage = (value / totalKontrak * 100).toFixed(1);
            return percentage + '%';
          },
          font: {
            weight: 'bold'
          }
        }
      }
    },
    plugins: [ChartDataLabels]
  });
</script>


</body>
</html>
