<?php
    $con = mysqli_connect("localhost", "root", "", "banksystem");        //database connection
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
transactiontable{
	row-height:60px;
}
table
{
	border:3px solid green;
	position:fixed;
	margin:10px 150px;
	text-align:center;
	font-size:20px;
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
h4
{
    text-align:center;
	margin:2% 2%;
	font-family: emoji;
	font-size: 33px;
	letter-spacing: 1px;
	font-variant: small-caps;
	font-style: oblique;
	color:navy;
}


</style>
</head>
<body>

	<div id="main">
		<!--navbar-->
	<nav>
		<div class="b">Sparks Bank</div>
			<ul>
				<li><a href="history.php">Transaction History</a></li>
				<li><a href="view customer.php">View Customer</a></li>
				<li><a href="index.html">Home</a></li>
			</ul>
	</nav>	
		
		<div  class="transactiontable">
			<h4 >TRANSACTION HISTORY</h4>
			<center>
				<table id="myTable" border="1" >
					<tr style="height:40px;">
						<th style="width:250px;">SENDER</th>
						<th style="width:250px;">RECEIVER</th>
						<th style="width:150px;">AMOUNT</th>
						<th style="width:300px;">DATE</th>
					</tr>
				<?php
					$sql = "SELECT * FROM `history` ";
					$result = mysqli_query($con, $sql);
					while($row = mysqli_fetch_assoc($result))
					{
						echo "<tr>";
						echo "<td>". $row['Sender'] . "</td>
							  <td>". $row['Receiver'] . "</td>
							  <td>". $row['Amount'] . "</td>
							  <td>". $row['Date & time'] ."</td>";
						echo  "</tr>";
					}
				?>
          
				</table>
			</center>
		</div>
</body>
</html>