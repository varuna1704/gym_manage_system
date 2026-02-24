<?php 
   include "user_head1.php";
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
        width:550px;
        height:80px;
        background:red;
        color:white;
        font-size: 40px;
    }
    .btn2 button{
        width:550px;
        height: 80px;
        background:green;
        color:white;
        font-size: 40px;
    }
     .btn3 button{
        width:550px;
        height: 80px;
        background: blue;
        color:white;
        font-size: 40px;
    }
    .time{
        width:350px;
        height: 100px;
        background: black;
        color:white;
        font-size: 40px;
        margin:-20px 1400px;
        border-radius: 60px;
        text-align: center;
    }
    td{
        padding:100px 10px;
    }
    table{
        
        padding: 10px;
        background: white;
        margin: 50px 20px;
    }
</style>
<body>
    <div class="time">
        batch time:
        11:00 pm
    </div>
    <table><tr>
            <td>
    <div class="btn1">
        <a href="equipment.php"><button value="user">equipment</button></a></div></td>
    
        <td>  <div class="btn2">
                <a href="dietplan.php"><button value="user">diet plan</button></a></div></td>
    
                <td>  <div class="btn3">
                        <a href="payment.php"><button value="user">payment</button></a></div></td>
        </tr>
    </table>
</body>
</html>

<?php 
   include "user_foot.php";
   ?>