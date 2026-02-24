<?php 
   include "user_head.php";
   ?>
<?php
include_once "pg_con.php";
?>


<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css"/>
</head>
<style>
table{
	border:2px solid blue;
        background:#ccccff;
	margin-top:0px;
	margin-left:250px;
}

td,th{
	border:2px solid blue;
	text-align:center;
    width:250px;
}
</style>
<body>

<?php

$query="SELECT * FROM users;";
$result=pg_query($con,$query);
$rows=pg_num_rows($result);
if($rows > 0)
{
	
echo "<table><tr><th colspan=4>Male batch</th></tr><tr>
		<th>user name  </th><th>email  </th><th>contact no  </th> <th>address </b></th></tr>";
	while($row=pg_fetch_array($result))
	{    
		if($row['user_gender']=='male')
		{
		echo "<tr><td>".$row['user_name']." </td><td>".$row['user_email']."</td><td>".$row['contact_no']."</td><td>".$row['user_add']."</td></tr><br>";
		}
 
	}
	echo "</table><br/> ";	
}

$query="SELECT * FROM users;";
$result=pg_query($con,$query);
$rows=pg_num_rows($result);
if($rows > 0)
{
	
echo "<table><tr><th colspan=5>Female batch</th></tr><tr>
		<th><b>user name  </th><th>email  </th><th>contact no  </th> <th>address </b></th></tr>";
	while($row=pg_fetch_array($result))
	{    
		if($row['user_gender']=='female')
		{
		echo "<tr><td>".$row['user_name']." </td><td>".$row['user_email']."</td><td>".$row['contact_no']."</td><td>".$row['user_add']."</td></tr><br>";
		}
          

	}
	echo "</table> ";	
}

?>
</body>
</html>

<?php 
   include "user_footer.php";
   ?>