<?php
include 'connect.php';

// HAPUS DATA PENGGUNA
if (isset($_GET['no_pengguna'])) {
    $no_pgn = $_GET['no_pengguna'];
    $sql = "DELETE FROM pengguna WHERE no_pengguna='$no_pgn'";
    $query = mysqli_query($connect,$sql);

    if ($query) {
        header('Location: pengguna.php');
    }else{
        header('Location: hapus.php?status=gagal');
    }
}

// HAPUS DATA PEGAWAI
if (isset($_GET['id_pegawai'])) {
    $id_pgw = $_GET['id_pegawai'];
    $sql = "DELETE FROM pegawai WHERE id_pegawai='$id_pgw'";
    $query = mysqli_query($connect,$sql);

    if ($query) {
        header('Location: pegawai.php');
    }else{
        header('Location: hapus.php?status=gagal');
    }
}

// HAPUS DATA BARANG
// if (isset($_GET['id_barang'])) {
//     $id_brg = $_GET['id_barang'];
//     $sql = "DELETE FROM barang WHERE id_barang='$id_brg'";
//     $query = mysqli_query($connect,$sql);

//     if ($query) {
//         header('Location: barang.php');
//     }else{
//         header('Location: hapus.php?status=gagal');
//     }
// }

// HAPUS DATA INVENTORI
// if (isset($_GET['id_barang'])) {
//     $id_brg = $_GET['id_barang'];
//     $sql = "DELETE FROM inventori WHERE id_barang='$id_brg'";
//     $query = mysqli_query($connect,$sql);

//     if ($query) {
//         header('Location: barang.php');
//     }else{
//         header('Location: hapus.php?status=gagal');
//     }
// }

// SEKALIGUS INVENTORI DAN BARANG
if (isset($_GET['id_barang'])) {
    $id_brg = $_GET['id_barang'];
    $sql = "DELETE FROM inventori WHERE id_barang='$id_brg'";
    $query = mysqli_query($connect,$sql);

    if ($query) {
        $sql = "DELETE FROM barang WHERE id_barang='$id_brg'";
        $query = mysqli_query($connect,$sql);
        if ($query) {
            header('Location: barang.php');
        }else{
            header('Location: hapus.php?status=gagal-pas-hapus-barang');
        };
    }else{
        header('Location: hapus.php?status=gagal-pas-hapus-inventori');
    }
}

// PEMINJAMAN
if (isset($_GET['id_peminjaman'])) {
    $id_pinjam = $_GET['id_peminjaman'];
    $sql = "DELETE FROM peminjaman WHERE id_peminjaman='$id_pinjam'";
    $query = mysqli_query($connect,$sql);

    if ($query) {
        header('Location: peminjaman.php');
    }else{
        header('Location: hapus.php?status=gagal');
    }
}

?>

