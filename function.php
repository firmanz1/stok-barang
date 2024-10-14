<?php

session_start();
//koneksi ke database
$conn = mysqli_connect("localhost","root","","stockbarang");


// nabah bar baru
if (isset($_POST['addnewbarang'])){
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stock  =$_POST['stock'];

    // soal gambar
    $allowed_extension = array('png','jpg');
    $nama = $_FILES['file']['name']; //inin buat ngambill nama file gambar
    $dot = explode('.',$nama);
    $ekstensi = strtolower(end($dot)); //ngambil ekstensinya
    $ukuran = $_FILES['file']['size']; // ngambil size filenya
    $file_tmp = $_FILES['file']['tmp_name']; //ngambil lokasi filenya

    //penamaan file atau enkripsi
    $image = md5(uniqid($nama,true) . time()).'.'.$ekstensi; // menggabungkan nama file yang dienkripsi dengan ekstensinya


    //proses upload gambar
    if(in_array($ekstensi, $allowed_extension) === true){
        //validasi ukuran filenya
        if($ukuran < 15000000){
            move_uploaded_file($file_tmp, 'images/'.$image);

            
                $addtotable = mysqli_query($conn,"insert into stock (namabarang, deskripsi, stock, image) values('$namabarang', '$deskripsi', '$stock','$image')");
                if($addtotable){
                    header('location:index.php');
                } else {
                    echo 'Gagal';
                    header('location:index.php');

                }

        } else{
            //kalaufilenya lebih dari atu setengah mb
            echo '
            <script>
                 alert("Ukuran terlalu besar");
                 window.location.href="index.php";
            </script>
            ';
        }
    }else {
        //jika gambarnya tidak jpg / png
        echo '
        <script>
             alert("File harus png/jpg");
             window.location.href="index.php";
        </script>
        ';

    }
};

//menambah barang masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST ['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];
     
    $cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang= '$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;

    $addtomasuk =  mysqli_query($conn, "insert into masuk (idbarang, keterangan, qty) values('$barangnya', '$penerima', '$qty')");
    $updatestockmasuk = mysqli_query($conn, "update stock set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
    if($addtomasuk&&$updatestockmasuk){
        header('location:masuk.php');
    } else {
        echo 'Gagal';
        header('location:masuk.php');

    }
}
//menambah barang keluar
if(isset($_POST['addbarangkeluar'])){
    $barangnya = $_POST ['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];
     
    $cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang= '$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock']; 
    $tambahkanstocksekarangdenganquantity = $stocksekarang-$qty;

    $addtokeluar =  mysqli_query($conn, "insert into keluar (idbarang, penerima, qty) values('$barangnya', '$penerima', '$qty')");
    $updatestockmasuk = mysqli_query($conn, "update stock set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
    if($addtokeluar&&$updatestockmasuk){
        header('location:keluar.php');
    } else {
        echo 'Gagal';
        header('location:keluar.php');

    }
}


//update barang
if(isset($_POST['updatebarang'])){
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];

      // soal gambar
      $allowed_extension = array('png','jpg');
      $nama = $_FILES['file']['name']; //inin buat ngambill nama file gambar
      $dot = explode('.',$nama);
      $ekstensi = strtolower(end($dot)); //ngambil ekstensinya
      $ukuran = $_FILES['file']['size']; // ngambil size filenya
      $file_tmp = $_FILES['file']['tmp_name']; //ngambil lokasi filenya
  
      //penamaan file atau enkripsi
      $image = md5(uniqid($nama,true) . time()).'.'.$ekstensi; // menggabungkan nama file yang dienkripsi dengan ekstensinya
  
       if($ukuran==0){
        //jika tidak mau di upload
        
            $update = mysqli_query($conn, "update stock set namabarang='$namabarang', deskripsi='$deskripsi' where idbarang = '$idb'");
            if($update){
                header('location:index.php');
            } else {
                echo 'Gagal';
                header('location:index.php');
            }
       }else {
        // jika mau di upload
        move_uploaded_file($file_tmp, 'images/'.$image);
            $update = mysqli_query($conn, "update stock set namabarang='$namabarang', deskripsi='$deskripsi', image='$image' where idbarang = '$idb'");
            if($update){
                header('location:index.php');
            } else {
                echo 'Gagal';
                header('location:index.php');
            }
       }

}

//menghapus barang   
if(isset($_POST['hapusbarang'])){
    $idb = $_POST['idb']; //id barang

    $gambar = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $get = mysqli_fetch_array($gambar);
    $img = 'images/'.$get['image'];
    unlink($img);

    $hapus = mysqli_query($conn, "delete from stock where idbarang='$idb'");
    if($hapus){
        header('location:index.php');
    } else {
        echo 'Gagal';   
        header('location:index.php');
    }
}

//mengubah data barang masuk
if(isset($_POST['updatebarangmasuk'])){
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $deskripsi = $_POST['keterangan'];
    $qty = $_POST['qty'];

    $lihatstock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    $qtyskrg = mysqli_query($conn, "select * from masuk where idmasuk='$idm'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if ($qty > $qtyskrg) {
        // Jika qty baru lebih besar, kurangi stok
        $selisih = $qty - $qtyskrg;
        $kurangin = $stockskrg + $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn," update masuk set qty='$qty', keterangan='$deskripsi' where idmasuk='$idm'");
                if($kurangistocknya&&$updatenya){
                        header('location:masuk.php');
                    } else {
                        echo 'Gagal';           
                        header('location:masuk.php');
                    }
        } else {
            // Jika qty baru lebih kecil, tambah stok
            $selisih = $qtyskrg - $qty;
            $kurangin = $stockskrg - $selisih;
            $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
            $updatenya = mysqli_query($conn," update masuk set qty='$qty', keterangan='$deskripsi' where idmasuk='$idm'");
                if($kurangistocknya&&$updatenya){
                    header('location:masuk.php');
                } else {
                    echo 'Gagal';   
                    header('location:masuk.php');
                }
            }
    
    }

//menghapus barang masuk
if(isset($_POST['hapusbarangmasuk'])){
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idm = $_POST['idm'];

    $getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stock = $data['stock'];

    $selisih = $stock-$qty;

    $update = mysqli_query($conn, "update stock set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from masuk where idmasuk='$idm'");

    if($update&&$hapusdata){
        header('loation:masuk.php');
    } else{
        header('loation:masuk.php');

    }

}

//mengubah data barnag keluar
if(isset($_POST['updatebarangkeluar'])){
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty']; //qty baru imputan user

    //mengambil stok barang saat ini
    $lihatstock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    //qty barnag keluar saat ini
    $qtyskrg = mysqli_query($conn, "select * from keluar where idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if ($qty > $qtyskrg) {
        // Jika qty baru lebih besar, kurangi stok
        $selisih = $qty - $qtyskrg;
        $kurangin = $stockskrg - $selisih;

        if($selisih <= $stockskrg){
            $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
            $updatenya = mysqli_query($conn," update keluar set qty='$qty', penerima='$penerima' where idkeluar='$idk'");
                    if($kurangistocknya&&$updatenya){
                            header('location:keluar.php');
                        } else {
                            echo 'Gagal';           
                            header('location:keluar.php');
                        }
        }else{
           echo' 
           <script>alert("saldo tidak mencukupi");
            window.location.href="keluar.php";

            </script>
            ';

        }
 
        } else {
            // Jika qty baru lebih kecil, tambah stok
            $selisih = $qtyskrg - $qty;
            $kurangin = $stockskrg + $selisih;
            $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
            $updatenya = mysqli_query($conn," update keluar set qty='$qty', penerima='$penerima' where idkeluar='$idk'");
                if($kurangistocknya&&$updatenya){
                    header('location:keluar.php');
                } else {
                    echo 'Gagal';   
                    header('location:keluar.php');
                }
            }
    
    }

//menghapus barang keluar
if(isset($_POST['hapusbarangkeluar'])){
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idk = $_POST['idk'];

    $getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stock = $data['stock'];

    $selisih = $stock+$qty;

    $update = mysqli_query($conn, "update stock set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from keluar where idkeluar='$idk'");

    if($update&&$hapusdata){
        header('location:keluar.php');
    } else{
        header('location:keluar.php');

    }

}

//meminjam barang
if(isset($_POST['pinjam'])){
    $idbarang = $_POST['barangnya']; //buat ngambil id barang
    $qty = $_POST['qty'];
    $penerima = $_POST['penerima']; // ini buat ngambil data penerima

    //ambil stock sekarang
    $stok_saat_ini = mysqli_query($conn, "select * from stock where idbarang='$idbarang'");
    $stok_nya = mysqli_fetch_array($stok_saat_ini);
    $stok = $stok_nya['stock']; // ini tu value nya

    //urangin stocknya 
    $new_stok = $stok-$qty;

    //querry insert
    $insertpinjam = mysqli_query($conn,"INSERT INTO peminjaman (idbarang,qty,peminjam) values('$idbarang','$qty','$penerima')");

    //ngurangin stock di tabel stock
    $kurangistock = mysqli_query($conn, "update stock set stock='$new_stok' where idbarang='$idbarang'");

    if($insertpinjam&&$kurangistock){
        //kalok berhasil
        echo '
        <script>
             alert("Berhasil");
             window.location.href="peminjaman.php";
        </script>
        ';
    }else{
        //kalo gagal
        echo '
        <script>
             alert("Gagal brokk");
             window.location.href="peminjaman.php";
        </script>
        ';
    }

}

//menyelesaiakan pinjaman
if(isset($_POST['barangkembali'])){
    $idpinjam = $_POST['idpinjam'];
    $idbarang = $_POST['idbarang'];

    //eksekusi
    $update_status = mysqli_query($conn,"update peminjaman set status='Kembali' where idpeminjaman='$idpinjam'");

    //ambil stock sekarang
    $stok_saat_ini = mysqli_query($conn, "select * from stock where idbarang='$idbarang'");
    $stok_nya = mysqli_fetch_array($stok_saat_ini);
    $stok = $stok_nya['stock']; // ini tu value nya
    
    //ambil qty dari si idpinjam 
    $stok_saat_ini1 = mysqli_query($conn,"select * from peminjaman where idpeminjaman='$idpinjam'");
    $stok_nya1 = mysqli_fetch_array($stok_saat_ini1);
    $stok1 = $stok_nya1['qty']; // ini tu value nya

    
    //urangin stocknya 
    $new_stok = $stok1+$stok;
    
    //kembalikan stocknya
    $kembalikan_stock = mysqli_query($conn, "update stock set stock='$new_stok' where idbarang='$idbarang'");

    if($update_status&&$kembalikan_stock){
        //kalok berhasil
        echo '
        <script>
             alert("Barang berhasil dikembalikan dan stok telah diperbarui.");
             window.location.href="peminjaman.php";
        </script>
        ';
    }else{
        //kalo gagal
        echo '
        <script>
             alert("Gagal mengembalikan barang.brokk");
             window.location.href="peminjaman.php";
        </script>
        ';
    }
}
 

?>