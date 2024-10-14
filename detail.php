<?php

require 'function.php';
require 'cek.php';

// dapetin id barang yang di passing di halaman sebelumnya 
$idbarang = $_GET['id'];  // get id barang
// get informasi barang berdasarkan database
$get = mysqli_query($conn, "select * from stock where idbarang='$idbarang' ");
$fetch = mysqli_fetch_array($get);
// set variabel
$namabarang = $fetch['namabarang'];
$deskripsi = $fetch['deskripsi'];
$stock = $fetch['stock'];
$image = $fetch['image'];

    if($image==null){
    //cek ada gambar atau tidak
    $image = $fetch['image'];
        //jika tidak ada gambar
        $img = 'gadak fotonya';
    }else {
        //jika ada 
        $img = '<img src="images/'.$image.'" class="zoomable">';
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Stock - Detail Barang</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>

        <style>
/* Gaya untuk gambar zoomable */
.zoomable {
    width: 200px; /* Sesuaikan ukuran lebar */
    height: 200px; /* Sesuaikan ukuran tinggi */
    border-radius: 50%; /* Membuat gambar bulat */
    object-fit: cover; /* Menjaga gambar tetap proporsional */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.6),
                0 6px 6px rgba(0, 0, 0, 0.4); /* Bayangan */
    transition: transform 0.5s ease, box-shadow 0.5s ease; /* Transisi */
    transform: scale(1); /* Transformasi awal */
}

.zoomable:hover {
    transform:  scale(1.3) ; /* Zoom in effect */
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.8),
                0 8px 8px rgba(0, 0, 0, 0.6); /* Bayangan saat hover */
}

/* Global Reset dan Gaya Body */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    display: flex;
    width: 1350px;
    height: 1000px;
    justify-content: center;
    align-items: center;
    height: 190vh;
    background-color: #f9f9f9;
}

/* Navbar */
.navbar {
    display: flex;
    justify-content: space-between; /* Atur elemen di antara dua sisi */
    align-items: center;
    flex-wrap: wrap; /* Memungkinkan elemen untuk membungkus jika tidak cukup ruang */
    padding: 10px; /* Tambahkan padding untuk ruang lebih */
    background-color: #34495e; /* Navy Blue */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.navbar .navbar-brand {
    font-size: 1.5rem; /* Ukuran font responsif */
    color: #ecf0f1;
    font-weight: bold;
}

.navbar .nav-link {
    color: #ecf0f1;
    font-weight: 500;
    margin: 0 10px; /* Tambahkan margin untuk pemisahan yang lebih baik */
    transition: color 0.3s ease-in-out;
}

.navbar .nav-link:hover {
    color: #f39c12;
    text-shadow: 0px 0px 10px rgba(243, 156, 18, 0.8); /* Glow Effect */
}

/* Sidebar */
.sb-sidenav {
    background-color: #2c3e50;
    padding: 20px;
}

.sb-sidenav .nav-link {
    color: #ecf0f1;
    padding: 15px;
    border-radius: 12px;
    transition: background 0.3s ease;
}

.sb-sidenav .nav-link:hover {
    background-color: #3498db;
    color: white;
    box-shadow: 0px 0px 10px rgba(52, 152, 219, 0.8); /* Hover Glow */
}

/* Card Header */
h2 {
    text-align: center; /* Align text to the left */
    margin: 0; /* Remove default margin */
    padding: 10px 0; /* Add some padding for spacing */
    font-size: 1.5rem; /* Adjust font size to make it smaller */
    height:75px; /* Remove unnecessary height property */
}

.card-header {
    background: linear-gradient(135deg, #8e44ad, #3498db); 
    color: white;
    padding: 20px;
    font-size: 1.5rem;
    text-align: center;
    border-radius: 10px 10px 0 0;
    position: relative;
    overflow: none;
}

.card-header::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle, rgba(255,255,255,0.2), transparent);
    z-index: 0;
}

.card-header h2 {
    position: relative;
    z-index: 1;
}

/* Card Body */
.card-body {
    background-color: white;
    border-radius: 10px;
    padding: 25px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.card-body:hover {
    background-color: #f9f9f9;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
}

/* Row Styles */
.row {
    margin-bottom: 20px;
}

.row .col-md-3 {
    font-weight: bold;
    color: #2980b9;
}

.row .col-md-9 {
    color: #7f8c8d;
    font-style: italic;
}

/* Table Styles */
.table-container {
    margin: 30px 0;
    overflow-x: auto; /* Tambahkan scroll horizontal jika perlu */
}

.table {
    width: 100%;
    border-collapse: collapse;
    background-color: white;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow: hidden;
}

.table thead {
    background-color: #2980b9;
    color: white;
    text-transform: uppercase;
    letter-spacing: 0.05rem;
}

.table th, .table td {
    padding: 15px;
    text-align: left;
}

.table tr {
    transition: background 0.3s ease;
}

.table tr:nth-child(even) {
    background-color: #f1f1f1;
}

.table tr:hover {
    background-color: #3498db;
    color: white;
    cursor: pointer;
}

.table tfoot {
    background-color: #2980b9;
    color: white;
    font-weight: bold;
}

/* Buttons */
.btn-primary {
    background: linear-gradient(135deg, #f39c12, #e74c3c);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.btn-primary:hover {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    transform: translateY(-2px); /* Hover Lift Effect */
}

/* Footer */
footer {
    background-color: #34495e;
    color: white;
    text-align: center;
    padding: 20px;
    font-size: 0.9rem;
}

footer a {
    color: #f39c12;
    text-decoration: none;
    transition: color 0.3s ease;
}

footer a:hover {
    color: #e67e22;
}

/* Media Queries */
@media (max-width: 768px) {
    .navbar {
        flex-direction: column; /* Membuat menu menjadi kolom */
        align-items: flex-start; /* Mengatur menu ke sisi kiri */
    }

    .navbar .nav-link {
        padding: 10px; /* Tambahkan padding untuk setiap link */
        width: 100%; /* Membuat link mengambil lebar penuh */
        text-align: center; /* Mengatur teks di tengah */
    }
}

        </style>

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-darhttp://localhost/stokbarang/index.html#k">
            <a class="navbar-brand" href="index.php">Man's Lab</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                                Stock Barang
                            </a>
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-arrow-down"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-arrow-up"></i></div>
                                Barang Keluar   
                            </a>
                            <a class="nav-link" href="peminjaman.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-hand-holding"></i></div>
                                Peminjaman Barang   
                            </a>
                            <a class="nav-link" href="logout.php">
                              <i class="fas fa-sign-out-alt"></i>
                                logout
                            </a>

                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Fssg0813@gmail.com
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Detail Barang</h1>

                        <div class="card mb-4 md-4">
                            <div class="card-header">
                                <h2><?=$namabarang;?></h2>
                                <?=$img?>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-3">Deskripsi</div>
                                    <div class="col-md-9">: <?=$deskripsi?></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">Stock</div>
                                    <div class="col-md-9">: <?=$stock?></div>
                                </div>

                                <br><br><hr>


                                    <h3>Barang Masuk </h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="barangmasuk" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>tanggal</th>
                                                <th>penerima</th>
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $ambildatamasuk = mysqli_query($conn, "select * from masuk where idbarang='$idbarang'");
                                                $i = 1;

                                                while($fetch=mysqli_fetch_array($ambildatamasuk)){
                                                    $tanggal = $fetch['tanggal'];
                                                    $keterangan = $fetch['keterangan'];
                                                    $quantity = $fetch['qty'];
                                              ?>
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$keterangan;?></td>
                                                <td><?=$quantity;?></td>
                                       
                                        <?php
                                         };
                                            ?>

                                         </tbody>
                                    </table>
                                </div>

                                         <br><br><hr>
                                    <h3>Barang Keluar </h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="barangkeluar" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>tanggal</th>
                                                <th>penerima</th>
                                                <th>quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $ambildatakeluar = mysqli_query($conn, "select * from keluar where idbarang='$idbarang'");
                                                $i = 1;

                                                while($fetch=mysqli_fetch_array($ambildatakeluar)){
                                                    $tanggal = $fetch['tanggal'];
                                                    $penerima = $fetch['penerima'];
                                                    $quantity = $fetch['qty'];
                                              ?>
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$penerima;?></td>
                                                <td><?=$quantity;?></td>
                                       
                                        <?php
                                         };
                                            ?>

                                         </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="hidden- name="idb"  value="<?=$idb;?>"muted">Copyright &copy; Firmansyah 2024</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
        <!-- The Modal -->
      <div class="modal fade" id="myModal">
        <div class="modal-dialog">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Tambah Barang</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
         <form method="post" enctype="multipart/form-data">
        <div class="modal-body">
            <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required>
            <br>
            <input type="text" name="deskripsi" placeholder="Deskripsi Barang" class="form-control" required>
            <br>
            <input type="number" name="stock" class="form-control" placeholder="stock" required>
            <br>
            <input type="file" name="file" class="form-control"> 
            <br>
            <button type="submit" class="btn btn-primary" name="addnewbarang">submit</button> 
        </div>
         </form>    
        </div>
     </div>
    </div>
</html>
