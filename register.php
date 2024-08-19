<?php
session_start();

include('server/dbcon.php');


//if user has already registered, then take user to account page.
if (isset($_SESSION['logged_in'])) {
    header('location: account.php');
    exit;
}
//if user has already registered, take user to account page 
if (isset($_POST['register'])) {
    //register the user 
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];


    //if passwords do not match
    if ($password !== $confirmpassword) {
        header('location: register.php?error=passwords do not match');
    }

    //if password is less than 6 char 
    else if (strlen($password) < 6) {
        header('location: register.php?error=password must be at least 6 characters');

        //password must contain at least one letter
    } else if (!preg_match("/[a-z]/i", $_POST["password"])) {
        header('location: register.php?error=Password must contain at least one letter');

        //at least one number 
    } else if (!preg_match("/[0-9]/", $_POST["password"])) {
        header('location: register.php?error=Password must contain at least one number');

        //if there is no error 
    } else {
        //check whether thers is already a user with the same email or not 
        $stmt1 = $conn->prepare("SELECT count(*) FROM users where user_email=?");
        $stmt1->bind_param('s', $email);
        $stmt1->execute();
        $stmt1->bind_result($num_rows);
        $stmt1->store_result();
        $stmt1->fetch();


        //if user registers with an existed email in database
        if ($num_rows != 0) {
            header('location: register.php?error=This email is already registered.');

            //if the email is not already existed 
        } else {
            //register username, email and password into database and create new user 
            $stmt = $conn->prepare("INSERT INTO users(user_name, user_email, user_password)
                                    VALUES (?,?,?)");

            $stmt->bind_param('sss', $name, $email, md5($password)); //md5:pw hash

            //if account was created successfully
            if ($stmt->execute()) {
                $user_id = $stmt->insert_id;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $name;
                $_SESSION['logged_in'] = true;
                header('location: account.php?register_success=You have successfully registered.');

                //account could not be created 
            } else {
                header('location: register.php?error=Could not create account at the moment.');
            }
        }
    }
}
//  else {
// //     header('location: register.php?error=Please fill in the form');
// // }




?>
<?php include('layouts/header.php') ?>

<!--Register-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Register</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
        <form id="register-form" method="POST" action="register.php">
            <p style="color: red;"><?php if (isset($_GET['error'])) {
                                        echo $_GET['error'];
                                    } ?></p>
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" id="register-email" name="email" placeholder="Email"
                    required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="text" class="form-control" id="register-password" name="password"
                    placeholder="Password" required>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="text" class="form-control" id="register-confirmpassword" name="confirmpassword"
                    placeholder="Confirm Password" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" id="register-btn" name="register" value="Sign Up">
            </div>
            <div class="form-group">
                <a id="login-url" class="btn" href="login.php">Do you have an account? Login</a>
            </div>
        </form>
    </div>
</section>


<?php include('layouts/footer.php') ?>