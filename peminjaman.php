<?php

require 'function.php';
require 'cek.php';

//ambil data total
$get1 = mysqli_query($conn,"select * from peminjaman");
$count1 = mysqli_num_rows($get1);  //ngitung  seluruh kolom 

// ngambil data peminjaman yang statusnya dipinjam
$get2 = mysqli_query($conn,"select * from peminjaman where status='Dipinjam'");
$count2 = mysqli_num_rows($get2); //menghitung seluruh kolom dan statusnya

// ambil lagi data peminjaman yang statusnya kembali
$get3 = mysqli_query($conn,"select * from peminjaman where status='Kembali'");
$count3 = mysqli_num_rows($get3); //

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Peminjaman Barang</title>
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
                        <h1 class="mt-4">Peminjaman Barang</h1>

                        <div class="card mb-4">
                            <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                               Tambah Data
                             </button>
                             <div class="row mt-4">
                                <div class="col">
                                    <form method="post" class="form-inline">
                                    <input type="date" name="tgl_mulai" class="form-control">
                                    <input type="date" name="tgl_selesai" class="form-control ml-3">
                                    <button type="submit" name="filter_tgl" class="btn btn-info ml-3">filter</button>
                                    </form>
                                </div>
                             </div>
                             <div class="row mt-4">  
                                <div class="col">
                                    <div class="card bg-info text-white p-3"><h3>Total Data : <?=$count1?> </h3></div>
                                </div>
                                <div class="col">
                                    <div class="card bg-danger text-white p-3"><h3> Total Dipinjam : <?=$count2?> </h3></div>
                                </div> 
                                <div class="col">
                                    <div class="card bg-success text-white p-3"><h3>Total Kembali : <?=$count3?> </h3></div>
                                </div>
                             </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Gambar</th>
                                                <th>Nama Barang</th>
                                                <th>Jumlah</th>
                                                <th>Kepada</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                          if(isset($_POST['filter_tgl'])){
                                            $mulai = $_POST['tgl_mulai'];
                                            $selesai = $_POST['tgl_selesai'];
                                             
                                            if($mulai!=null || $selesai!=null){

                                                $ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM peminjaman p, stock s WHERE s.idbarang = p.idbarang AND tanggal BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY) order by idpeminjaman");
                                            }else{
                                                $ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM peminjaman p, stock s WHERE s.idbarang = p.idbarang order by idpeminjaman");
                                            }
                                        } else {
                                            $ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM peminjaman p, stock s WHERE s.idbarang = p.idbarang order by idpeminjaman");
                                        }
                                                while($data = mysqli_fetch_assoc($ambilsemuadatastock)){
                                                    $idk = $data['idpeminjaman'];
                                                    $idb = $data['idbarang'];
                                                    $tanggal = $data['tanggalpinjam'];
                                                    $namabarang = $data['namabarang'];
                                                    $qty = $data ['qty'];
                                                    $penerima = $data ['peminjam'];
                                                    $status = $data ['status'];

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
                                                <td><?=$tanggal;?></td>
                                                <td><?=$img;?></td>
                                                <td><?=$namabarang;?></td>
                                                <td><?=$qty;?></td>
                                                <td><?=$penerima;?></td>
                                                <td><?=$status;?></td>
                                                <td>

                                                <?php 
                                                  //cek status 
                                                  if($status=='Dipinjam'){
                                                    echo  '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit'.$idk.'">
                                                    selesai
                                                   </button>';
                                                  } else{
                                                     // kalok statusnya sudah kembali(barangnya dah balik)
                                                     echo 'dah balik boss';
                                                  }
                                                ?>
                                                 
                                                </td>   
                                            </tr>
                                               <!--edit modal-->
                                               <div class="modal fade" id="edit<?=$idk;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">  
                                                    <h4 class="modal-title">Selesaikan</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <form method="post">
                                                <div class="modal-body">
                                                    Apakah Barang ini Sudah Selesai dipinjam?
                                                    <br>
                                                    <br>
                                                    <input type="hidden" name="idpinjam" value="<?=$idk;?>">
                                                    <input type="hidden" name="idbarang" value="<?=$idb;?>">
                                                    <button type="submit" class="btn btn-primary" name="barangkembali">Yupp</button> 
                                                </div>
                                                </form>    

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            
                                            </div>
                                        </tbody>
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
                            <div class="text-muted">Copyright &copy; Firmansyah 2024</div>
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
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Tambaha Data Peminjaman</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
         <form method="post">
        <div class="modal-body">
        <select name="barangnya" class="form-control">
                <?php
                 $ambilsemuadatanya = mysqli_query($conn, "select * from stock");
                 while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                    $namabarangnya = $fetcharray ['namabarang'];    
                    $idbarangnya = $fetcharray ['idbarang'];
            ?>

            <option value="<?=$idbarangnya;?>"><?=$namabarangnya;?></option>
                <?php
                 }    
                ?>
            </select>
            <br>
            <input type="number" name="qty" class="form-control" placeholder="Quantity" require>
            <br>
            <input type="text" name="penerima" class="form-control" placeholder="Penerima" require>
            <br>
            <button type="submit" class="btn btn-primary" name="pinjam">submit</button> 
        </div>
         </form>    
        </div>
     </div>
    </div>
</html>
