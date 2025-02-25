<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image/png" href="<?= base_url('assets/images/logo.png'); ?>">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pengelolaan Barang/Jasa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div style="display: flex;">
    <!-- Sidebar -->
    <div class="sidebar">
        <div>
            <img src="<?= base_url('assets/images/image.png') ?>" alt="Profile Icon" class="profile-img">
            <h2>Admin</h2>
        </div>
        
        <ul class="menu">
            <li>
                <a href="<?= base_url('dashboard') ?>">
                    <i class="icon-home"></i> Dashboard
                </a>
            </li>
            <li class="submenu">
                <a href="#" class="submenu-toggle">
                    <i class="icon-document"></i> Kontrak
                    <span class="submenu-arrow">▼</span>
                </a>
                <ul class="submenu-content">
                    <li><a href="<?= base_url('kontrak/e-katalog') ?>">E-Katalog</a></li>
                    <li><a href="<?= base_url('kontrak/pl') ?>">PL</a></li>
                    <li><a href="<?= base_url('kontrak/tender') ?>">Tender</a></li>
                </ul>
            </li>
            <li>
                <a href="<?= base_url('termin') ?>" class="active">
                    <i class="icon-calendar"></i> <p class="termin">Termin</p>
                </a>
            </li>
        </ul>
    
        <div class="branding">
            <img src="<?= base_url('assets/images/logo_white.png') ?>" alt="Simproka Logo">
        </div>
    
        <a href="<?= base_url('logout') ?>" class="logout">
            Log out
        </a>
    </div>
    
    <!-- Main Content -->
    <div style="flex-grow: 1; padding: 20px; display: flex; justify-content: center;">
        <form action="<?= base_url('termin_pembayaran/store') ?>" method="post" style="width: 80%; max-width: 800px; padding: 30px; background: #f8fbff; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0,0,0,0.1);">
            <h2 style="text-align: center;">Input Termin</h2>
            
            <label for="kontrak_id">Nomor Kontrak:</label>
            <input type="text" name="kontrak_id" id="kontrak_id" required style="width: 100%; padding: 12px; margin-bottom: 15px; font-size: 16px;">
            
            <label for="jumlah">Jumlah Pembayaran:</label>
            <input type="number" name="jumlah" id="jumlah" required style="width: 100%; padding: 12px; margin-bottom: 15px; font-size: 16px;">
            
            <label for="tgl_pembayaran">Tanggal Pembayaran:</label>
            <input type="date" name="tgl_pembayaran" id="tgl_pembayaran" required style="width: 100%; padding: 12px; margin-bottom: 15px; font-size: 16px;">
            
            <label for="termin_ke">Termin ke:</label>
            <input type="number" name="termin_ke" id="termin_ke" required style="width: 100%; padding: 12px; margin-bottom: 15px; font-size: 16px;">
            
            <div style="display: flex; justify-content: space-between;">
                <button type="submit" style="background: #007bff; color: white; padding: 12px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">Simpan</button>
                <button type="button" style="background: #dfeaff; color: black; padding: 12px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">Selesaikan per termin</button>
            </div>
        </form>
    </div>
</div>

<style>
    body {
      background-color: #E6F4FF;
    }
    .termin{
      color: black;
    }
    .menu,.submenu,.branding {
      font-size: large;
    }
    .sidebar {
        width: 378px;
        height: 100vh;
        background: #373280;
        color: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
    }
    .profile-section {
        text-align: center;
        margin-bottom: 20px;
    }
    .profile-img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: white;
        padding: 10px;
    }
    h2 {
        font-size: 22px;
        margin-top: 10px;
    }
    .menu {
        list-style: none;
        padding: 0;
        width: 100%;
    }
    .menu li {
        padding: 10px 20px;
    }
    .menu a {
        color: white;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .submenu-content {
        display: none;
        list-style: none;
        padding-left: 20px;
    }
    .submenu:hover .submenu-content {
        display: block;
    }
    .active {
        background: #D7E9FF;
        color: black;
        border-radius: 10px;
    }
    .branding img {
        width: 150px;
        margin-top: 30px;
    }
    .logout {
        margin-top: auto;
        color: white;
        text-decoration: none;
    }
</style>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
