<?php
include ("config.php");
session_start();

if(isset($_SESSION["username"])){
	header("Location: {$hostname}/scm/post.php");
}


?>

<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SCM Login</title>
        <link rel="stylesheet" href="css/scm_login_stylesheet.css">
	</head>

    <body>
	<br><br><br><br>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
							
                <div class="row">
                    <div class="login-box">
                        
                        <h3 class="heading"> Supply Chain Management (SCM) Login </h3>
                        <!-- Form Start -->
                        <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="Login" />
                        </form>
                        <!-- /Form  End -->
						<?php
						
						if(isset($_POST['login'])){
							include("config.php");
							
							$username = mysqli_real_escape_string($conn,$_POST['username']);
							$password = md5($_POST['password']);
							
							$sql = "SELECT user_id, username, CompID, CompName, Status FROM userslist WHERE username = '{$username}' AND password = '{$password}'";
							$result = mysqli_query($conn, $sql) or die ("Query Failed");
							
							if(mysqli_num_rows($result) > 0){
								
								while($row = mysqli_fetch_assoc($result)){
									session_start();
									$_SESSION["username"] = $row['username'];
									$_SESSION["user_id"] = $row['user_id'];
									$_SESSION["CompID"] = $row['CompID'];
									$_SESSION["CompName"] = $row['CompName'];
									$_SESSION["Status"] = $row['Status'];
									
									header("Location: {$hostname}/scm/scm_home.php");
								}
								
							}else{
								echo "<div class='alert alert-danger'> Username and Password are not match </div>";
							}
						}
						
						?>
						
                    </div>
                </div>
            </div>
        </div>
		
<?php include ("scm_footer.php"); ?>		
		
    </body>
</html>
