<?php
include "user_header.php";
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<style>
    .formlog {
          margin-top:250px;
          font-size: 20px;
          text-align:center;
          }
</style>
<link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
require('pg_con.php');


$user_type = isset($_POST['user_type']) ? $_POST['user_type'] : '';
if($user_type=="admin")
{
if(isset($_REQUEST['user_name']))
{
	$user_name=stripslashes($_REQUEST['user_name']);
	$user_name=pg_escape_string($con,$user_name);
        $user_fname=stripslashes($_REQUEST['fname']);
        $user_fname=pg_escape_string($con,$user_fname);
        $user_lname=stripslashes($_REQUEST['lname']);
        $user_lname=pg_escape_string($con,$user_lname);
        $user_city=stripslashes($_REQUEST['city']);
        $user_city=pg_escape_string($con,$user_city);
        
        
	$user_email=stripslashes($_REQUEST['user_email']);
	$user_email=pg_escape_string($con,$user_email);
	$user_age=stripslashes($_REQUEST['user_age']);
	$user_age=pg_escape_string($con,$user_age);
	$user_gender=stripslashes($_REQUEST['user_gender']);
	$user_gender=pg_escape_string($con,$user_gender);
	$user_pass=stripslashes($_REQUEST['user_pass']);
	$user_pass=pg_escape_string($con,$user_pass);
	$conf_pass=stripslashes($_REQUEST['conf_pass']);
	
	$contact_no=stripslashes($_REQUEST['contact_no']);
	$contact_no=pg_escape_string($con,$contact_no);
	$user_add=stripslashes($_REQUEST['user_add']);
	$user_add=pg_escape_string($con,$user_add);
	if($user_pass==$conf_pass)
	{
	$query="INSERT into admin(admin_name,admin_email,admin_age,admin_gender,admin_pass,acontact_no,admin_add,admin_fname,admin_lname,admin_city) VALUES ('$user_name','$user_email','$user_age','$user_gender','$user_pass','$contact_no','$user_add','$user_fname','$user_lname','$user_city')";
	$result=pg_query($con,$query);
	if($result)
	{
		echo"<div class='formlog'><h3>you are registered successfully</h3>
		<br>click here to <a href='login.php'>login</a></div>";
	}
	}
        else{
		echo "check password!";
	}
	
}
}

else if($user_type=="trainer")
{
if(isset($_REQUEST['user_name']))
{
	$user_name=stripslashes($_REQUEST['user_name']);
	$user_name=pg_escape_string($con,$user_name);
        $user_fname=stripslashes($_REQUEST['fname']);
        $user_fname=pg_escape_string($con,$user_fname);
        $user_lname=stripslashes($_REQUEST['lname']);
        $user_lname=pg_escape_string($con,$user_lname);
        $user_city=stripslashes($_REQUEST['city']);
        $user_city=pg_escape_string($con,$user_city);
        
        
	$user_email=stripslashes($_REQUEST['user_email']);
	$user_email=pg_escape_string($con,$user_email);
	$user_age=stripslashes($_REQUEST['user_age']);
	$user_age=pg_escape_string($con,$user_age);
	$user_gender=stripslashes($_REQUEST['user_gender']);
	$user_gender=pg_escape_string($con,$user_gender);
	$user_pass=stripslashes($_REQUEST['user_pass']);
	$user_pass=pg_escape_string($con,$user_pass);
	$conf_pass=stripslashes($_REQUEST['conf_pass']);
	
	$contact_no=stripslashes($_REQUEST['contact_no']);
	$contact_no=pg_escape_string($con,$contact_no);
	$user_add=stripslashes($_REQUEST['user_add']);
	$user_add=pg_escape_string($con,$user_add);
	if($user_pass==$conf_pass)
	{
	$query="INSERT into trainers(trainer_name,trainer_email,trainer_age,trainer_gender,trainer_pass,tcontact_no,trainer_add,trainer_fname,trainer_lname,trainer_city) VALUES ('$user_name','$user_email','$user_age','$user_gender','$user_pass','$contact_no','$user_add','$user_fname','$user_lname','$user_city')";
	$result=pg_query($con,$query);
	if($result)
	{
		echo"<div class='formlog'><h3>you are registered successfully</h3>
		<br>click here to <a href='login.php'>login</a></div>";
	}
	}
        else{
		echo "check password!";
	}
}
}

else if($user_type=="user")
{
if(isset($_REQUEST['user_name']))
{
	$user_name=stripslashes($_REQUEST['user_name']);
	$user_name=pg_escape_string($con,$user_name);
        $user_fname=stripslashes($_REQUEST['fname']);
        $user_fname=pg_escape_string($con,$user_fname);
        $user_lname=stripslashes($_REQUEST['lname']);
        $user_lname=pg_escape_string($con,$user_lname);
        $user_city=stripslashes($_REQUEST['city']);
        $user_city=pg_escape_string($con,$user_city);
        
        
	$user_email=stripslashes($_REQUEST['user_email']);
	$user_email=pg_escape_string($con,$user_email);
	$user_age=stripslashes($_REQUEST['user_age']);
	$user_age=pg_escape_string($con,$user_age);
	$user_gender=stripslashes($_REQUEST['user_gender']);
	$user_gender=pg_escape_string($con,$user_gender);
	$user_pass=stripslashes($_REQUEST['user_pass']);
	$user_pass=pg_escape_string($con,$user_pass);
	$conf_pass=stripslashes($_REQUEST['conf_pass']);
	
	$contact_no=stripslashes($_REQUEST['contact_no']);
	$contact_no=pg_escape_string($con,$contact_no);
	$user_add=stripslashes($_REQUEST['user_add']);
	$user_add=pg_escape_string($con,$user_add);
	if($user_pass==$conf_pass)
	{
	$query="INSERT into users(user_name,user_pass,user_email,user_age,user_gender,contact_no,user_add,user_fname,user_lname,user_city) VALUES ('$user_name','$user_pass','$user_email','$user_age','$user_gender','$contact_no','$user_add','$user_fname','$user_lname','$user_city')";
	$result=pg_query($con,$query);
	
        if($result)
	{
		echo"<div class='formlog'><h3>you are registered successfully</h3>
		<br>click here to <a href='login.php'>login</a></div>";
	}
        
	}
        else{
		echo "check password!";
	}
}

}

else
{
	?>
	<div class="form">
	<form name="registration" action="" method="POST">
	<table>
	<tr><td colspan="2" align="center" ><h1>Registration</h1></td></tr>
	<tr>
	<td>&nbsp User Name </td>
	<td><input type="text" name="user_name" placeholder="username" required/></td>
	<tr>
	<td>&nbsp first Name </td>
	<td><input type="text" name="fname" placeholder="first name" required/></td></tr>
	<tr>
	<td>&nbsp Last Name </td>
	<td><input type="text" name="lname" placeholder="Last name" required/></td></tr>
	
	<tr>
	<td>&nbsp Email </td>
	<td><input type="email" name="user_email" placeholder="email" required/></td>
	<tr>
	<td	>&nbsp Age</td>
	<td><input type="number" name="user_age" placeholder="age" required/></td></tr>
	<tr>
	<td>&nbsp Gender</td>
	<td><select name="user_gender" id="user_gender"> 
	                        <option value="female">Female</option>
				<option value="male">Male</option></select></td></tr>
	<tr>
	<td>&nbsp Password </td>
	<td><input type="password" name="user_pass" placeholder="password" required/></td>
	</tr>
        <tr>
	<td>&nbsp confirm Password </td>
	<td><input type="text" name="conf_pass" placeholder="confirm password" required/></td>
	</tr>
	<tr><td>&nbsp contact no</td>
	<td><input type="text" name="contact_no" placeholder="contact no" required/></td></tr>
	<tr><td>&nbsp Address</td>
	<td><input type="textarea" name="user_add" placeholder="Address" required/></td></tr>
	<tr>
	<td>&nbsp City </td>
	<td><input type="text" name="city" placeholder="City" required/></td></tr>

	
	<!--<tr><td>&nbsp State</td>
	<td><select name="state" id="state">
	                           <option value="#">select state</option>
	                           <option value="andhra_pradhesh">Andhra Pradhesh</option>
	                           <option value="maharashtra">Maharashtra</option>
					                <option value="gujrat">Gujrat</option>
									<option value="rajasthan">Rajasthan</option>
									<option value="haryana">Haryana</option>
									</select>
									</td></tr>-->
	<tr><td>&nbsp type</td>
	<td><select name="user_type" id="user_type">
	                                <option value="admin">Admin</option>
	                                <option value="trainer">Trainer</option>
					                <option value="user">User</option></select>
									</td></tr>
	<tr>
	<td colspan="2" align="center" >
	<input type="submit" name="submit" value="register" />
	</td></tr>
	<tr><td>&nbsp </td></tr>
	</table>
	</form>
	</div>
	<?php
}
?>
</body>
</html>

<?php
include "user_foot.php";

?>
