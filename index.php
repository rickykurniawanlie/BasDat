<?php
/*session_start();
    $resp_username="";
    $resp_pass="";
	//jika sudah login direct ke home.php
	if(isset($_SESSION["userlogin"])){
		header("Location: ../index.php");
	}
	
	if(isset($_POST["username"])){
		if(login($_POST["username"], $_POST["password"])){ 	
			$_SESSION["userlogin"] = $_POST["username"];
			header("location:../index.php");
		}else if(!vUser($_POST["username"])){
            $resp_username="Username Anda Salah!";
            $resp_pass="Password Anda Salah!";
		}else{
            $resp_pass="Password Anda Salah!";
		}
	}
	//cek apakah ada username dan password di database yang tepat
	function login($user, $pass){      
        include 'connect.php';
		$sql = "SELECT * FROM user WHERE username='$user' AND password='$pass'";
		$result = mysqli_query($conn, $sql);
		
		if (mysqli_num_rows($result) > 0) {
			mysqli_close($conn);
			return true;
		}
        return false; 	
	}
    //cek apaka ada username yang sama pada database
    function vUser($user){      
        include 'connect.php';
		$sql = "SELECT * FROM user WHERE username='$user'";
		$result = mysqli_query($conn, $sql);
		
		if (mysqli_num_rows($result) > 0) {
			mysqli_close($conn);
			return true;
		}
        return false;  	
	}    
*/
?>


<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
<title>Login Page</title>
    <script src="js/jquery.min.js"></script>
    <script src="js/login.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body background="images/background1.jpg" style="background-repeat: no-repeat;background-size: cover;">
    <div class="container" style="margin-top: 15%;background-color:#ffe6e6; border-radius: 5px;padding: 20px;">
      <h2>Login form</h2>
      <form class="form-horizontal" role="form">
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Username:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="email" placeholder="Enter username">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd" placeholder="Enter password">
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
</div>

</body>
</html>
