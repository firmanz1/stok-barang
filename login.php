<?php

require 'function.php';


//cek logn terdaftar apa kagak

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    
// cocokin sama dtabase ada apa engga tu datanya
    $cekdatabse =mysqli_query($conn, "SELECT * FROM login where email='$email' and password='$password'");

    //hitung jumlahd datanya
    $hitung = mysqli_num_rows($cekdatabse);

    if($hitung>0){
        $_SESSION['log'] = 'True';
        header('location:index.php');
    } else {
        header('location:login.php');
    };
};

if(!isset($_SESSION['log'])){

} else {
    header('location:index.php');   
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
        <title>Login</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <style>
    
    /* Global Styles */
body {
    font-family: 'Arial', sans-serif;
    background-image: url('jjj.jpg'); /* Ganti dengan path gambar Anda */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh; /* Mengatur tinggi layar penuh */
    margin: 0;
    color: #ffffff; /* Warna teks putih */
}

/* Overlay for background image */
.overlay {
    position: absolute; /* Mengatur posisi overlay */
    top: 0; 
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.4); /* Overlay hitam dengan transparansi lebih gelap */
    z-index: 1; /* Pastikan overlay di atas gambar */
}

/* Centering Content */
.content {
    position: relative; /* Mengatur posisi konten */
    z-index: 2; /* Konten berada di atas overlay */
    text-align: center;
    padding-top: 20%; /* Jarak dari atas */
}

/* Header Styles */
h1 {
    color: #6a994e; /* Warna hijau untuk judul */
    text-align: center;
    padding-top: 5%;
}

/* Card Styles */
.card {
    background-color: #292b2c; /* Warna latar belakang kartu */
    border: none; /* Menghilangkan border */
    border-radius: 10px; /* Sudut membulat */
    transition: transform 0.3s; /* Efek transisi saat hover */
}

.card:hover {
    transform: translateY(-5px); /* Efek angkat saat hover */
}

/* Header Styles */
.card-header {
    background-color: #6a994e; /* Warna hijau untuk header */
    border-top-left-radius: 10px; /* Membulatkan sudut */
    border-top-right-radius: 10px; /* Membulatkan sudut */
}

.card-header h3 {
    margin: 0; /* Menghilangkan margin */
}

/* Form Styles */
.form-group label {
    color: #ffffff; /* Warna label putih */
}

.form-control {
    background-color: #2c2f33; /* Warna latar belakang input */
    border: 1px solid #6a994e; /* Warna border hijau */
    color: #ffffff; /* Warna teks putih */
}

.form-control::placeholder {
    color: #b0b3b8; /* Warna placeholder */
}

.form-control:focus {
    background-color: #2c2f33; /* Warna latar belakang saat fokus */
    border-color: #6a994e; /* Warna border saat fokus */
    box-shadow: 0 0 5px rgba(106, 153, 78, 0.5); /* Bayangan saat fokus */
}

/* Button Styles */
.btn-primary {
    background-color: #6a994e; /* Warna latar belakang tombol */
    border: none; /* Menghilangkan border */
    border-radius: 5px; /* Sudut membulat tombol */
    transition: background-color 0.3s, transform 0.3s; /* Efek transisi saat hover */
}

.btn-primary:hover {
    background-color: #5a883e; /* Warna saat hover */
    transform: translateY(-2px); /* Efek angkat saat hover */
}

/* Footer Styles */
footer {
    background-color: #1d1f21; /* Warna footer */
    color: #ffffff; /* Warna teks footer */
}

footer a {
    color: #6a994e; /* Warna tautan footer */
    text-decoration: none; /* Menghilangkan garis bawah */
}

footer a:hover {
    text-decoration: underline; /* Garis bawah saat hover */
}

    </style>
    <body class="bg-primary">
        <div class="overlay">
    <h1 style="color: #6a994e; text-align: center; padding-top: 5%;">Selamat Datang!</h1>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" name="email" id="inputEmailAddress" type="email" placeholder="Enter email address" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" name= "password" id="inputPassword" type="password" placeholder="Enter password" />
                                            </div>                                           
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary" name="login">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Firmansyah sitepu 2024</div>
                            <div>
                                <a href="#">Privacy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        
    </body>
</html>
