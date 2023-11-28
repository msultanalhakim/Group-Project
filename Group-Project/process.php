<?php
include('connection.php');
session_start();

    if($_SESSION['level'] == ""){
        header('Location:login.php?message=session');
    }

    if(isset($_POST['update-profile'])){
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $old_username = $_SESSION['username'];
        $email = $_POST['email'];

        $sql = "SELECT * FROM tbl_user WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            if($username == $old_username){
                    $sql = "SELECT * FROM tbl_peserta WHERE username = '$old_username'";
                    $query = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($query) > 0){
                        $update = "UPDATE tbl_user SET nama = '$fullname', email = '$email' WHERE username = '$old_username'";
                        $query = mysqli_query($conn, $update);
                        if ($query) {
                            $_SESSION['fullname'] = $fullname;
                            $_SESSION['email'] = $email;
        
                            $sql = "UPDATE tbl_peserta SET nama = '$fullname', email = '$email' WHERE username = '$old_username'";
                            $update = mysqli_query($conn, $sql);
                            if($update){
                                echo "<script>alert('Profil user telah berhasil diubah!');window.location.href = 'dashboard.php'</script>";
                            }else{
                                echo "<script>alert('Error! Tidak dapat mengubah data user');window.location.href = 'dashboard.php'</script>";
                            }
                        } else {
                            echo "<script>alert('Error! Tidak dapat mengubah data user');window.location.href = 'dashboard.php'</script>";
                        }
                    }else{
                        $update = "UPDATE tbl_user SET nama = '$fullname', email = '$email' WHERE username = '$old_username'";
                        $query = mysqli_query($conn, $update);
                        if ($query) {
                            $_SESSION['fullname'] = $fullname;
                            $_SESSION['email'] = $email;
                            echo "<script>alert('Profil user telah berhasil diubah!');window.location.href = 'dashboard.php'</script>";
                        }else {
                            echo "<script>alert('Error! Tidak dapat mengubah data user');window.location.href = 'dashboard.php'</script>";
                        }
                    }
            }else{
                echo "<script>alert('Username yang digunakan tidak tersedia!');window.location.href = 'dashboard.php'</script>";
            }
        } else {
            $sql = "SELECT * FROM tbl_peserta WHERE username = '$old_username'";
            $query = mysqli_query($conn, $sql);
            if(mysqli_num_rows($query) > 0){
                $update = "UPDATE tbl_user SET nama = '$fullname', username = '$username', email = '$email' WHERE username = '$old_username'";
                $query = mysqli_query($conn, $update);

                if ($query) {
                    $_SESSION['fullname'] = $fullname;
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;

                    $sql = "UPDATE tbl_peserta SET nama = '$fullname', email = '$email', username = '$username' WHERE username = '$old_username'";
                    $update = mysqli_query($conn, $sql);
                    if($update){
                        echo "<script>alert('Profil user telah berhasil diubah!');window.location.href = 'dashboard.php'</script>";
                    }else{
                        echo "<script>alert('Error! Tidak dapat mengubah data user');window.location.href = 'dashboard.php'</script>";
                    }
                }else{
                    echo "<script>alert('Error! Tidak dapat mengubah data user');window.location.href = 'dashboard.php'</script>";
                }
            }else{
                $update = "UPDATE tbl_user SET nama = '$fullname', username = '$username', email = '$email' WHERE username = '$old_username'";
                $query = mysqli_query($conn, $update);
                if ($query) {
                    $_SESSION['fullname'] = $fullname;
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
                    
                    echo "<script>alert('Profil user telah berhasil diubah!');window.location.href = 'dashboard.php'</script>";
                } else {
                    echo "<script>alert('Error! Tidak dapat mengubah data user');window.location.href = 'dashboard.php'</script>";
                }
            }
        }
    }

    if(isset($_POST['change-password'])){
        $username = $_SESSION['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];
        $new_password = $_POST['new-password'];
        $passwordError = false;

        $sql = "SELECT * FROM tbl_user WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        
        $row = mysqli_fetch_array($result);
        if(password_verify($password, $row['password'])){
            if ($password == $confirm_password) {
                $password = password_hash($new_password, PASSWORD_DEFAULT);
                $update = "UPDATE tbl_user SET password = '$password' WHERE username = '$username'";
                $query = mysqli_query($conn, $update);
                if ($query) {
                    session_unset();
                    session_destroy();
                    header('Location: login.php?message=registered');
                } else {
                    echo "<script>alert('Password tidak berhasil diubah!');window.location.href = 'dashboard.php'</script>";
                }
            } else {
                echo "<script>alert('Konfirmasi password tidak sesuai!');window.location.href = 'dashboard.php'</script>";
            }
        }else{
            $passwordError = true;
            echo "<script>alert('Harap masukan kata sandi yang sesuai!');window.location.href = 'dashboard.php'</script>";
        }
    }
            
    if(isset($_POST['insert-article'])){
        $article_title  = $_POST['article-title'];
        $article_content = $_POST['article-content'];
        $uploaddir  = 'assets/images/articles/';
        $uploadname = $_FILES['article-image']['name'];
        $uploadtmp = $_FILES['article-image']['tmp_name'];
        $nameuploaded = $_SESSION['username'] . "_" . $uploadname;

        move_uploaded_file($uploadtmp, $uploaddir . $nameuploaded);
        $sql = "INSERT INTO tbl_konten (judul_konten, isi_konten, gambar, tanggal) VALUES ('$article_title', '$article_content', '$nameuploaded', CURRENT_TIMESTAMP())";
        $query = mysqli_query($conn, $sql);
        if($query){
            echo "<script>alert('Data artikel berhasil ditambah!');window.location.href = 'dashboard.php'</script>";
        }
    }

    if(isset($_POST['insert-article'])){
        $article_title  = $_POST['article-title'];
        $article_content = $_POST['article-content'];
        $uploaddir  = 'assets/images/articles/';
        $uploadname = $_FILES['article-image']['name'];
        $uploadtmp = $_FILES['article-image']['tmp_name'];
        $nameuploaded = $_SESSION['username'] . "_" . $uploadname;

        move_uploaded_file($uploadtmp, $uploaddir . $nameuploaded);
        $sql = "INSERT INTO tbl_konten (judul_konten, isi_konten, gambar, tanggal) VALUES ('$article_title', '$article_content', '$nameuploaded', CURRENT_TIMESTAMP())";
        $query = mysqli_query($conn, $sql);
        if($query){
            echo "<script>alert('Data artikel berhasil ditambah!');window.location.href = 'dashboard.php'</script>";
        }
    }

    if(isset($_GET['del-article'])){
        $id = $_GET['del-article'];

        $sql = "DELETE FROM tbl_konten WHERE id_konten = '$id'";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            echo "<script>alert('Data artikel berhasil dihapus!');window.location.href = 'dashboard.php'</script>";
        }else{
            echo "<script>alert('Tidak dapat menghapus data artikel!');window.location.href = 'dashboard.php'</script>";
        }
    }

    if(isset($_POST['insert-committe'])){
        $username = $_SESSION['username'];
        $fullname = $_SESSION['fullname'];
        $email = $_SESSION['email'];
        $number = $_POST['number-committe'];
        $nim = $_POST['nim-committe'];
        $program = $_POST['committe-program'];
        $division = $_POST['committe-division'];

        $sql = "SELECT * FROM tbl_peserta WHERE username = '$username'";
        $query = mysqli_query($conn, $sql);
        if (mysqli_num_rows($query) > 0) {
            echo "<script>alert('Peserta sudah mendaftar!');window.location.href = 'dashboard.php'</script>";
        }else{
            $sql = "INSERT INTO tbl_peserta (nama, nim, email, no_telp, status, username, id_proker, id_divisi) VALUES ('$fullname', '$nim','$email', '$number', 'Pending', '$username', '$program', '$division')";
            $query = mysqli_query($conn, $sql);
            if($query){
                echo "<script>alert('Data peserta berhasil ditambah!');window.location.href = 'dashboard.php'</script>";
            }else{
                echo "<script>alert('Data peserta tidak berhasil ditambah!');window.location.href = 'dashboard.php'</script>";
            }
        }
    }

    if(isset($_GET['deny-committe'])){
        $id = $_GET['deny-committe'];

        $sql = "UPDATE tbl_peserta SET status = 'Rejected' WHERE id = '$id'";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            echo "<script>alert('Status peserta berhasil diubah!');window.location.href = 'dashboard.php'</script>";
        }else{
            echo "<script>alert('Tidak dapat merubah status peserta!');window.location.href = 'dashboard.php'</script>";
        }
    }

    if(isset($_GET['accept-committe'])){
        $id = $_GET['accept-committe'];

        $sql = "UPDATE tbl_peserta SET status = 'Accepted' WHERE id = '$id'";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            echo "<script>alert('Status peserta berhasil diubah!');window.location.href = 'dashboard.php'</script>";
        }else{
            echo "<script>alert('Tidak dapat merubah status peserta!');window.location.href = 'dashboard.php'</script>";
        }
    }

    if(isset($_GET['pending-committe'])){
        $id = $_GET['pending-committe'];

        $sql = "UPDATE tbl_peserta SET status = 'Pending' WHERE id = '$id'";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            echo "<script>alert('Status peserta berhasil diubah!');window.location.href = 'dashboard.php'</script>";
        }else{
            echo "<script>alert('Tidak dapat merubah status peserta!');window.location.href = 'dashboard.php'</script>";
        }
    }

    if(isset($_POST['update-committe'])){
        $id = $_POST['committe-id'];
        $fullname = $_POST['committe-name'];
        $email = $_POST['committe-email'];
        $nim = $_POST['committe-nim'];
        $number = $_POST['committe-number'];
        $program = $_POST['committe-program'];
        $division = $_POST['committe-division'];
        $status = $_POST['committe-status'];
        $username = $_POST['committe-username'];
        $session_username = $_SESSION['username'];

        if($username == $session_username){
            $sql = "UPDATE tbl_peserta SET nama = '$fullname', email = '$email', nim = '$nim', no_telp = '$number', status = '$status',  id_proker = '$program', id_divisi = '$division' WHERE id = '$id'";
            $query = mysqli_query($conn, $sql);
            if ($query) {
                $_SESSION['email'] = $email;
                $_SESSION['fullname'] = $fullname;
                $_SESSION['username'] = $username;

                $sql = "UPDATE tbl_user SET nama = '$fullname', email = '$email' WHERE username = '$username'";
                $query = mysqli_query($conn, $sql);
                if($query){
                    echo "<script>alert('Data peserta berhasil dirubah!');window.location.href = 'dashboard.php'</script>";
                }
            }else{
                echo "<script>alert('Tidak dapat merubah status peserta!');window.location.href = 'dashboard.php'</script>";
            }
        }else{
            $sql = "UPDATE tbl_peserta SET nama = '$fullname', email = '$email', nim = '$nim', no_telp = '$number', status = '$status',  id_proker = '$program', id_divisi = '$division' WHERE id = '$id'";
            $query = mysqli_query($conn, $sql);
            if ($query) {
                echo "<script>alert('Data peserta berhasil diubah!');window.location.href = 'dashboard.php'</script>";
            }else{
                echo "<script>alert('Tidak dapat merubah status peserta!');window.location.href = 'dashboard.php'</script>";
            }
        }
    }

    if(isset($_GET['del-committe'])){
        $id = $_GET['del-committe'];

        $sql = "DELETE FROM tbl_peserta WHERE id = '$id'";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            echo "<script>alert('Data panitia berhasil dihapus!');window.location.href = 'dashboard.php'</script>";
        }else{
            echo "<script>alert('Tidak dapat menghapus data panitia!');window.location.href = 'dashboard.php'</script>";
        }
    }

    if(isset($_POST['update-user'])){
        $id = $_POST['user-id'];
        $fullname = $_POST['user-name'];
        $email = $_POST['user-email'];
        $username = $_POST['user-username'];
        $old_username = $_POST['old-username'];
        $access = $_POST['user-access'];

        $sql = "SELECT * FROM tbl_peserta WHERE username = '$old_username'";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            if($username == $old_username){
                $sql = "UPDATE tbl_user SET nama = '$fullname', email = '$email', level = '$access' WHERE id = '$id'";
                $update = mysqli_query($conn, $sql);
                if($update){
                    $sql = "UPDATE tbl_peserta SET nama = '$fullname', email ='$email' WHERE username = '$old_username'";
                    $query = mysqli_query($conn, $sql);
                    if($query){
                        if($_SESSION['username'] == $old_username){
                            $_SESSION['username'] = $username;
                            $_SESSION['fullname'] = $fullname;
                            $_SESSION['email'] = $email;

                            echo "<script>alert('Data sudah berhasil diubah!');window.location.href = 'dashboard.php'</script>";
                        }else{
                            echo "<script>alert('Faklah diubah!');window.location.href = 'dashboard.php'</script>";
                        }
                    }
                }else{
                    echo "<script>alert('Tidak dapat merubah data user!');window.location.href = 'dashboard.php'</script>";
                }
            }else{
                $sql = "SELECT * FROM tbl_user WHERE username = '$username'";
                $query = mysqli_query($conn, $sql);
                if(mysqli_num_rows($query) > 0){
                    echo "<script>alert('Username sudah dipakai!');window.location.href = 'dashboard.php'</script>";
                }else{
                    $sql = "UPDATE tbl_user SET nama = '$fullname', email = '$email', username = '$username', level = '$access' WHERE id = '$id'";
                    $update = mysqli_query($conn, $sql);
                    if($update){
                        $sql = "UPDATE tbl_peserta SET nama = '$fullname', email ='$email', username = '$username' WHERE username = '$old_username'";
                        $query = mysqli_query($conn, $sql);

                        if($_SESSION['username'] == $old_username){
                            $_SESSION['username'] = $username;
                            $_SESSION['fullname'] = $fullname;
                            $_SESSION['email'] = $email;

                            echo "<script>alert('Data sudah berhasil diubah!');window.location.href = 'dashboard.php'</script>";
                        }else{
                            echo "<script>alert('Faklah diubah!');window.location.href = 'dashboard.php'</script>";
                        }
                    }else{
                        echo "<script>alert('Tidak dapat merubah data user!');window.location.href = 'dashboard.php'</script>";
                    }
                }
            }
        }else{
            $sql = "SELECT * FROM tbl_user WHERE username = '$username'";
            $query = mysqli_query($conn, $sql);
            if(mysqli_num_rows($query) > 0){
                if($username == $old_username){
                    $update = "UPDATE tbl_user SET nama = '$fullname', email = '$email' WHERE username = '$old_username'";
                    $query = mysqli_query($conn, $update);
                    if ($query) {
                        if($_SESSION['username'] == $old_username){
                            $_SESSION['username'] = $username;
                            $_SESSION['fullname'] = $fullname;
                            $_SESSION['email'] = $email;

                            echo "<script>alert('Data sudah berhasil diubah!');window.location.href = 'dashboard.php'</script>";
                        }else{
                            echo "<script>alert('Data sudah berhasil diubah!');window.location.href = 'dashboard.php'</script>";
                        }
                    } else {
                        echo "<script>alert('Error! Tidak dapat mengubah data user');window.location.href = 'dashboard.php'</script>";
                    }
                }else{
                    echo "<script>alert('Username yang digunakan tidak tersedia!');window.location.href = 'dashboard.php'</script>";
                }
            }else{
                $sql = "UPDATE tbl_user SET nama = '$fullname', email = '$email', username = '$username', level = '$access' WHERE id = '$id'";
                $update = mysqli_query($conn, $sql);
                if($update){
                    echo "<script>alert('Data user berhasil diubah!');window.location.href = 'dashboard.php'</script>";
                }else{
                    echo "<script>alert('Tidak dapat merubah data user!');window.location.href = 'dashboard.php'</script>";
                }
            }
        }

        $sql = "UPDATE tbl_peserta SET nama = '$fullname', email = '$email', nim = '$nim', no_telp = '$number', status = '$status',  id_proker = '$program', id_divisi = '$division' WHERE id = '$id'";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            echo "<script>alert('Data peserta berhasil diubah!');window.location.href = 'dashboard.php'</script>";
        }else{
            echo "<script>alert('Tidak dapat merubah status peserta!');window.location.href = 'dashboard.php'</script>";
        }
    }

    if(isset($_POST['input-program'])){
        $program = $_POST['program-name'];

        $sql = "INSERT INTO tbl_proker(nama_proker) VALUES ('$program')";
        $query = mysqli_query($conn, $sql);
        if($query){
            echo "<script>alert('Program kerja berhasil ditambah!');window.location.href = 'dashboard.php'</script>";
        }else{
            echo "<script>alert('Gagal menambah program kerja!');window.location.href = 'dashboard.php'</script>";
        }
    }

    if(isset($_GET['delete-program'])){
        $id = $_GET['delete-program'];

        $sql = "DELETE FROM tbl_proker WHERE id_proker = '$id'";
        $query = mysqli_query($conn, $sql);
        if($query){
            echo "<script>alert('Program kerja yang dipilih berhasil dihapus!');window.location.href = 'dashboard.php'</script>";
        }else{
            echo "<script>alert('Gagal menghapus program kerja yang dipilih!');window.location.href = 'dashboard.php'</script>";
        }
    }

    if(isset($_POST['update-program'])){
        $id = $_POST['program-id'];
        $name = $_POST['program-name'];

        $sql = "UPDATE tbl_proker SET nama_proker = '$name' WHERE id_proker = '$id'";
        $query = mysqli_query($conn, $sql);
        if($query){
            echo "<script>alert('Berhasil mengubah data program kerja!');window.location.href = 'dashboard.php'</script>";
        }else{
            echo "<script>alert('Gagal mengubah program kerja yang dipilih!');window.location.href = 'dashboard.php'</script>";
        }
    }

    if(isset($_POST['input-division'])){
        $division = $_POST['division-name'];

        $sql = "INSERT INTO tbl_divisi(nama_divisi) VALUES ('$division')";
        $query = mysqli_query($conn, $sql);
        if($query){
            echo "<script>alert('Divisi baru berhasil ditambah!');window.location.href = 'dashboard.php'</script>";
        }else{
            echo "<script>alert('Gagal menambah divisi baru!');window.location.href = 'dashboard.php'</script>";
        }
    }

    if(isset($_GET['delete-division'])){
        $id = $_GET['delete-division'];

        $sql = "DELETE FROM tbl_divisi WHERE id_divisi = '$id'";
        $query = mysqli_query($conn, $sql);
        if($query){
            echo "<script>alert('Divisi yang dipilih berhasil dihapus!');window.location.href = 'dashboard.php'</script>";
        }else{
            echo "<script>alert('Gagal menghapus divisi yang dipilih!');window.location.href = 'dashboard.php'</script>";
        }
    }

    if(isset($_POST['update-division'])){
        $id = $_POST['division-id'];
        $name = $_POST['division-name'];

        $sql = "UPDATE tbl_divisi SET nama_divisi = '$name' WHERE id_divisi = '$id'";
        $query = mysqli_query($conn, $sql);
        if($query){
            echo "<script>alert('Berhasil mengubah data divisi!');window.location.href = 'dashboard.php'</script>";
        }else{
            echo "<script>alert('Gagal mengubah divisi yang dipilih!');window.location.href = 'dashboard.php'</script>";
        }
    }

    
?>