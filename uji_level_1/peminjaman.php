<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Link CSS sendiri -->
    <link rel="stylesheet" href="style.css">

    <!-- Link Icon -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <title>Peminjaman</title>
    
</head>
<body>

    <div class="sidebar">

        <!-- Brand -->
        <div class="sidebar-brand">
            <h2>
                <div class="brand">
                    <i class="lab la-wolf-pack-battalion"></i>
                    <div class="brand-name">Nugas</div>
                </div>
                <i class="las la-bars" id="btn"></i>
            </h2>
        </div>

        <!-- Menu -->

        <ul class="nav_list">
            <li>
                <a href="home.php" class="menu">
                    <i class="las la-home"></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li class="dua">
                <a id="btn1" class="menu">
                    <i class="las la-users"></i>
                    <span class="links_name">Master</span>
                </a>
                <ul>
                    <li>
                        <a href="pegawai.php">
                            <i class="las la-users"></i>
                            Pegawai
                        </a>
                    </li>
                    <li>
                        <a href="pengguna.php">
                            <i class="las la-user"></i>
                            Pengguna
                        </a>
                    </li>
                    <li>
                        <a href="barang.php">
                            <i class="las la-laptop"></i>
                            Barang
                        </a>
                    </li>
                </ul>
                <span class="tooltip">Master</span>
            </li>
            <li class="tiga">
                <a href="inventori.php" class="menu">
                    <i class="las la-box"></i>
                    <span class="links_name">Inventori</span>
                </a>
                <span class="tooltip">Inventori</span>
            </li>
            <li class="empat">
                <a href="peminjaman.php"  class="menu">
                    <i class="las la-receipt"></i>
                    <span class="links_name">Peminjaman</span>
                </a>
                <span class="tooltip">Peminjaman</span>
            </li>
            <li class="bawah">
                <a class="menu" id="btn2">
                    <i class="at">@</i>
                    <span class="links_name">Happy^2</span>
                </a>
                <span class="tooltip">Copyright</span>
            </li>
        </ul>
    </div>

    <div class="main-content">

        <header>
            <div class="header-title">
                <h2>
                    <label for="">
                        Bukan Peminjaman
                    </label>
                </h2>
            </div>
            <div class="user-wrapper">
                <img src="gambar/poto.png" alt="">
                <div>
                    <h4>Admin</h4>
                    <small>Super admin</small>
                </div>
            </div>
        </header>

        <main>
            <!-- Tabel Peminjaman -->
            <div class="table-grid">
                <div class="pinjams">
                    <div class="card">
                        <div class="card-header">
                            <h3>Peminjaman</h3>

                            <!-- <a href="formtambahpeminjaman.php"><button>Tambah</button></a> -->
                            <button id="tambah">Tambah</button>
                        </div>

                        <div class="card-body">
                            <table>
                                <thead>
                                    <tr>
                                        <td>Kode Peminjaman</td>
                                        <td>Nama Peminjam</td>
                                        <td>Tanggal</td>
                                        <td>Pengembalian</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql    = "SELECT nama_pengguna, id_peminjaman, tgl_pinjam,dikembalikan
                                        FROM pengguna, peminjaman
                                        WHERE pengguna.no_pengguna=peminjaman.no_pengguna
                                        ORDER BY tgl_pinjam DESC";
                                        $query  = mysqli_query($connect,$sql);
                                        while($pinjam = mysqli_fetch_array($query)){
                                            echo "<tr>";
                                            echo "<td class='td-start'>".$pinjam['id_peminjaman']."</td>";
                                            echo "<td>".$pinjam['nama_pengguna']."</td>";
                                            echo "<td>".$pinjam['tgl_pinjam']."</td>";
                                            echo "<td>".$pinjam['dikembalikan']."</td>";
                                            echo "<td class='td-end'>";
                                            echo "<a href='formpeminjaman.php?id_peminjaman=".$pinjam['id_peminjaman']."' class='button button-secondary'>Ubah</a> | ";
                                            echo "<a href='hapus.php?id_peminjaman=".$pinjam['id_peminjaman']."' type='button' class='button button-danger'>Hapus</a>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="penggunas">
                    <div class="card">
                        <div class="card-header">
                            <h3>Detail Peminjaman</h3>   
                            <a href="peminjaman.php" class="button-main">-</a>
                        </div>
                        <div class="card-body scrollpengguna">
                            <?php
                            $sql    = "SELECT id_peminjaman, nama_barang, jumlah_dipinjam FROM detail_peminjaman,barang WHERE barang.id_barang=detail_peminjaman.id_barang";
                            $query  = mysqli_query($connect,$sql);

                            while($dp = mysqli_fetch_array($query)){
                                echo "<div class='pengguna'>";
                                echo "<div class='info'>";
                                echo "<div>";
                                echo "<h4>".$dp['id_peminjaman']."</h4>";
                                echo "<small>".$dp['nama_barang']."</small>";
                                echo "</div>";
                                echo "</div>";
                                echo "<div class='icon'>".$dp['jumlah_dipinjam']."</div>";
                                echo "</div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="modalcontainer" class="modalcontainer">
        <div class="modal">
            <form>
                <div class="form_group">
                    <input class="form_field" type="type" name="id_peminjaman" id="id_peminjaman"/>
                    <label class="form_label">Kode Peminjaman</label>
                </div>
                <div class="form_group">
                    <select class="form_field" name="id_barang" id="id_barang">
                        <?php
                            $sql    = "SELECT id_barang, nama_barang FROM barang";
                            $query  = mysqli_query($connect,$sql);

                            while($barang = mysqli_fetch_array($query)){
                                echo "<option value=".$barang['id_barang'].">".$barang['nama_barang']."</option>";
                            }
                        ?>
                    </select>
                    <label class="form_label">Barang</label>
                </div>
                <div class="form_group">
                    <input class="form_field" type="number" name="jumlah_dipinjam" id="jumlah_dipinjam"/>
                    <label class="form_label">Jumlah</label>
                </div>
                <div class="form_group">
                    <input class="form_field" type="text" name="no_pengguna" id="no_pengguna" autocomplete="off"/>
                    <label class="form_label">Kode Pengguna</label>
                </div>
                <input class="form_field" type="hidden" name="tgl_pinjam" id="tgl_pinjam"/>
                <input class="form_field" type="hidden" name="dikembalikan" id="dikembalikan"/>
                <div class="form_group">
                    <center><input type="submit" name="simpanpeminjaman" value="Tap" class="button-main-ilang" id="insert-a" onclick="return clickButton();"/></center>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Resi -->
    <div id="modalresi" class="modalresi">
        <div class="modalresi_konten" id="msg">   

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
        function clickButton() {
            event.preventDefault();
            var id_peminjaman = document.getElementById('id_peminjaman').value;
            var id_barang = document.getElementById('id_barang').value;
            var jumlah_dipinjam = document.getElementById('jumlah_dipinjam').value;
            var no_pengguna = document.getElementById('no_pengguna').value;
            var tgl_pinjam = document.getElementById('tgl_pinjam').value;
            var dikembalikan = document.getElementById('dikembalikan').value;
            var modalcontainer = document.getElementById("modalcontainer");
            var modalresi = document.getElementById("modalresi");
            var insert = document.getElementById("insert-a");
            $.ajax({
                type: "post",
                url: "server_action.php",
                data: {
                    'id_peminjaman': id_peminjaman,
                    'id_barang': id_barang,
                    'jumlah_dipinjam': jumlah_dipinjam,
                    'no_pengguna': no_pengguna,
                    'tgl_pinjam': tgl_pinjam,
                    'dikembalikan': dikembalikan,
                },
                cache: false,
                success: function (html) {
                    $('#msg').html(html);
                    console.log("wayolo")
                    modalcontainer.style.display = "none";
                    modalresi.style.display = "block";
                }
            });
            return false;
        }
    </script>
    <script src="nyam.js"></script>
</body>
</html>