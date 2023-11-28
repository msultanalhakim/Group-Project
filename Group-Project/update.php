<?php 
session_start();
include('connection.php');

 if($_SESSION['level'] == ""){
     header('Location:login.php?pesan=akses');
 }

$query = "SELECT * FROM tbl_konten ORDER BY id_konten DESC";
$result = mysqli_query($conn, $query);


$del    = $_GET['del'];
if(isset($del)){

        $sql = "SELECT * FROM tbl_konten WHERE id_konten = '$del'";
        $query = mysqli_query($conn, $sql);
    
        $delquery = mysqli_query($conn, "DELETE FROM tbl_konten WHERE id_konten = '$del'");
        if($delquery){
            echo "<script>alert('Konten berhasil dihapus!');</script>";
            header('Location:index.php');
        }
}

$username = $_SESSION['username'];
$check = "SELECT * FROM tbl_user INNER JOIN tbl_peserta ON tbl_user.username = tbl_peserta.username WHERE tbl_user.username = '$username'";
$checkQuery = mysqli_query($conn, $check);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Hackathon</title>
        <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            nav{width: initial;padding: 26px 40px;left: initial;right: 0;}
            body{background-color: rgb(31, 31, 31);}
            select{margin: 4px 0px;}
            .dashboard-section{width: 100%;}
            .dashboard-content{width: 60%;margin: auto;}
            .article-image{border-radius: 14px;height: 200px;width: 200px;padding: 8px 0px;}
        </style>
    </head>
    <body>
        <div class="dashboard-section">
            <div class="dashboard-content" id="update-article">
                <?php if(isset($_GET['update-article'])){ ?>
                    <h2><a href="dashboard.php"><i class="fa-solid fa-arrow-left"></i></a> Perbaharui Artikel</h2>
                <?php }else if(isset($_GET['update-committe'])){ ?>
                    <h2><a href="dashboard.php"><i class="fa-solid fa-arrow-left"></i></a> Perbaharui Data Panitia</h2>
                <?php }else if(isset($_GET['update-user'])){ ?>
                    <h2><a href="dashboard.php"><i class="fa-solid fa-arrow-left"></i></a> Perbaharui Data Pengguna</h2>
                <?php }else if(isset($_GET['update-program'])){ ?>
                    <h2><a href="dashboard.php"><i class="fa-solid fa-arrow-left"></i></a> Perbaharui Data Program Kerja</h2>
                <?php }else if(isset($_GET['update-division'])){?>
                    <h2><a href="dashboard.php"><i class="fa-solid fa-arrow-left"></i></a> Perbaharui Data Divisi</h2>
                <?php } ?>
                <div class="dashboard-input">
                    <?php 
                    if(isset($_GET['update-article'])){
                    $id = $_GET['update-article'];

                    $sql = "SELECT * FROM tbl_konten WHERE id_konten = '$id'";
                    $query = mysqli_query($conn, $sql);

                    while($data = mysqli_fetch_array($query)){
                    ?>
                    <form name="update-article" action="process.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="article-id" value="<?php echo $data['id_konten'];?>">
                        <label>Judul Artikel</label>
                        <input type="text" name="article-title" placeholder="Harap masukan judul konten .." value="<?php echo $data['judul_konten'];?>" required>
                        <label>Konten Artikel</label>
                        <textarea name="article-content" required><?php echo $data['judul_konten'];?></textarea>
                        <label>Gambar Artikel</label>
                        <img src="assets/images/articles/<?php echo $data['gambar'];?>" class="article-image">
                        <input type="file" name="article-image" accept="image/png, image/jpg, image/jpeg">
                        <input type="submit" value="Ubah" name="update-article">
                    </form>
                    <?php } 
                    }else if(isset($_GET['update-committe'])){
                        $id = $_GET['update-committe'];

                        $sql = "SELECT * FROM tbl_peserta JOIN tbl_proker ON tbl_peserta.id_proker = tbl_proker.id_proker JOIN tbl_divisi ON tbl_peserta.id_divisi = tbl_divisi.id_divisi WHERE id = '$id'";
                        $query = mysqli_query($conn, $sql);
                        $data = mysqli_fetch_array($query);
                    ?>
                    <form name="update-committe" action="process.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="committe-id" value="<?php echo $data['id'];?>">
                        <input type="hidden" name="committe-username" value="<?php echo $data['username'];?>">
                        <label>Nama Panitia</label>
                        <input type="text" name="committe-name" placeholder="Nama" value="<?php echo $data['nama'];?>" required>
                        <label>Email Panitia</label>
                        <input type="email" name="committe-email" placeholder="Email" value="<?php echo $data['email'];?>" required>
                        <label>NIM Panitia</label>
                        <input type="text" name="committe-nim" placeholder="NIM" value="<?php echo $data['nim'];?>" style="text-transform:uppercase" required>
                        <label>Nomor Telepon Panitia</label>
                        <input type="text" name="committe-number" placeholder="Nomor Telepon" value="<?php echo $data['no_telp'];?>" required>
                        <label>Program Kerja</label>
                        <select name="committe-program">
                            <option value="<?php echo $data['id_proker'];?>"><?php echo $data['nama_proker'];?></option>
                            <?php 
                            $sql = "SELECT * FROM tbl_proker WHERE 1";
                            $query = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($query)){
                            ?>
                            <option value="<?php echo $row['id_proker'];?>"><?php echo $row['nama_proker'];?></option>
                            <?php } ?>
                        </select>
                        <label>Divisi</label>
                        <select name="committe-division">
                            <option value="<?php echo $data['id_divisi'];?>"><?php echo $data['nama_divisi'];?></option>
                            <?php 
                            $sql = "SELECT * FROM tbl_divisi WHERE 1";
                            $query = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($query)){
                            ?>
                            <option value="<?php echo $row['id_divisi'];?>"><?php echo $row['nama_divisi'];?></option>
                            <?php } ?>
                        </select>
                        <label>Status</label>
                        <select name="committe-status">
                            <option value="<?php echo $data['status'];?>"><?php echo $data['status'];?></option>
                            <option value="Pending">Pending</option>
                            <option value="Accepted">Accepted</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                        <input type="submit" value="Ubah" name="update-committe">
                    </form>
                    <?php
                    }else if(isset($_GET['update-user'])){
                        $id = $_GET['update-user'];

                        $sql = "SELECT * FROM tbl_user WHERE id = '$id'";
                        $query = mysqli_query($conn, $sql);
                        $data = mysqli_fetch_array($query);
                    ?>
                    <form name="update-user" action="process.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="user-id" value="<?php echo $data['id'];?>">
                        <input type="hidden" name="old-username" value="<?php echo $data['username'];?>">
                        <label>Nama Pengguna</label>
                        <input type="text" name="user-name" placeholder="Nama" value="<?php echo $data['nama'];?>" required>
                        <label>Email Pengguna</label>
                        <input type="email" name="user-email" placeholder="Email" value="<?php echo $data['email'];?>" required>
                        <label>Username Pengguna</label>
                        <input type="text" name="user-username" placeholder="Nama" value="<?php echo $data['username'];?>" required>
                        <label>Hak Akses</label>
                        <select name="user-access">
                            <option value="<?php echo $data['level'];?>"><?php echo $data['level'];?></option>
                            <option value="Member">Member</option>
                            <option value="Staff">Staff</option>
                            <option value="Administrator">Administrator</option>
                        </select>
                        <input type="submit" value="Ubah" name="update-user">
                    </form>
                    <?php
                    }else if(isset($_GET['update-program'])){
                        $id = $_GET['update-program'];

                        $sql = "SELECT * FROM tbl_proker WHERE id_proker = '$id'";
                        $query = mysqli_query($conn, $sql);
                        $data = mysqli_fetch_array($query);
                    ?>
                    <form name="update-user" action="process.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="program-id" value="<?php echo $data['id_proker'];?>">
                        <label>Nama Proker</label>
                        <input type="text" name="program-name" placeholder="Nama" value="<?php echo $data['nama_proker'];?>" required>
                        <input type="submit" value="Ubah" name="update-program">
                    </form>
                    <?php
                    }else if(isset($_GET['update-division'])){
                        $id = $_GET['update-division'];

                        $sql = "SELECT * FROM tbl_divisi WHERE id_divisi = '$id'";
                        $query = mysqli_query($conn, $sql);
                        $data = mysqli_fetch_array($query);
                    ?>
                    <form name="update-user" action="process.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="division-id" value="<?php echo $data['id_divisi'];?>">
                        <label>Nama Divisi</label>
                        <input type="text" name="division-name" placeholder="Nama" value="<?php echo $data['nama_divisi'];?>" required>
                        <input type="submit" value="Ubah" name="update-division">
                    </form>
                    <?php }
                    ?>
                </div>
            </div>
        </div>
        <script src="assets/js/script.js"></script>
        <script src="https://kit.fontawesome.com/d9b2e6872d.js" crossorigin="anonymous"></script>
    </body>
</html>