<?php
include "user_head1.php";
?>
<!DOCTYPE html>
<html>
<head>
<style>
            
           .diet table{
               border:2px solid black;
               background:#6666ff;
                margin: 0px 500px; 
            }
            .diet tr{
                
            }
            .diet th,.diet td{
               
            width: 1000px;
            height: 30px;
            text-align: center;
            color: white;
            }
            .diet h1,.diet3 h4{
                font-size: 40px;
                margin:10px 50px;
            }
            
            
            
        </style>
            </head>
    <body>
   <?php 
   include "pg_con.php";
$query="SELECT * FROM dietplan;";
$result=pg_query($con,$query);
$rows=pg_num_rows($result);
if($rows > 0)
{
	
        echo"<div class='diet'>
    <center> <h1> DIET PLAN </h1> </center>
        <table border='2'>";
           
           echo "<tr><th> Time</th><th>Meal </th><th> Food Items</th></tr>";
        while($row=pg_fetch_array($result))
	{    
            
        echo"<tr><td>".$row['diet_time']."</td><td>".$row['diet_meal']."</td><td>".$row['diet_food']."</td></tr>";
        }

            
         echo "</table></div>";
}
         echo"<center> <h4>Before Workout - 2 Banana or 1 Apple</h4>
                   <h4>After Workout - 2 Scoops Gainer with Water</h4> </center>";
         ?>
    </body>
</html>
<?php
include "user_foot.php";
?>