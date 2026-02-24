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
</head><style>
    body{
        background:whitesmoke;
    }
    .btn1 button{
        width:600px;
        height:80px;
        background:red;
        color:white;
        font-size: 40px;
      
        
    }
    table{
        padding: 50px;
        background: white;
        margin:-30px 50px;
    }
    /*.btn2 button{
        width:600px;
        height: 80px;
        background: green;
        color:white;
        font-size: 40px;
    }*/
    .btn3 button{
        width:600px;
        height: 80px;
        background: blue;
        color:white;
        font-size: 40px;
    }
    td{
        padding:50px 100px;
    }
    table{
        margin-top: 160px;
    }
</style>

<body>
    
    <table><tr>
            <td>
    <div class="btn1">
        <a href="batch.php"><button value="user">Batch</button></a></div></td>
    
        <!--<td>  <div class="btn2">
                <a href="user.php"><button value="user">Attendance</button></a></div></td>-->
    
                <td>  <div class="btn3">
                        <a href="equipment.php"><button value="user">Equipments</button></a></div></td>
        </tr><!-- comment -->
    </table>
</body>
</html>

<?php 
   include "user_foot.php";
   ?>