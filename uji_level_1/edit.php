<?php
include 'connect.php';

// EDIT PEMINJAMAN
if (isset($_POST['simpanpeminjaman'])) {
    $id_pinjam = $_POST['id_peminjaman'];
    $no_p = $_POST['no_pengguna'];
    $tgl = $_POST['tgl_pinjam'];
    $kembali = $_POST['dikembalikan'];

    $sql = "UPDATE peminjaman SET dikembalikan='$kembali' WHERE id_peminjaman='$id_pinjam';";

    $query = mysqli_query($connect, $sql);
    if ($query) {
        header('Location: peminjaman.php');
    }else {
        header('Location: edit.php?status=gagal');
    }
}

// EDIT PENGGUNA
if (isset($_POST['simpanpengguna'])) {
    $no_p = $_POST['no_pengguna'];
    $nama_p = $_POST['nama_pengguna'];
    $ktg = $_POST['kategori'];

    $sql = "UPDATE pengguna SET nama_pengguna='$nama_p', kategori='$ktg' WHERE no_pengguna='$no_p';";

    $query = mysqli_query($connect, $sql);
    if ($query) {
        header('Location: pengguna.php');
    }else {
        header('Location: edit.php?status=gagal');
    }
}

// EDIT PEGAWAI
if (isset($_POST['simpanpegawai'])) {
    $id_p = $_POST['id_pegawai'];
    $nama_p = $_POST['nama_pegawai'];

    $sql = "UPDATE pegawai SET nama_pegawai='$nama_p' WHERE id_pegawai='$id_p';";

    $query = mysqli_query($connect, $sql);
    if ($query) {
        header('Location: pegawai.php');
    }else {
        header('Location: edit.php?status=gagal');
    }
}

// EDIT BARANG
if (isset($_POST['simpanbarang'])) {
    $id_b = $_POST['id_barang'];
    $nama_b = $_POST['nama_barang'];

    $sql = "UPDATE barang SET nama_barang='$nama_b' WHERE id_barang='$id_b';";

    $query = mysqli_query($connect, $sql);
    if ($query) {
        header('Location: barang.php');
    }else {
        header('Location: edit.php?status=gagal');
    }
}

// EDIT INVENTORI
if (isset($_POST['simpaninventori'])) {
    $id_iv = $_POST['id_inventori'];
    $id_b = $_POST['id_barang'];
    $jumlah_b = $_POST['jumlah_barang'];
    $kondisi = $_POST['kondisi'];

    $sql = "UPDATE inventori SET jumlah_barang='$jumlah_b', kondisi='$kondisi' WHERE id_inventori='$id_iv'";

    $query = mysqli_query($connect, $sql);
    if ($query) {
        header('Location: inventori.php');
    }else {
        header('Location: edit.php?status=gagal');
    }
}

?>