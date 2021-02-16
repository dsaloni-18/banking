<?php
    $con = mysqli_connect("localhost", "root", "", "banksystem"); //database connection
?>
<!DOCTYPE html>
<html>
<head>
<title>Account Holder Details</title>
<meta name="viewport" content="width=device-width, height=device-width, initial-scale=1">
<!--CSS-->
<style>
html{
  scroll-behavior: smooth;
}
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
h4
{
    text-align:center;
	font-family: emoji;
	margin:1% 1%;
	font-size: 30px;
	letter-spacing: 1px;
	font-variant: small-caps;
	font-style: oblique;
	color:navy;
}
table
{
	border:2px solid green;
	position:fixed;
	margin:10px 150px;
	text-align:center;
	font-size:19px;
	font-weight:bold;
	color:indigo;
	}
tr th
{
	 color:maroon;
}
tr:nth-child(even){
	background-color:pink;
	}
tr{
	background-color:violet;
	}
button
{
	width:140px;
	height:30px;
	font-size:15px;
	font-weight:bold;
	border-radius:30px;
	background:linear-gradient(-45deg,red,blue);
}
button:hover:not(.active){
	transition-duration:0.4s;
	width:150px;
	height:33px;
	color:white;
	font-size:17px;
	box-shadow:0 10px 10px 0 black,0 10px 20px 0 pink;
}
</style>
</head>
<body>
	<div id="main">
		<!--Navbar-->
	<nav>
		<div class="b">Sparks Bank</div>
			<ul>
				<li><a href="history.php">Transaction History</a></li>
				<li><a href="view customer.php">View Customer</a></li>
				<li><a href="index.html">Home</a></li>
			</ul>
	</nav>	
		<div class="customertable">
			<h4 >Customers Table</h4>
			<center>
				<!--Table-->
				<table id="myTable" border="1">
					<tr style="margin:0;">
						<th>Customer ID</th>
						<th>Account No</th>
						<th>Name</th>
						<th>Email</th>
						<th>Current Balance</th>
						<th style="width:200px">Operation</th>
					</tr>
				<!--Fetch data from database-->
				<?php
					$sql = "SELECT * FROM `view customer`" ;
					$result = mysqli_query($con, $sql);
					while($row = mysqli_fetch_assoc($result))
						{
							echo "<tr>";
							echo "<form method ='post' action = 'customer account.php'>";
							echo "<td>". $row['customer_id'] . "</td>
								<td>". $row['Account_No']. "</td>
								<td>". $row['customer_name'] . "</td>
								<td>". $row['email_id'] . "</td>
								<td>". $row['current_balance'] . "</td>";
							echo "<td> <a href='customer account.php'><button  class='button' name='user' type='submit'  value= '{$row['customer_name']} ' >View Customer</button></a></td>";
							echo "</form>";
							echo  "</tr>";
						}
				?>
				</table>
			</center>
    </div>
</body>
</html>