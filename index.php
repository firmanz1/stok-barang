<?php

require 'function.php';
require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Stock - Daftar Barang</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>

        <style>
          .zoomable{
                width: 100px;
                            /* Sesuaikan ukuran lebar */
                            height: 100px; /* Sesuaikan ukuran tinggi */
                            border-radius: 50%; /* Membuat gambar bulat */
                            object-fit: cover; /* Menjaga gambar tetap proporsional */
                            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.6),  /* Bayangan hitam lembut */
                                        0 6px 6px rgba(0, 0, 0, 0.4);   /* Efek hitam tambahan untuk kedalaman */
                            transition: box-shadow 0.3s ease; /* Animasi transisi */
            }
            .zoomable:hover{
                    transform: scale(2);
                    transition: 1s ease;
                    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.8),  /* Bayangan hitam lebih dalam saat dihover */
                0 8px 8px rgba(0, 0, 0, 0.6); 

            }
            .btn-custom {
    background-color: #f39c12; /* Ganti dengan warna latar belakang yang diinginkan */
    color: blue; /* Ganti dengan warna teks yang diinginkan */
    border: none; /* Menghapus border jika ada */
}

.btn-custom:hover {
    background-color: #e67e22; /* Ganti dengan warna latar belakang saat hover */
    color: blue; /* Ganti dengan warna teks saat hover */
}

            
            a{
                text-decoration: none;
                color: black;
            }
            /* Body Styling */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f4f7f6;
    color: #333;
    margin: 0;
    padding: 0;
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
    margin-bottom: 500px; /* Hanya tambahkan margin ke bawah antar elemen navigasi */
    transition: color 0.3s ease-in-out;
}


.navbar .nav-link:hover {
    color: #f39c12;
    text-shadow: 0px 0px 10px rgba(243, 156, 18, 0.8); /* Glow Effect */
}

/* Sidebar Styling */
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
    margin-bottom: 8px;
}

/* Menambahkan jarak antara Man's Lab dan Stock Barang */
.sb-sidenav .nav-link:first-child {
    margin-top: 8px; /* Menambahkan jarak 50px di atas Stock Barang */
}

.sb-sidenav .nav-link:hover {
    background-color: #3498db;
    color: white;
    box-shadow: 0px 0px 10px rgba(52, 152, 219, 0.8); /* Hover Glow */
}

.sb-sidenav .nav-link-icon {
    margin-right: 0.5rem;
}

.sb-sidenav-footer {
    background-color: #2c3e50;
    color: #bdc3c7;
}

/* Main Content */
h1 {
    color: #2c3e50;
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
}

/* Card Styles */
.card {
    border: none;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.05);
    border-radius: 10px;
}

.card-header {
    background-color: #2980b9;
    color: white;
    font-size: 1.25rem;
    font-weight: 500;
    padding: 1rem;
}

.card-body {
    padding: 2rem;
    background-color: white;
    border-radius: 10px;
}

/* Button Styles */
.btn-info {
    background-color: #023047;
    border: none;
    transition: background-color 0.3s ease;
}
.btn-primary {
    background-color: #023047;
    border: none;
    transition: background-color 0.3s ease;
}
.btn-primary:hover, .btn-info:hover {
    background-color: #3498db;
}

.btn-danger {
    background-color: #e74c3c;
    border: none;
    transition: background-color 0.3s ease;
}

.btn-danger:hover {
    background-color: #c0392b;
}

.btn-warning {
    background-color: #f39c12;
    border: none;
    transition: background-color 0.3s ease;
}

.btn-warning:hover {
    background-color: #e67e22;
}

/* Table Styling */
.table {
    background-color: white;
    border-collapse: separate;
    border-spacing: 0 0.5rem;
}

.table thead th {
    background-color: #34495e;
    color: white;
    font-weight: 600;
    padding: 1rem;
    border: none;
}

.table tbody tr {
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.05);
    border-radius: 10px;
    transition: box-shadow 0.3s ease;
}

.table tbody tr:hover {
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
}

.table tbody td {
    padding: 1rem;
    vertical-align: middle;
}

.table tbody td img {
    border-radius: 10px;
    transition: transform 0.3s ease;
}

.table tbody td img:hover {
    transform: scale(1.2);
}

/* Modal Styles */
.modal-header {
    background-color: #2980b9;
    color: white;
    border-bottom: none;
}

.modal-body {
    padding: 2rem;
}

.modal-content {
    border-radius: 10px;
}

.close {
    color: white;
}

/* Footer Styling */
footer {
    background-color: #ecf0f1;
    padding: 1.5rem;
}

footer a {
    color: #2980b9;
    text-decoration: none;
}

footer a:hover {
    text-decoration: underline;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .navbar-brand {
        font-size: 1.2rem;
    }

    h1 {
        font-size: 1.5rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .table tbody td {
        padding: 0.75rem;
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
                        <h1 class="mt-4">Stock Barang</h1>

                        <div class="card mb-4">
                            <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                               Tambah Barang Baru
                             </button>
                             <a href="export.php" class="btn btn-info">Export Tabel</a>
                            </div>
                            <div class="card-body">

                            <?php
                                $ambildatastock = mysqli_query($conn, "select * from stock where stock < 1");

                                while($fetch=mysqli_fetch_array($ambildatastock)){
                                    $barang =$fetch['namabarang'];
                                
                            ?>

                            <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Perhatian!</strong> Stock <?=$barang;?> Telah Habis
                                </div>
                                
                                <?php
                                         }
                                ?>

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Gambar</th>
                                                <th>Nama Barang</th>
                                                <th>Deskripsi</th>
                                                <th>Stock</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM stock");
                                                $i = 1;
                                                while($data = mysqli_fetch_array($ambilsemuadatastock)){
                                                    $namabarang = $data['namabarang'];
                                                    $deskripsi = $data ['deskripsi'];
                                                    $stock = $data ['stock'];
                                                    $idb = $data ['idbarang'];


                                                    //cek ada gambar atau tidak
                                                    $gambar = $data['image'];
                                                    if($gambar==null){
                                                        //jika tidak ada gambar
                                                        $img = 'gadak fotonya';
                                                    }else {
                                                        //jika ada 
                                                        $img = '<img src="images/'.$gambar.'" class="zoomable">';
                                                    }
                                              ?>
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$img;?></td>
                                                <td><strong><a href="detail.php?id=<?=$idb;?>"><?=$namabarang;?></a></strong></td>
                                                <td><?=$deskripsi;?></td>
                                                <td><?=$stock;?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idb;?>">
                                                     Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idb;?>">
                                                    Delete 
                                                    </button>
                                                </td>
                                            </tr>
                                                <!--edit modal-->
                                            <div class="modal fade" id="edit<?=$idb;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">  
                                                    <h4 class="modal-title">Edit Barang</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <form method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <input type="text" name="namabarang" value="<?=$namabarang;?>" class="form-control" required>
                                                    <br>
                                                    <input type="text" name="deskripsi" value="<?=$deskripsi;?>" class="form-control" required>
                                                    <br>
                                                    <input type="file" name="file" class="form-control"> 
                                                    <br>
                                                    <input type="hidden" name="idb" value="<?=$idb;?>">
                                                    <button type="submit" class="btn btn-primary" name="updatebarang">Selesaikan tross</button> 
                                                </div>
                                                </form>    

                                                </div>
                                                </div>
                                            </div>

                                             <!--delete modal-->
                                             <div class="modal fade" id="delete<?=$idb;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">  
                                                    <h4 class="modal-title">Hapus Barang?</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <form method="post">
                                                <div class="modal-body">
                                                    Apakah bro yakin ingin menghapus <?=$namabarang;?>
                                                    <input type="hidden" name="idb" value="<?=$idb;?>">
                                                    <br>
                                                    <br>
                                                    <button type="submit" class="btn btn-danger" name="hapusbarang">yakin lah masa engga</button> 
                                                </div>
                                                </form>    

                                                </div>
                                                </div>
                                            </div>
                                            
                                            </div>

                                       
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
