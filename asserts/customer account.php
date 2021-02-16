<?php
	session_start();  //Start the session
    $con = mysqli_connect("localhost", "root", "", "banksystem"); //database connection establish
	if(!$con)
		{
			die("Connection failed");
		}
	//Set session variable
	$_SESSION['user']=$_POST['user'];
	$_SESSION['sender']=$_SESSION['user'];
	$user=$_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Spark foundation</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--CSS-->
<style>
body {
	background-image: url("back1.jpg");
	overflow:hidden;
	background-position:center;
	background-repeat:no-repeat;
	background-size:100% 100%;
	background-image-opacity:0.75;
    background-attachment: fixed;
}
nav ul li 
{
	float:right;
	list-style-type: none;
	display: inline-block;
	font-size:25px;
	background-color:transparant;
	transition:0.8 s all;
	}
a {
	margin:0;
	display:block;
	color:black;
	text-align:center;
	padding:5px 15px;
	font-family:Brush Script MT;
	font-size:30px; 
	text-decoration:none;
  }
nav ul li a:hover:not(.active)	{
	color:white;
	font-size:33px;
	background-color: purple;
	}
.b {
	padding :5px 25px;
	float :left;
	color:darkgreen;
	font-size:40px;
	font-family:Brush Script MT;
}

p
{
	color:crimson;
	font-weight:bold;
	font-size:23px;
}
h4
{
    text-align:center;
	font-family: emoji;
	font-size: 33px;
	letter-spacing: 1px;
	font-variant: small-caps;
	font-style: oblique;
	color:navy;
}
.column
{
	float:left;
	color:white;
	padding:1% 2%;
	margin-top:60px;
	background-color:pink;
	border:5px solid orange;
	margin-left:0px;
}
b
{
color:indigo;
}
button
{
	width:180px;
	height:35px;
	font-size:20px;
	font-weight:bold;
	color:#000;
	border-radius:30px;
	background:linear-gradient(-45deg,orange,red);
}
button:hover:not(.active){
	transition-duration:0.4s;
	width:200px;
	height:35px;
	color:white;
	font-size:24px;
	box-shadow:0 10px 10px 0 black,0 10px 20px 0 pink;
}
</style>
</head>
<body>
	<!--Navbar-->
<nav>
		<div class="b">Sparks Bank</div>
			<ul>
				<li><a href="history.php">Transaction History</a></li>
				<li><a href="view customer.php">View Customer</a></li>
				<li><a href="index.html">Home</a></li>
			</ul>
	</nav>	
	<!--sender detail-->
	<div class="row">
		<div class="column">
			<h4>CUSTOMER</h4>
			<?php
				if (isset($_SESSION['user']))   //check variable is declare or empty
					{
						//$user=$_SESSION['user'];
						$result=mysqli_query($con,"SELECT * FROM `view customer` WHERE customer_name='$user'");
						
						while($row=mysqli_fetch_array($result))         //fetch user data from database 
							{
								echo "<p><b class='font-weight-bold'>Account No</b> &nbsp;:".$row['Account_No']."</p><br>";
								echo "<p name='sender'><b class='font-weight-bold'>Name&nbsp;&nbsp;</b>&nbsp;&nbsp;: ".$row['customer_name']."</p><br>";
								echo "<p><b class='font-weight-bold'>Email ID</b> : ".$row['email_id']."</p><br>";
								echo "<p><b class='font-weight-bold'>Balance</b>&nbsp; :&nbsp;<b>&#8377;</b> ".$row['current_balance']."</p>";
							}         
					}
			?>
		</div>
		</div>
		<div class="row">
		<!--money Transfer-->
		<div class="column" style="padding:1% 2%; margin:2%; margin-left:150px; border:5px solid orange;background-color:pink">
			<form action="transfer.php" method="POST">
				<h4>MONEY TRANSFER</h4> 
				<!--sender-->
				<b style="font-size:28px; ">Sender:</b>  <span style="font-size:27px;"><input id="myinput" name="sender"  type="text" style="width:120px;border:box;background-color:violet;font-weight:bold" value='<?php echo "$user";?>'></input></span>
				<br><br><br>
				<!--receiver-->
                <b style="font-size:28px;">Reciever:</b>
					<select  name="reciever" id="dropdown"  style="background-color:violet ;font-weight:bold;" required>
						<option value="">Select Reciever</option>
						<?php
							$db = mysqli_connect("localhost", "root", "", "banksystem");
							$res = mysqli_query($db, "SELECT * FROM `view customer` WHERE customer_name!='$user'");
							while($row = mysqli_fetch_array($res))
								{
									echo("<option> "."  ".$row['customer_name']."</option>");
								}
						?>
					</select>
				<br><br><br>
				<!--Amount-->
                    <b style="font-size:28px; ">Amount  &#8377;:</b>
                    <input name="amount" type="number" style="width:50px;height:20px; background-color:violet;font-weight:bold;" min="1"  required>
                    <br><br><br>
                    <a href="transfer.php"><button id="transfer"  name="transfer" class="button" ><b>Transfer</b></button>
            </form>
		</div>
	</div>
</body>
</html>