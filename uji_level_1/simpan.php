<?php 
include 'connect.php';

// SIMPAN DATA PENGGUNA
if(isset($_POST['simpan_pengguna'])) {
    $no_pgn = $_POST['no_pengguna'];
    $nama = $_POST['nama_pengguna'];
    $kategori = $_POST['kategori'];

    $file = $_FILES['file'];
 
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if (in_array($fileActualExt, $allowed)){
        $fileNewName = $no_pgn.".".$fileActualExt;
        $fileDestination = 'uploads/'.$fileNewName;
        move_uploaded_file($fileTmpName, $fileDestination);
    }


    $sql = "INSERT INTO pengguna (no_pengguna, nama_pengguna, kategori, fileActualExt) VALUES ('$no_pgn','$nama','$kategori','$fileActualExt')";
    $query = mysqli_query($connect, $sql);
    if ($query) {
        header('Location: pengguna.php');
    }else {
        header('Location: simpan.php?status=gagal');
    }
}

// SIMPAN DATA PEGAWAI
if(isset($_POST['simpan_pegawai'])) {
    $no_pgw = $_POST['id_pegawai'];
    $nama_pgw = $_POST['nama_pegawai'];

    $sql = "INSERT INTO pegawai (id_pegawai, nama_pegawai) VALUES ('$no_pgw','$nama_pgw')";
    $query = mysqli_query($connect, $sql);
    if ($query) {
        header('Location: pegawai.php');
    }else {
        header('Location: simpan.php?status=gagal');
    }
}

// SEKALIGUS INVENTORI DAN BARANG
if(isset($_POST['simpan_barang'])) {
    $no_brg = $_POST['id_barang'];
    $nama_brg   = $_POST['nama_barang'];
    $jenis_brg  = $_POST['jenis_barang'];
    $jumlah_brg = $_POST['jumlah_barang'];
    $kondisi    = $_POST['kondisi'];

    $sql =
    "INSERT INTO barang (id_barang, nama_barang, stok, tersedia) VALUES ('$no_brg','$nama_brg','$jumlah_brg','$jumlah_brg');";

    $query = mysqli_query($connect, $sql);
    if ($query) {
        $sql = "INSERT INTO inventori (id_barang, jenis_barang, jumlah_barang, kondisi) VALUES ('$no_brg','$jenis_brg','$jumlah_brg','$kondisi');";

        $query = mysqli_query($connect, $sql);
        if ($query) {
            header('Location: barang.php');
        }else {
            header('Location: simpan.php?status=gagal-pas-diinventori');
        };
    }else {
        header('Location: simpan.php?status=gagal-pas-dibarang');
    }
}

?>



