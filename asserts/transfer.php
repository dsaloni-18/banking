<?php
	session_start();
	$con = mysqli_connect("localhost", "root", "", "banksystem");//database connection
	if(!$con)
	{
		die("Connection failed");
	} 
	$flag=false;
	if (isset($_POST['transfer']))
		{
			$sender=$_SESSION['sender'];
			$receiver=$_POST["reciever"];
			$amount=$_POST["amount"];
		}
?>
<!DOCTYPE html>
<html>
<head>
<title>Spark foundation</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<style>
body {
	background-image: url("back1.jpg");
	overflow:hidden;
	background-position:center;
	background-repeat:no-repeat;
	background-size:100% 100%;
	background-image-opacity:0.75;
	background-attachment:fixed;
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
h4
{
    text-align:center;
	font-family: emoji;
	font-size: 50px;
	letter-spacing: 1px;
	font-variant: small-caps;
	font-style: oblique;
	color:navy;
}
button
{
	width:180px;
	height:35px;
	font-size:20px;
	font-weight:bold;
	border-radius:30px;
	background:linear-gradient(-45deg,blue,red);
}
.column
{
	float:left;
	color:white;
	margin-top:60px;
}

</style>
</head>
<body>
	<!--navbar-->
<nav>
		<div class="b">Sparks Bank</div>
			<ul>
				<li><a href="history.php">Transaction History</a></li>
				<li><a href="view customer.php">View Customer</a></li>
				<li><a href="index.html">Home</a></li>
			</ul>
	</nav>
	<center>
		<h4 ">TRANSACTION STATUS</h4>
	</center>
	<!--transaction status-->
	<?php
		$sql = "SELECT current_balance FROM `view customer` WHERE customer_name='$sender'";
		
		$result = $con->query($sql);
		if ($result->num_rows > 0) 
			{
				while($row = $result->fetch_assoc())
					{
						if($amount>$row["current_balance"] or $row["current_balance"]-$amount<0)  //check whether transaction amount is valid/available
							{
								echo "<script>swal( 'Error','Insufficient Balance!','error' ).then(function() { window. location = 'view customer.php'; });;</script>";
							}
						else
							{
								$sql = "UPDATE `view customer` SET current_balance=(current_balance-$amount) WHERE customer_name='$sender'";    //substract amount from sender's account
								if ($con->query($sql) === TRUE) 
									{
										$flag=true;
									} 
								else 
									{
										echo "Error updating record: " . $conn->error;
									}
							}
 
					}
			}
		else
			{
				echo "0 results";
			} 
		if($flag==true)
			{
				$sql = "UPDATE `view customer` SET current_balance=(current_balance+$amount) WHERE customer_name='$receiver'";   //add money in reciever account
				if ($con->query($sql) === TRUE)
					{
						$flag=true;  
					} 
				else
					{
						echo "Error updating record: " . $con->error;
					}
			}
		if($flag==true)
			{
				$sql = "INSERT INTO `history`(`Sender`, `Receiver`, `Amount`,`Date & time`) VALUES ('$sender','$receiver','$amount',CURRENT_TIMESTAMP)";     //upload data into history 
				if ($con->query($sql) === TRUE) 	
					{
					}
				else 
					{
						echo "Error updating record: " . $con->error;
					}
			}
		if($flag==true)
			{
				echo "<script>swal('Transfered!', 'Transaction Successfull','success').then(function() { window. location = 'view customer.php'; });;</script>";
			}
		elseif($flag==false)
			{
				echo "<script> $('#text2').show()</script>";
			}
	?>
</body>
</html>
