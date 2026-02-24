<?php include "user_head1.php";
?>
<html>
    <head>
        <style>
.form table{
border:2px solid black;
margin:0px 650px;
width:500px;
height:450px;
border-radius:10px;
background:#6495ed;
box-shadow: 10px 10px 20px 0px;
}
.form{
	height:500px;
	}
.form td{
font-size:20px;
width:450px;

}
.form input[type='textarea']
{
	border:2px solid blue;
	margin-left:30px;
	width:300px;
	height:50px;
}
	
.form input[type='text']
{
	border:2px solid blue;
	margin-left:30px;
	width:300px;
	height:30px;
}

.form input[type='submit']
{
	font-size:20px;
	border-radius:30px;
	padding:10px 100px;
	margin-top:10px;
    background:#02386e;
    color:white;
}
.form input[type='submit']:hover
{
	border:2px solid white;
}
.form input[type='email'],.form input[type='number']
{
	border:2px solid blue;
	margin-left:30px;
	width:300px;
	height:30px;
}
#user_gender{
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
	
	$contact_no=stripslashes($_REQUEST['contact_no']);
	$contact_no=pg_escape_string($con,$contact_no);
	$user_add=stripslashes($_REQUEST['user_add']);
	$user_add=pg_escape_string($con,$user_add);
        $joindate=stripslashes($_REQUEST['joindate']);
	$joindate=pg_escape_string($con,$joindate);
        $expirydate=stripslashes($_REQUEST['expirydate']);
	$expirydate=pg_escape_string($con,$expirydate);
        $fees=stripslashes($_REQUEST['fees']);
	$fees=pg_escape_string($con,$fees);
        
	
            $query="INSERT into bills(user_name,user_email,user_age,user_gender,contact_no,user_add,user_fname,user_lname,user_city,joindate,expirydate,fees) VALUES ('$user_name','$user_email','$user_age','$user_gender','$contact_no','$user_add','$user_fname','$user_lname','$user_city','$joindate','$expirydate','$fees')";
	$result=pg_query($con,$query);
	if($result)
	{
		echo"<div class='formlog'><h3>
                    Payment Sucessfully Done!
                    <br>Thankyou!</h3>
		<br>click here to <a href='payment.php'>BACK</a></div>";
	}
        
        else{
       ?>     
        
<div class="form">
	<form name="payment" action="" method="POST">
	<table>
	<tr><td colspan="2" align="center" ><h1>Billing Details</h1></td></tr>
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
	<!--<tr>
	<td>&nbsp Password </td>
	<td><input type="password" name="user_pass" placeholder="password" required/></td>
	</tr>
        <tr>
	<td>&nbsp confirm Password </td>
	<td><input type="text" name="conf_pass" placeholder="confirm password" required/></td>
	</tr>-->
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
	<!--<tr><td>&nbsp type</td>
	<td><select name="user_type" id="user_type">
	                                <option value="admin">Admin</option>
	                                <option value="trainer">Trainer</option>
					                <option value="user">User</option></select>
									</td></tr>-->
        
        <tr><td>&nbsp Joining Date</td>
            <td><input type="text" name="joindate" placeholder=" Joining Date" required/></td></tr>
        
                
        <tr><td>&nbsp Expiry Date</td>
            <td><input type="text" name="expirydate" placeholder=" Expiry Date" required/></td></tr>
        
        <tr><td>&nbsp Fees.</td>
            <td><input type="text" name="fees" placeholder=" Fees" required/></td></tr>
        
	<tr>
	<td colspan="2" align="center" >
	<input type="submit" name="submit" value="pay" />
	</td></tr>
	<tr><td>&nbsp </td></tr>
	</table>
	</form>
	</div>
        <?php } ?>
</body>
</html>
<?php include "user_foot.php";
?>