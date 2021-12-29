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

    <title>Home</title>
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
                        Bukan Dashboard
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
            <!-- Cards -->
            <div class="cards">
                <!-- 1 -->
                <div class="card-single">
                    <div>
                        <?php
                            $sql    = "SELECT SUM(tersedia) FROM barang WHERE tersedia IS NOT NULL";
                            $query  = mysqli_query($connect,$sql);

                            while($jml1 = mysqli_fetch_array($query)){
                                echo "<h1>".$jml1['SUM(tersedia)']."</h1>";
                            }
                        ?>
                    </div>
                    <div>
                        <span class="icon las la-clipboard-list"></span>
                        <div class="txtcard">Tersedia</div>
                    </div>
                </div>

                <!-- 2 -->
                <div class="card-single">
                    <div>
                        <?php
                            // $sql    = "SELECT * FROM card2";
                            $sql    = "SELECT SUM(jumlah_dipinjam) FROM detail_peminjaman WHERE jumlah_dipinjam IS NOT NULL";
                            $query  = mysqli_query($connect,$sql);

                            while($jml2 = mysqli_fetch_array($query)){
                                echo "<h1>".$jml2['SUM(jumlah_dipinjam)']."</h1>";
                            }
                        ?>
                    </div>
                    <div>
                        <span class="icon las la-shopping-bag"></span>
                        <div class="txtcard">Dipinjam</div>
                    </div>
                </div>

                <!-- 3 -->
                <div class="card-single">
                    <div>
                        <?php
                            // $sql    = "SELECT * FROM card3";
                            $sql    = "SELECT COUNT(no_pengguna) FROM pengguna";
                            $query  = mysqli_query($connect,$sql);

                            while($jml3 = mysqli_fetch_array($query)){
                                echo "<h1>".$jml3['COUNT(no_pengguna)']."</h1>";
                            }
                        ?>
                    </div>
                    <div>
                        <span class="icon las la-users"></span>
                        <div class="txtcard">Pengguna</div>
                    </div>
                </div>
            </div>

            <div class="table-grid">

                <div class="pinjams">
                    <div class="card">
                        <div class="card-header">
                            <h3>Terbaru</h3>

                            <a href="peminjaman.php" class="button-main">Lihat <span class="las la-arrow-right"></span></a>
                        </div>

                        <div class="card-body">
                            <table>
                                <thead>
                                    <tr>
                                        <td>Nama Peminjam</td>
                                        <td>Kode Peminjaman</td>
                                        <td>Tanggal</td>
                                        <td>Dikembalikan</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql    = "SELECT nama_pengguna, id_peminjaman, tgl_pinjam, dikembalikan
                                        FROM pengguna, peminjaman
                                        WHERE pengguna.no_pengguna=peminjaman.no_pengguna
                                        ORDER BY tgl_pinjam DESC";
                                        $query  = mysqli_query($connect,$sql);
                                        while($terbaru = mysqli_fetch_array($query)){
                                            echo "<tr>";
                                            // echo "<td>".$terbaru['nama_pengguna']."</td>";
                                            echo "<td class='td-start'>";
                                            echo "<span class='text'>".$terbaru['nama_pengguna']."<span>";
                                            echo "</td>";
                                            echo "<td>".$terbaru['id_peminjaman']."</td>";
                                            echo "<td>".$terbaru['tgl_pinjam']."</td>";
                                            echo "<td class='td-end'>".$terbaru['dikembalikan']."</td>";
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
                            <h3>Pengguna</h3>

                            <a href="pengguna.php" class="button-main">Lihat <span class="las la-arrow-right"></span></a>
                        </div>

                        <div class="card-body scrollpengguna">
                            <?php
                            $sql    = "SELECT * FROM pengguna";
                            $query  = mysqli_query($connect,$sql);

                            while($pgna = mysqli_fetch_array($query)){
                                echo "<div class='pengguna'>";
                                echo "<div class='info'>";
                                echo "<img src='uploads/".$pgna['no_pengguna'].".".$pgna['fileActualExt']."' class='wow'>";
                                echo "<div>";
                                echo "<h4>".$pgna['nama_pengguna']."</h4>";
                                echo "<small>".$pgna['kategori']."</small>";
                                echo "</div>";
                                echo "</div>";
                                echo "<div class='icon'>";
                                echo "<span class='las la-user-circle'></span>";
                                echo "</div>";
                                echo "</div>";
                            }
                            ?>
                        </div>

                    </div>

                </div>

            </div>

        </main>
    </div>
    <script src="nyam.js"></script>
</body>
</html>