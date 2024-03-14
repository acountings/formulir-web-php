<?php
session_start();

include 'config/koneksi.php';
include 'layout/header.php';
// CHECK TOMBOL LOGIN
if(isset($_POST['login'])) {
$email = mysqli_real_escape_string($db, $_POST['email']);
$password = mysqli_real_escape_string($db, $_POST['password']);



$result = mysqli_query($db, "SELECT * FROM user WHERE email = '$email'");

if(mysqli_num_rows($result) == 1){

    $hasil = mysqli_fetch_assoc($result);

    if (password_verify($password, $hasil['password'])){

        $_SESSION['login'] = true ;
        $_SESSION['id_user'] = $hasil['id_user'] ;
        $_SESSION['nama_responden']       = $hasil['nama_responden'];
        $_SESSION['level']   = $hasil['level'];
        $_SESSION['institusi']      = $hasil['institusi'];
        $_SESSION['daerah']      = $hasil['daerah'];
        $_SESSION['no_wa']      = $hasil['no_wa'];
        $_SESSION['email']      = $hasil['email'];
        $_SESSION['password']      = $hasil['password'];

        header("location: index.php");
        exit;
    }
  }

  $error = true ;
}
?>



        <div class="global-container">
            <div class="card login-form">
                <div class="card-body">
                    <h1 class="card-title text-center">LOg in</h1>
                </div>
                <?php if (isset($error)) : ?>
                <div class="alert alert-danger text-center">
                    <b>Email/Password salah</b>
                </div>
                <?php endif; ?>
                <div class="card-text">
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control"  aria-describedby="emailHelp" name="email">
                       
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <div class="d-grid gap-2">
                    <button type="submit" name="login" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
       

<?php
include 'layout/footer.php';

?>