<?php
    require('config/config.php');

    if (!isset($_SESSION["id"])) {?>

<?php
    require('config/db.php');
    include('config/fetch_data.php');
    
    $msg = '';
    $msgClass = '';

    if(filter_has_var(INPUT_POST, 'email') AND filter_has_var(INPUT_POST, 'pass')){

        $email = htmlspecialchars($_POST['email']);
        $pass = htmlspecialchars($_POST['pass']);

        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        if(filter_VAR($email, FILTER_VALIDATE_EMAIL)){
            $query = "SELECT * FROM `admins` WHERE `email`='$email'";
            $result = mysqli_query($conn, $query);
            if ($result) {
                # code...
                if ($result-> num_rows == 0) {
                    # code...
                    $query = "SELECT * FROM `staff` WHERE `email`='$email'";
                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        # code...
                        if ($result-> num_rows == 0) {
                            $query = "SELECT * FROM `students` WHERE `email`='$email'";
                            $result = mysqli_query($conn, $query);

                            if ($result) {
                                # code...
                                if ($result-> num_rows == 0) {
                                    $msg = 'Please enter a valid email.';
                                    $msgClass = 'alert-danger';
                                }else if ($result-> num_rows == 1) {
                                    # code...
                                    $user = mysqli_fetch_array($result);
                
                                    if (is_array($user)) {
                                        # code...
                                        $getPass = encrypt_decrypt($user['Passwords'],'decrypt');
                                        if ($pass === $getPass) {
                                            # code...
                                            $_SESSION['UserType'] = 'student';
                                            $_SESSION['id'] = $user['StudentID'];
                                            $_SESSION['fname'] = $user['FirstName'];	
                                            $_SESSION['lname'] = $user['LastName'];
                                            $_SESSION['email'] = $user['Email'];	
                                            $_SESSION['phone'] = $user['Phone'];
                                            $_SESSION['pass'] = $user['Passwords'];
                                        }
                                        else{
                                            $msg = 'Incorrect password.';
                                            $msgClass = 'alert-danger';
                                        }
                                            
                                    }else{
                                        echo "OK not working";
                                    }
                    
                                    if (isset($_SESSION['id'])) {
                                        header("Location: dashboard.php");
                                        ob_end_flush();
                                        mysqli_close($conn);
                                    }	
                                        
                                }
                            }
                        }else if ($result-> num_rows == 1) {
                            # code...
                            $user = mysqli_fetch_array($result);
        
                            if (is_array($user)) {
                                # code...
                                $getPass = encrypt_decrypt($user['Passwords'],'decrypt');
                                if ($pass === $getPass) {
                                    # code...
                                    $_SESSION['UserType'] = 'staff';
                                    $_SESSION['id'] = $user['StaffID'];
                                    $_SESSION['fname'] = $user['FirstName'];	
                                    $_SESSION['lname'] = $user['LastName'];
                                    $_SESSION['email'] = $user['Email'];	
                                    $_SESSION['phone'] = $user['Phone'];
                                    $_SESSION['pass'] = $user['Passwords'];
                                }
                                else{
                                    $msg = 'Incorrect password.';
                                    $msgClass = 'alert-danger';
                                }
                                    
                            }else{
                                echo "OK not working";
                            }
            
                            if (isset($_SESSION['id'])) {
                                header("Location: dashboard.php");
                                ob_end_flush();
                                mysqli_close($conn);
                            }	
                                
                        }
                    }
                    
                }else if ($result-> num_rows == 1) {
                    # code...
                    $user = mysqli_fetch_array($result);

                    if (is_array($user)) {
                        # code...
                        $getPass = encrypt_decrypt($user['Passwords'],'decrypt');
                        if ($pass === $getPass) {
                            # code...
                            $_SESSION['UserType'] = 'admin';
                            $_SESSION['id'] = $user['ID'];
                            $_SESSION['fname'] = $user['FirstName'];	
                            $_SESSION['lname'] = $user['LastName'];	
                            $_SESSION['uname'] = $user['UserName'];	
                            $_SESSION['email'] = $user['Email'];	
                            $_SESSION['phone'] = $user['Phone'];
                            $_SESSION['pass'] = $user['Passwords'];

                        }
                        else{
                            $msg = 'Incorrect password.';
                            $msgClass = 'alert-danger';
                        }
                            
                    }else{
                        echo "OK not working";
                    }
    
                    if (isset($_SESSION['id'])) {
                        header("Location: dashboard.php");
                        ob_end_flush();
                        mysqli_close($conn);
                    }	
                        
                }
            }
        }
        else{
            $msg = 'Please enter a valid email.';
            $msgClass = 'alert-danger';

        }
    }

?>

<?php include('inc/headers/accountheader.php');?>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
                <?php if($msg != ''):?>
                    <div class="alert <?php echo $msgClass; ?>">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $msg; ?></div>
                <?php endif?>
				<form class="login100-form validate-form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
					<span class="login100-form-title p-b-33">
						Edukate Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: example@edukate.edu">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="container-login100-form-btn m-t-20">
						<button class="login100-form-btn" type="submit" name="submit">
							Sign in
						</button>
					</div>

					<div class="text-center p-t-45 p-b-4">
						<span class="txt1">
							Forgot
						</span>

						<a href="#" class="txt2 hov1">
							Email / Password?
						</a>
					</div>

					<div class="text-center">
						<span class="txt1">
							Create an account?
						</span>

						<a href="#" class="txt2 hov1">
							Sign up
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
<?php include('inc/foots/accountFoot.php');?>
<?php }else header("Location: javascript://history.go(-1)");?>