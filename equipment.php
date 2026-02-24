<?php include "user_head.php";
?>
<!DOCTYPE html>
<html>
<head>
<!-- <link rel="stylesheet" href="style.css"/> -->
</head>
<style>

table{
	border:2px solid white;
	margin-top:0px;
        margin-left:240px;
	
}
th{
   text-align:center;
   border:2px solid white;
    width:450px;
    height:120px;
    font-size: 30px;
   
  
}

td{
    font-weight: bold;
	border:2px solid white;
	text-align:center;
    width:450px;
    height:120px;
    font-size: 20px;
}
</style>
<body>
<?php
include "pg_con.php";
$query="SELECT * FROM equipment ";
$res=pg_query($con,$query) or die (pg_last_error($con));
echo"<table border=2><tr><th colspan=4>Equipments Info.</th></tr><"
. "tr><td>Eq name</td><td>equipment information</td><td>equipment image</td></tr>";
while($row=pg_fetch_array($res))
{     
  /* echo"<tr><td>".$row[0]."</td>";*/
    echo"<td>".$row[1]."</td>";
    echo"<td>".$row[3]."</td>";  
    $row[2]=pg_fetch_result($res,'eq_img');
    $unes_image= pg_unescape_bytea($row[2]);
    echo "<td>"."<img src=$unes_image width=300 height=300/>"."</td></tr>";
   }
echo "</table>";
pg_close($con);
?>
</body>
</html>
<?php include"user_footer.php";
?>