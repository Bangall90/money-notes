<?php
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $file = 'data.json';
    $data = json_decode(file_get_contents($file), true);

    // Hapus data berdasarkan index
    unset($data[$id]);

    // Reset index array
    $data = array_values($data);

    // Simpan ulang
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}

// Kembali ke halaman utama
header('Location: index.php');
exit;
