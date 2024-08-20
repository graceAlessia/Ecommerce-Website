<?php include('header.php') ?>
<?php


include('../server/dbcon.php');

if (isset($_SESSION['admin_logged_in'])) {
    header('location: dashbord.php');
    exit;
}

if (isset($_POST['login_btn'])) {

    //get user info
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    //connect to database
    $stmt = $conn->prepare("SELECT admin_id, admin_name, admin_email, admin_password FROM admins WHERE admin_email = ? AND admin_password = ? LIMIT 1");

    $stmt->bind_param('ss', $email, $password);

    if ($stmt->execute()) {
        $stmt->bind_result($admin_id, $admin_name, $admin_email, $admin_password);
        $stmt->store_result();

        //
        if ($stmt->num_rows() == 1) {
            $stmt->fetch();

            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['admin_name'] = $admin_name;
            $_SESSION['admin_email'] = $admin_email;
            //no need to store user password
            $_SESSION['admin_logged_in'] = true;

            header('location: dashboard.php?login_success=Logged in Successfully!');
        } else {
            header('location: login.php?error=Could not verify your account');
        }
    } else {
        //error
        header('location: login.php?error=Something went wrong');
    }
    //     //
}



?>


<!--Login-->
<section class="my-5 py-5">
    <div class="LoginBody">
        <div class="LoginContainer">
            <form id="login-form" enctype="multipart/form-data" method="POST" action="login.php">
                <h1>Login</h1>
                <p style="color:red;" <?php if (isset($_GET['error'])) {
                                            echo $_GET['error'];
                                        } ?>> </p>
                <div class="input-box">
                    <input type="text" class="form-control" name="email" placeholder="Email" required>
                    <!-- <i class='bx bxs-user'></i> -->
                </div>
                <div class="input-box">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <!-- <i class='bx bxs-lock'></i> -->
                </div>
                <div class="remember">
                    <label><input type="checkbox">Remember me!</label>
                    <a href="#">Forgot password?</a>
                </div>
                <input type="submit" class="btn" name="login_btn" value="Login">
            </form>
        </div>
    </div>
</section>

</body>

</html>