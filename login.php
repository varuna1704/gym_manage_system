<?php
include "user_header.php";
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<!--<link rel="stylesheet" href="style.css"/>-->
<style>
    
.formlog table{
               border:2px solid black;
               margin:-120px 650px;
               width:500px;
               height:450px;
               border-radius:10px;
               background:#6495ed;
               box-shadow: 10px 10px 20px 0px;
               }
.formlog{
	height:500px;
	}
.formlog td{
           font-size:20px;
           width:450px;
           }
	
.formlog input[type='text']{
	                  border:2px solid blue;
	                  margin-left:30px;
	                  width:300px;
	                  height:30px;
                          }
.formlog input[type='password']{
	                        border:2px solid blue;
	                        margin-left:30px;
	                        width:300px;
	                        height:30px;
                                }
.formlog input[type='submit']{
	                      font-size:20px;
	                      border-radius:30px;
	                      padding:10px 100px;
	                      margin-top:10px;
                              background:#02386e;
                              color:white;
                              }
.formlog input[type='submit']:hover{
	                            border:2px solid white;
                                    }

#user_type{
           color:gray;
           background:white;
	   border:2px solid blue;
	   margin-left:30px;
	   width:305px;
	   height:30px;
          }
.formlog {
          margin-top:250px;
          font-size: 20px;
          text-align:center;
          }
</style>
</head>
<body>
<?php
require('pg_con.php');
session_start();
$user_type = isset($_POST['user_type']) ? $_POST['user_type'] : '';
if(!$con)
{
echo "<div class='formlog'><h3>Database connection failed.</h3>
<p>Please set valid PostgreSQL credentials and try again.</p></div>";
}
else if($user_type=='admin')
{
if(isset($_POST['user_name']))
{
$user_name=stripslashes($_REQUEST['user_name']);
$user_name=pg_escape_string($con,$user_name);
$user_pass=stripslashes($_REQUEST['user_pass']);
$user_pass=pg_escape_string($con,$user_pass);

$query="SELECT * FROM admin WHERE admin_name='$user_name' and admin_pass='$user_pass'";
$result=pg_query($con,$query) or die(pg_error());
$rows=pg_num_rows($result);

if($rows==1)
{
$_SESSION['user_name']=$user_name;
header("location:index.php");
}
else{
echo "<div class='formlog'><h3>username/password is incorrect</h3>
<br>click here<a href='login.php'>login</a></div>";
}
}
}

else if($user_type=='trainer')
{
if(isset($_POST['user_name']))
{
$user_name=stripslashes($_REQUEST['user_name']);
$user_name=pg_escape_string($con,$user_name);
$user_pass=stripslashes($_REQUEST['user_pass']);
$user_pass=pg_escape_string($con,$user_pass);

$query="SELECT * FROM trainers WHERE trainer_name='$user_name' and trainer_pass='$user_pass'";
$result=pg_query($con,$query) or die(pg_error());
$rows=pg_num_rows($result);

if($rows==1)
{
$_SESSION['user_name']=$user_name;
header("location:trainer_index.php");
}
else{
echo "<div class='formlog'><h3>username/password is incorrect</h3>
<br>click here<a href='login.php'>login</a></div>";
}
}
}

else if($user_type=='user')
{
if(isset($_POST['user_name']))
{
$user_name=stripslashes($_REQUEST['user_name']);
$user_name=pg_escape_string($con,$user_name);
$user_pass=stripslashes($_REQUEST['user_pass']);
$user_pass=pg_escape_string($con,$user_pass);

$query="SELECT * FROM users WHERE user_name='$user_name' and user_pass='$user_pass'";
$result=pg_query($con,$query) or die(pg_error());
$rows=pg_num_rows($result);

if($rows==1)
{
$_SESSION['user_name']=$user_name;
header("location:user_index.php");
}
else{
echo "<div class='formlog'><h3>username/password is incorrect</h3>
<br>click here<a href='login.php'>login</a></div>";
}
}
}

else{
?>
<div class="formlog">
<form action="" method="POST" name="login">
<table>
<td colspan="2" align="center" ><h1>login</h1></td></tr>
<tr>
<td>&nbsp username </td><td><input type="text" name="user_name" placeholder="&nbsp username" required/></td>
</tr>
<tr>
<td>&nbsp password </td>
<td><input type="password" name="user_pass" placeholder="&nbsp password" required/></td></tr>
<tr><td>&nbsp type</td><td><select name="user_type" id="user_type">
                                       <option value="admin">&nbsp Admin</option>
	                                   <option value="trainer">&nbsp Trainer</option>
					                   <option value="user">&nbsp User</option>
		        	</td></tr></select>
<tr>
<td colspan="2" align="center" ><input type="submit" name="submit" value="Login"/></td>
</tr>
<tr><td colspan="2" align="center" ><p>not registered yet?
            <a href='register.php'>Register here</a></p></td></tr>
<!--
<tr><td colspan="2" align="center" ><p><a href='resetpassword.php'>reset password</a></p></td></tr>-->
</table>
</form>
</div>
<?php
}
include "user_footer.php";
?></body>
</html>
