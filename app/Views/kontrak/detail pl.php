<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kontrak E-Katalog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2>Detail Kontrak PL</h2>

    <div class="card p-3 mt-3">
        <h4>Informasi Kontrak</h4>
        <p><strong>Nama:</strong> <?= $kontrak['nama'] ?></p>
        <p><strong>Nilai Kontrak:</strong> Rp <?= number_format($kontrak['nilai_kontrak'], 0, ',', '.') ?></p>
        <p><strong>Tanggal Delivery:</strong> <?= $kontrak['tgl_delivery'] ?></p>

        <h5>Jenis Kontrak:</h5>
        <ul>
            <?php if (!empty($kontrak['nomor_spk'])) : ?>
                <li><strong>Nomor SP:</strong> <?= $kontrak['nomor_spk'] ?> (<?= $kontrak['tgl_spk'] ?>)</li>
            <?php endif; ?>

            <?php if (!empty($kontrak['nomor_spmk'])) : ?>
                <li><strong>Nomor SPMK:</strong> <?= $kontrak['nomor_spmk'] ?> (<?= $kontrak['tgl_spmk'] ?>)</li>
            <?php endif; ?>
        </ul>
    </div>

    <div class="card p-3 mt-3">
        <h4>Informasi Pembayaran</h4>
        <?php if ($pembayaran) : ?>
            <p><strong>Pagu:</strong> Rp <?= number_format($pembayaran['pagu'], 0, ',', '.') ?></p>
            <p><strong>Metode Pembayaran:</strong> <?= $pembayaran['metode'] ?></p>
            <p><strong>Jumlah Termin:</strong> <?= $pembayaran['jumlah_termin'] ?></p>
            <p><strong>Sumber Dana:</strong> <?= $pembayaran['sumber_dana'] ?></p>
        <?php else : ?>
            <p>Belum ada data pembayaran.</p>
        <?php endif; ?>
    </div>

    <div class="card p-3 mt-3">
        <h4>Item Kontrak</h4>
        <?php if ($items) : ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kode Paket</th>
                        <th>Kode Item</th>
                        <th>Nama Item</th>
                        <th>Kuantitas</th>
                        <th>Harga Satuan</th>
                        <th>Penyedia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item) : ?>
                        <tr>
                            <td><?= $item['kode_paket'] ?></td>
                            <td><?= $item['kode_item'] ?></td>
                            <td><?= $item['nama_item'] ?></td>
                            <td><?= $item['kuantitas'] ?></td>
                            <td>Rp <?= number_format($item['harga_satuan'], 0, ',', '.') ?></td>
                            <td><?= $item['penyedia'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Belum ada item yang terdaftar.</p>
        <?php endif; ?>
    </div>

    <a href="<?= base_url('kontrak/pl/daftar_kontrak_pl') ?>" class="btn btn-secondary mt-3">Kembali</a>
</div>

</body>
</html>
