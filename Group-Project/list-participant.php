<?php 
session_start();
include('connection.php');

if($_SESSION['level'] == ""){
    header('Location:login.php?pesan=akses');
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM tbl_peserta WHERE 1";
$query = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Hackathon</title>
        <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            input[type="submit"]{
                margin: 0;
                text-align: center;
                width: 50px;
            }

            .button-y{
                background-color: #008170 !important;
            }

            .button-n{
                background-color: #cc003d !important;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="sub-container">
                <div class="main-banner">
                    <div class="banner-text">                        
                        <h4><a href="index.php"><i class="fa-solid fa-arrow-left"></i></a> <em>Detail</em> Competition</h4><br>
                        
                        <table class="table-list" border="1">
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Email</th>
                                <th>Nomor Telepon</th>
                                <th>Lomba</th>
                                <th>Status</th>
                                <th>Tools</th>
                            </tr>
                            <?php while($data = mysqli_fetch_array($query)){?>
                            <tr>
                                <td><?php echo $data['id']; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['nim']; ?></td>
                                <td><?php echo $data['email']; ?></td>
                                <td><?php echo $data['no_telp']; ?></td>
                                <td><?php if($data['lomba'] == "ic"){ echo "Informatics Championship";}else if($data['lomba'] == "stec"){ echo "Soedirman Technophoria";}else if($data['lomba'] == "lustrum"){ echo "Lustrum 5.0";} ?></td>
                                <td><?php if($data['status'] == "Pending"){ echo "<span class='button-pending'>Pending</span>";}else if($data['status'] == "Rejected"){ echo "<span class='button-rejected'>Reject</span>";}else if($data['status'] == "Accepted"){ echo "<span class='button-accepted'>Accepted</span>";} ?></td>
                                <td>
                                    <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
                                        <input type="submit" name="accept" value="Y" class="button-y">
                                        <input type="submit" name="reject" value="N" class="button-n">
                                    </form>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                        
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://kit.fontawesome.com/d9b2e6872d.js" crossorigin="anonymous"></script>
    </body>
</html>