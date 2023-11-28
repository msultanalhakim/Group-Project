<?php 
session_start();
include('connection.php');

if($_SESSION['level'] == ""){
    header('Location:login.php?pesan=akses');
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM tbl_user INNER JOIN tbl_peserta ON tbl_user.username = tbl_peserta.username WHERE tbl_user.username = '$username'";
$query = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Hackathon</title>
        <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="container">
            <div class="sub-container">
                <div class="main-banner">
                    <div class="banner-text">                        
                        <h4><a href="index.php"><i class="fa-solid fa-arrow-left"></i></a> <em>Detail</em> Competition</h4>
                        <?php while($data = mysqli_fetch_array($query)){?>
                        <form name="register-competition" class="register-competition">
                            <label>ID Pendaftaran</label>
                            <input type="text" name="id" value="<?php echo $data['id'] ?>" readonly>
                            <label>Nama</label>
                            <input type="text" name="nama" value="<?php echo $data['nama'] ?>" readonly>
                            <label>NIM</label>
                            <input type="text" name="nim" value="<?php echo $data['nim'] ?>" readonly>
                            <label>Email</label>
                            <input type="text" name="email" value="<?php echo $data['email'] ?>" readonly>
                            <label>Nomor Telepon</label>
                            <input type="text" name="no_telp" value="<?php echo $data['no_telp'] ?>" readonly>
                            <label>Lomba</label>
                            <input type="text" name="lomba" value="<?php if($data['lomba'] == "ic"){ echo "Informatics Championship";}else if($data['lomba'] == "stec"){ echo "Soedirman Technophoria";}else if($data['lomba'] == "lustrum"){ echo "Lustrum 5.0";} ?>" readonly>
                        </form>
                        <?php } ?>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://kit.fontawesome.com/d9b2e6872d.js" crossorigin="anonymous"></script>
    </body>
</html>