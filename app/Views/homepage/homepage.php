<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencatatan Pengadaan Barang dan Jasa</title>
    <style>
        body {
            background: linear-gradient(to bottom right, #00BCD4, #1A237E);
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            display: flex;
            width: 80%;
            height: 80vh;
            align-items: center;
            justify-content: space-between;
        }
        .text-section {
            flex: 1;
            padding: 40px;
        }
        .text-section h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }
        .login-button {
            display: inline-block;
            background: white;
            color: black;
            padding: 15px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-size: 20px;
            font-weight: bold;
        }
        .card {
            flex: 1;
            background: white;
            color: black;
            padding: 40px;
            border-radius: 20px;
            width: 100%;
            text-align: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        .card img {
            width: 50%;
            margin-bottom: 20px;
        }
        .arrow {
            font-size: 32px;
            cursor: pointer;
        }
        h3{
          font-size: 50px;
          font-weight: normal;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-section">
            <h1>Pencatatan Pengadaan Barang dan Jasa</h1>
            <a href="<?= base_url('login')?>" class="login-button">Login</a>
        </div>
        <div class="card">
            <img id="image" src="<?= base_url('assets/images/box-icon.png') ?>" alt="Barang">
            <h3 id="title">Barang</h3>
            <span class="arrow" onclick="nextImage()">➡️</span>
        </div>
    </div>
    <script>
        const images = [
            { src: "<?= base_url('assets/images/box-icon.png') ?>", title: "Barang" },
            { src: "<?= base_url('assets/images/jasa.png') ?>", title: "Jasa" },
            { src: "<?= base_url('assets/images/kontrak2.png') ?>", title: "Kontrak" }
        ];

        let index = 0;

        function nextImage() {
            index = (index + 1) % images.length;
            document.getElementById("image").src = images[index].src;
            document.getElementById("title").innerText = images[index].title;
        }
    </script>
</body>
</html>
