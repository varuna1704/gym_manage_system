<!doctype html>
<html>
<head>
<style>

</style>
<head>
<body>
  
<?php /*
require('pg_con.php');
session_start();

$new_password=$_POST['new_password'];
$confirm_password=$_POST['confirm_password'];
$query="SELECT * FROM users;";
$result=pg_query($con,$query);
$rows=pg_num_rows($result);
if($new_password==$confirm_password)
{
if($rows > 0)
{
while($row=pg_fetch_array($result))
{  
 if($row['user_pass']!='$new_password')
 {
  $query="UPDATE users SET user_pass=? WHERE user_name=?";
  $result=pg_query($con,$query);
    }
    else{
         echo "<div class='formlog'><h3>password is same as previous one</h3>
                      <br>click here<a href='resetpassword.php'>Reset Password</a></div>";
        }
    if($result)
	{
		echo"<div class='form'><h3>your password changed successfully</h3>
		<br>click here to <a href='login.php'>login</a></div>";
	}
            }
            }
 
*/
?>	
   
<div class="wrapper">
<h2>Reset Password</h2>
<p>Please fill out this from to reset your password.</p>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<div class="form-group">
<label>New Password</label>
<input type="password" name="new_password" class="form-control <?php echo(!empty($new_password_err)) ? 'is-invaild' : ' '; ?>" value="<?php echo $new_password; ?>">
<span class="invalid-feedback"><?php echo $new_password_err; ?></span>
</div>
<div class="form-group">
<label>Confirm Password</label>
<input type="password" name="confirm_password" class="form-control <?php echo(!empty($confirm_password_err)) ? 'is-invalid' : '';?>">
<span class="invalid-feedback"><?php echo $confirm_password_err;?></span>
</div>
<div class="form-group">
<input type="submit" value="submit">
<a href="login.php">Cancel</a>
</div>

</form>
</div>
</body>
</html>

