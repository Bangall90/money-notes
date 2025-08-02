<?php
// Ambil data dari form
$tanggal = $_POST['tanggal'];
$keterangan = $_POST['keterangan'];
$jumlah = str_replace('.', '', $_POST['jumlah']); // hapus titik ribuan
$jumlah = (int) $jumlah;


// Ambil data lama
$file = 'data.json';
$data = json_decode(file_get_contents($file), true);

// Tambah data baru
$data[] = [
    'tanggal' => $tanggal,
    'keterangan' => $keterangan,
    'jumlah' => (int)$jumlah
];

// Simpan kembali ke file
file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

// Kembali ke index
header('Location: index.php');
exit;
