<?php
session_start();
require("../f-pages/security/security-2/database/db.php");

if(isset($_SESSION['user'])) {
	header("location:../home/");
}

$error = "";
if(count($_POST) > 0) {
	$username = mysqli_real_escape_string($con, $_POST['username']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$sql = "SELECT * FROM user_info WHERE username='" . $username . "' AND password='" . $password . "'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	if(is_array($row)) {
		$_SESSION['user'] = $row['id'];
		$_SESSION['username'] = $row['username'];
		header("location:../home/");
		exit;
	} else {
		$error = "Invalid username or password.";
	}
}
?>
<html>
<head>
<title>MJ CONNECT - LOGIN</title>
<style>
body {
	background-image : url("../sources/img/background.jpg");
	background-size : cover;
	background-position : center;
	background-attachment : fixed;
	font-family : Garamond, serif;
}
.center-box {
	width : 400px;
	margin : 10% auto;
	background-color : rgba(255,255,255,0.9);
	border-radius : 20px;
	box-shadow : 2px 2px 10px grey;
	padding : 30px;
	text-align : center;
}
h1 {
	color : black;
	font-size : 28px;
}
input[type=text], input[type=password] {
	width : 90%;
	height : 40px;
	margin : 10px 0;
	border-radius : 15px;
	border : 1px solid #e6e6e6;
	padding-left : 15px;
	font-size : 15px;
}
input[type=submit] {
	width : 60%;
	height : 45px;
	margin : 15px 0;
	background-color : white;
	border : 1px solid #e6e6e6;
	border-radius : 15px;
	font-size : 18px;
	font-family : Garamond, serif;
	transition : 0.2s;
}
input[type=submit]:hover {
	background-color : #e6e6e6;
}
.error {
	color : red;
}
a {
	color : grey;
}
</style>
</head>
<body>
<div class="center-box">
<h1>MJ CONNECT - PLATFORM</h1>
<p>Login to your account</p>
<?php if($error != "") { echo "<p class='error'>" . $error . "</p>"; } ?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<input type="text" name="username" placeholder="Username" required><br>
<input type="password" name="password" placeholder="Password" required><br>
<input type="submit" value="LOGIN">
</form>
</div>
</body>
</html>
