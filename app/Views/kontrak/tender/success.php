<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Berhasil Disimpan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #E6F4FF, #95B4E1, #60A0E9);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .success-card {
      background-color: white;
      border-radius: 12px;
      padding: 40px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      text-align: center;
      max-width: 500px;
    }
    .success-icon {
      font-size: 48px;
      color: #28a745;
    }
    .btn-back {
      margin-top: 20px;
    }
  </style>
</head>
<body>

<div class="success-card">
  <i class="fas fa-check-circle success-icon mb-3"></i>
  <h2 class="text-success mb-3">Data Berhasil Disimpan!</h2>
  <p class="text-muted">Terima kasih. Data Anda telah tercatat dengan baik dalam sistem.</p>
  <a href="<?= base_url('dashboard') ?>" class="btn btn-success btn-back">
    <i class="fa fa-arrow-left me-1"></i> Kembali ke Dashboard
  </a>
</div>

</body>
</html>
