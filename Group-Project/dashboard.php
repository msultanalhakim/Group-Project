<?php 
session_start();
include('connection.php');

 if($_SESSION['level'] == ""){
     header('Location:login.php?message=session');
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
        </style>
    </head>
    <body>
        <div class="sidebar">
            <div class="sidebar-content">
                <a href="index.php"><h2>Gamadhikari</h2></a>
                <ul>
                    <a onclick="userProfile();" id="sidebarProfile" class="active"><li><i class="fa-solid fa-user"></i> Profil</li></a>
                    <a onclick="changePassword();" id="sidebarPassword"><li><i class="fa-solid fa-lock"></i> Ubah Kata Sandi</li></a>
                    <?php if($_SESSION['level'] == "Administrator" || $_SESSION['level'] == "Staff"){?>
                    <a onclick="insertArticle();" id="sidebarInsert"><li><i class="fa-solid fa-newspaper"></i> Tambah Artikel</li></a>
                    <a onclick="listArticle();" id="sidebarArticle"><li><i class="fa-solid fa-newspaper"></i> List Artikel</li></a>
                    <?php } 
                    
                    if($_SESSION['level'] == "Member"){
                        $username = $_SESSION['username'];
                        $sql = "SELECT * FROM tbl_peserta JOIN tbl_user ON tbl_peserta.username = tbl_user.username WHERE tbl_user.username = '$username'";
                        $query = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($query) > 0){
                        }else{ 
                            echo "<a onclick='insertCommitte();' id='sidebarInsertCommitte'><li><i class='fa-solid fa-user'></i> Daftar Kepanitiaan</li></a>";
                         }
                    } else{ ?>
                    <a onclick="insertCommitte();" id="sidebarInsertCommitte"><li><i class="fa-solid fa-user"></i> Daftar Kepanitiaan</li></a>
                    <?php } 

                    if($_SESSION['level'] == "Administrator" || $_SESSION['level'] == "Staff"){?>
                    <a onclick="listCommittes();" id="sidebarCommittes"><li><i class="fa-solid fa-users"></i> Daftar Panitia</li></a>
                    <?php }
                    
                    if($_SESSION['level'] == "Administrator"){?>
                    <a onclick="listUsers();" id="sidebarUsers"><li><i class="fa-solid fa-users"></i> Daftar User</li></a>
                    <a onclick="listProgram();" id="sidebarProgram"><li><i class="fa-solid fa-list-check"></i> Daftar Proker</li></a>
                    <a onclick="listDivision();" id="sidebarDivision"><li><i class="fa-solid fa-list-check"></i> Daftar Divisi</li></a>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <nav>
            <ul></ul>
            <ul>
                <a href="#hero-section"><li>Beranda</li></a>
                <a href="#program-section"><li>Program Kerja</li></a>
                <a href="#article-section"><li>Artikel</li></a>
                <a href="#"><li>Kepanitiaan</li></a>
                <?php if(isset($_SESSION['username'])){
                    echo "<a href='logout.php' class='btn-logout'><li>Logout</li></a>";
                }else{
                    echo "<a href='login.php' class='btn-login'><li>Masuk</li></a>";
                }?>
            </ul>
        </nav>
        <div class="dashboard-section">
            <div class="dashboard-content" id="user-profile">
                <h2>Profil User</h2>
                <div class="dashboard-input">
                    <form name="user-profile" action="process.php" method="POST">
                        <label>Nama Lengkap</label>
                        <input type="text" name="fullname" placeholder="Harap masukan nama lengkap .." value="<?php echo $_SESSION['fullname'];?>" required>
                        <label>Username</label>
                        <input type="text" name="username" placeholder="Harap masukan username .." value="<?php echo $_SESSION['username'];?>" required>
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Harap masukan email .." value="<?php echo $_SESSION['email'];?>" required>
                        <input type="submit" value="Ubah" name="update-profile">
                    </form>
                </div>
            </div>
            <div class="dashboard-content" id="change-password" style="display:none">
                <h2>Ubah Kata Sandi</h2>
                <div class="dashboard-input">
                    <form name="change-password" action="process.php" method="POST">
                        <label>Username</label>
                        <input type="text" name="fullname" value="<?php echo $_SESSION['username'];?>" disabled required>
                        <label>Kata Sandi Lama</label>
                        <input type="password" name="password" placeholder="Harap masukan kata sandi lama .." required>
                        <label>Konfirmasi Kata Sandi</label>
                        <input type="password" name="confirm-password" placeholder="Harap masukan konfirmasi kata sandi .." required>
                        <label>Kata Sandi Baru</label>
                        <input type="password" name="new-password" placeholder="Harap masukan kata sandi baru .." required>
                        <input type="submit" name="change-password" value="Ubah">
                    </form>
                </div>
            </div>
            <div class="dashboard-content" id="insert-article" style="display:none">
                <?php if($_SESSION['level'] == "Administrator" || $_SESSION['level'] == "Staff"){?>
                <h2>Tambah Artikel</h2>
                <div class="dashboard-input">
                    <form name="change-password" action="process.php" method="POST" enctype="multipart/form-data">
                        <label>Judul Artikel</label>
                        <input type="text" name="article-title" placeholder="Harap masukan judul artikel .." required>
                        <label>Konten Artikel</label>
                        <textarea name="article-content" placeholder="Harap masukan konten artikel .." required></textarea>
                        <label>Gambar Artikel</label>
                        <input type="file" name="article-image" accept="image/png, image/jpg, image/jpeg" required>
                        <input type="submit" name="insert-article" value="Tambah">
                    </form>
                </div>
                <?php } ?>
            </div>
            <div class="dashboard-content" id="update-article" style="display:none">
                <?php if($_SESSION['level'] == "Administrator" || $_SESSION['level'] == "Staff"){?>
                <h2>Perbaharui Artikel</h2>
                <div class="dashboard-input">
                    <table border="1">
                        <tr>
                            <th class="id">ID Artikel</th>
                            <th class="title">Judul Artikel</th>
                            <th class="content">Konten Artikel</th>
                            <th class="tools">Alat</th>
                        </tr>
                        <?php 
                            
                            $viewSql = "SELECT * FROM tbl_konten WHERE 1";
                            $viewQuery = mysqli_query($conn, $viewSql);
                            while($data = mysqli_fetch_array($viewQuery)){
                            ?>
                        <tr>
                            <td class="id"><?php echo $data['id_konten'];?></td>
                            <td class="title"><?php echo mb_strimwidth($data['judul_konten'], 0, 300, " ...")?></td>
                            <td class="content"><?php echo mb_strimwidth($data['isi_konten'], 0, 300, " ...")?></td>
                            <td class="tools">
                                <a href="update.php?update-article=<?php echo $data['id_konten'];?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="process.php?del-article=<?php echo $data['id_konten'];?>" onclick="return confirm('Apakah anda yakin ingin menghapus?');" class="delete"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
                <?php } ?>
            </div>
            <div class="dashboard-content" id="insert-committe" style="display:none">
                <h2>Daftar Kepanitiaan</h2>
                <span>Diharapkan untuk memasukan data secara seksama dan teliti!</span>
                <div class="dashboard-input">
                    <form name="change-password" action="process.php" method="POST" enctype="multipart/form-data">
                        <label>Nama</label>
                        <input type="text" name="name-committe" placeholder="Nama" value="<?php echo $_SESSION['fullname'] ?>" disabled required>
                        <label>Email</label>
                        <input type="text" name="email-committe" placeholder="Email" value="<?php echo $_SESSION['email'] ?>" disabled required>
                        <label>Nomor Telepon</label>
                        <input type="text" name="number-committe" placeholder="Nomor telepon" required>
                        <label>NIM</label>
                        <input type="text" name="nim-committe" placeholder="NIM" style="text-transform: uppercase;" required>
                        <label>Program Kerja</label>
                        <select name="committe-program" required>
                            <option value="">- Program Kerja -</option>
                            <?php 
                            $sql = "SELECT * FROM tbl_proker WHERE 1";
                            $query = mysqli_query($conn, $sql);
                            while ($data = mysqli_fetch_array($query)){
                            ?>
                            <option value="<?php echo $data['id_proker'];?>"><?php echo $data['nama_proker'];?></option>
                            <?php } ?>
                        </select>
                        <label>Divisi</label>
                        <select name="committe-division" required>
                            <option value="">- Divisi Kepanitiaan -</option>
                            <?php 
                            $sql = "SELECT * FROM tbl_divisi WHERE 1";
                            $query = mysqli_query($conn, $sql);
                            while ($data = mysqli_fetch_array($query)){
                            ?>
                            <option value="<?php echo $data['id_divisi'];?>"><?php echo $data['nama_divisi'];?></option>
                            <?php } ?>
                        </select>
                        <input type="submit" name="insert-committe" value="Tambah">
                    </form>
                </div>
            </div>
            <div class="dashboard-content" id="list-committes" style="display:none">
                <?php if($_SESSION['level'] == "Administrator" || $_SESSION['level'] == "Staff"){?>
                <h2>Daftar Panitia</h2>
                <div class="dashboard-input">
                    <table border="1">
                        <tr>
                            <th class="nim">NIM</th>
                            <th class="name">Nama</th>
                            <th class="committe">Kepanitiaan</th>
                            <th class="division">Divisi</th>
                            <th class="status">Status</th>
                            <th style="width:350px">Alat</th>
                        </tr>

                            <?php
                            $committeSql = "SELECT * FROM tbl_peserta JOIN tbl_proker ON tbl_peserta.id_proker = tbl_proker.id_proker JOIN tbl_divisi ON tbl_peserta.id_divisi = tbl_divisi.id_divisi ORDER BY tbl_peserta.id ASC";
                            $committeQuery = mysqli_query($conn, $committeSql);
                            while($data  = mysqli_fetch_array($committeQuery)){
                            ?>
                                <tr>
                                    <td><?php echo $data['nim'];?></td>
                                    <td><?php echo $data['nama'];?></td>
                                    <td><?php echo $data['nama_proker'];?></td>
                                    <td><?php echo $data['nama_divisi'];?></td>
                                    <td>
                                        <?php
                                        if(isset($data['status'])){
                                            if($data['status'] == "Pending"){
                                                echo "<span class='btn-pending'>Pending</span>";
                                            }else if($data['status'] == "Rejected"){
                                                echo "<span class='btn-rejected'>Rejected</span>";
                                            }else if($data['status'] == "Accepted"){
                                                echo "<span class='btn-accepted'>Accepted</span>";
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="process.php?pending-committe=<?php echo $data['id'];?>" class="pending"><i class="fa-solid fa-clock"></i></a>
                                        <a href="process.php?deny-committe=<?php echo $data['id'];?>" class="deny"><i class="fa-solid fa-xmark"></i></a>
                                        <a href="process.php?accept-committe=<?php echo $data['id'];?>" class="accept"><i class="fa-solid fa-check"></i></a>
                                        <a href="update.php?update-committe=<?php echo $data['id'];?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="process.php?del-committe=<?php echo $data['id'];?>" onclick="return confirm('Apakah anda yakin ingin menghapus?');" class="delete"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php
                             }
                            ?>
                    </table>
                </div>
                <?php } ?>
            </div>
            <div class="dashboard-content" id="list-users" style="display:none">
                <?php if($_SESSION['level'] == "Administrator"){?>
                <h2>Daftar User</h2>
                <div class="dashboard-input">
                    <table border="1">
                        <tr>
                            <th class="nim">ID</th>
                            <th class="name">Nama</th>
                            <th class="status">Username</th>
                            <th class="committe">Email</th>
                            <th class="status">Level</th>
                            <th class="tools">Alat</th>
                        </tr>
                        <?php
                            $usersSql = "SELECT * FROM tbl_user ORDER BY id ASC";
                            $usersQuery = mysqli_query($conn, $usersSql);
                            while($data = mysqli_fetch_array($usersQuery)){
                        ?>
                        <tr>
                            <td><?php echo $data['id'];?></td>
                            <td><?php echo $data['nama'];?></td>
                            <td><?php echo $data['username'];?></td>
                            <td><?php echo $data['email'];?></td>
                            <td><?php echo $data['level'];?></td>
                            <td>
                                <a href="update.php?update-user=<?php echo $data['id'];?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="process.php?delete-user=<?php echo $data['id'];?>" onclick="return confirm('Apakah anda yakin ingin menghapus?');" class="delete"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
                <?php } ?>
            </div>
            <div class="dashboard-content" id="list-program" style="display:none">
                <?php if($_SESSION['level'] == "Administrator"){?>
                <h2>Daftar Proker</h2>
                <form name="input-program" action="process.php" method="POST">
                    <input type="text" style="border-radius:4px; width:22%;padding:6px" name="program-name" placeholder="Tambahkan proker baru di sini .." required>
                    <input type="submit" name="input-program" value="Tambah">
                </form>
                <div class="dashboard-input">
                    <table border="1">
                        <tr>
                            <th style="width:100px">ID Proker</th>
                            <th style="width:800px">Nama Proker</th>
                            <th class="tools">Alat</th>
                        </tr>
                        <?php
                            $programSql = "SELECT * FROM tbl_proker";
                            $programQuery = mysqli_query($conn, $programSql);
                            while($data = mysqli_fetch_array($programQuery)){
                        ?>
                        <tr>
                            <td><?php echo $data['id_proker'];?></td>
                            <td><?php echo $data['nama_proker'];?></td>
                            <td>
                                <a href="update.php?update-program=<?php echo $data['id_proker'];?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="process.php?delete-program=<?php echo $data['id_proker'];?>" onclick="return confirm('Apakah anda yakin ingin menghapus?');" class="delete"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </table> 
                </div>
                <?php } ?>
            </div>
            <div class="dashboard-content" id="list-division" style="display:none">
                <?php if($_SESSION['level'] == "Administrator"){?>
                <h2>Daftar Divisi</h2>
                <form name="input-program" action="process.php" method="POST">
                    <input type="text" style="border-radius:4px; width:22%;padding:6px" name="division-name" placeholder="Tambahkan divisi baru di sini .." required>
                    <input type="submit" name="input-division" value="Tambah">
                </form>
                <div class="dashboard-input">
                    <table border="1">
                        <tr>
                            <th style="width:100px">ID Divisi</th>
                            <th style="width:800px">Nama Divisi</th>
                            <th class="tools">Alat</th>
                        </tr>
                        <?php
                            $divisionSql = "SELECT * FROM tbl_divisi";
                            $divisionQuery = mysqli_query($conn, $divisionSql);
                            while($data = mysqli_fetch_array($divisionQuery)){
                        ?>
                        <tr>
                            <td><?php echo $data['id_divisi'];?></td>
                            <td><?php echo $data['nama_divisi'];?></td>
                            <td>
                                <a href="update.php?update-division=<?php echo $data['id_divisi'];?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="process.php?delete-division=<?php echo $data['id_divisi'];?>" onclick="return confirm('Apakah anda yakin ingin menghapus?');" class="delete"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
                <?php } ?>
            </div>
        </div>
        <script src="assets/js/script.js"></script>
        <script src="https://kit.fontawesome.com/d9b2e6872d.js" crossorigin="anonymous"></script>
    </body>
</html>