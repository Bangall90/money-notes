<?php
$data = json_decode(file_get_contents('data.json'), true) ?? [];
?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Highlight row on click delete
            document.querySelectorAll('.delete-btn').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    const row = btn.closest('tr');
                    row.style.background = '#ffcdd2';
                    setTimeout(() => {
                        row.style.background = '';
                    }, 800);
                });
            });

            // Feedback sukses hapus (jika ada query ?hapus=ok)
            const params = new URLSearchParams(window.location.search);
            if (params.get('hapus') === 'ok') {
                showFeedback('Transaksi berhasil dihapus!', false);
            }

            function showFeedback(msg, isError) {
                let feedback = document.getElementById('feedback');
                if (!feedback) {
                    feedback = document.createElement('div');
                    feedback.id = 'feedback';
                    feedback.style.margin = '12px 0 0 0';
                    feedback.style.padding = '10px 18px';
                    feedback.style.borderRadius = '6px';
                    feedback.style.background = isError ? '#ffcdd2' : '#c8e6c9';
                    feedback.style.color = isError ? '#b71c1c' : '#234d20';
                    feedback.style.fontWeight = 'bold';
                    document.querySelector('.container').insertBefore(feedback, document.querySelector('.container').firstChild.nextSibling);
                }
                feedback.textContent = msg;
                feedback.style.display = 'block';
                setTimeout(() => {
                    feedback.style.display = 'none';
                }, 2200);
            }
        });
    </script>
</head>

<body>
    <div class="container">
        <h2>Daftar Transaksi</h2>
        <a href="tambah.php" class="add-btn">+ Tambah Transaksi</a>
        <div class="table-responsive">
            <table>
                <tr>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Jumlah (Rp)</th>
                    <th>Aksi</th>
                </tr>
                <?php foreach ($data as $i => $transaksi): ?>
                    <tr>
                        <td><?= $transaksi['tanggal'] ?></td>
                        <td><?= $transaksi['keterangan'] ?></td>
                        <td><?= number_format($transaksi['jumlah'], 0, ',', '.') ?></td>
                        <td>
                            <a href="hapus.php?id=<?= $i ?>" class="delete-btn" onclick="return confirm('Yakin mau dihapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <?php
        // Inisialisasi total
        $totalMasuk = 0;
        $totalKeluar = 0;
        foreach ($data as $transaksi) {
            $jumlah = $transaksi['jumlah'];
            if ($jumlah > 0) {
                $totalMasuk += $jumlah;
            } else {
                $totalKeluar += abs($jumlah);
            }
        }
        $saldoAkhir = $totalMasuk - $totalKeluar;
        ?>

        <div class="summary">
            <h3>Ringkasan Keuangan</h3>
            <ul>
                <li>Total Pemasukan: <strong>Rp <?= number_format($totalMasuk, 0, ',', '.') ?></strong></li>
                <li>Total Pengeluaran: <strong>Rp <?= number_format($totalKeluar, 0, ',', '.') ?></strong></li>
                <li>Saldo Akhir: <strong>Rp <?= number_format($saldoAkhir, 0, ',', '.') ?></strong></li>
            </ul>
        </div>
    </div>
</body>