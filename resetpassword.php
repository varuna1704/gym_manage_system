<?php
$page_title = 'Reset Password | Gym Management System';
include 'user_header.php';
require 'pg_con.php';

$error = '';
$success = '';
$form = array(
    'user_name' => isset($_POST['user_name']) ? trim($_POST['user_name']) : '',
    'new_password' => '',
    'confirm_password' => ''
);

if (!$con) {
    $error = 'Database connection failed. Please verify PostgreSQL settings.';
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form['new_password'] = isset($_POST['new_password']) ? trim($_POST['new_password']) : '';
    $form['confirm_password'] = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';

    if ($form['user_name'] === '' || $form['new_password'] === '' || $form['confirm_password'] === '') {
        $error = 'All fields are required.';
    } else if ($form['new_password'] !== $form['confirm_password']) {
        $error = 'New password and confirm password do not match.';
    } else {
        $userName = pg_escape_string($con, $form['user_name']);
        $newPassword = pg_escape_string($con, $form['new_password']);

        $query = "UPDATE users SET user_pass='$newPassword' WHERE user_name='$userName'";
        $result = pg_query($con, $query);

        if ($result && pg_affected_rows($result) > 0) {
            $success = 'Password updated successfully. You can now log in.';
            $form = array('user_name' => '', 'new_password' => '', 'confirm_password' => '');
        } else {
            $error = 'User not found or password unchanged.';
        }
    }
}
?>
<section class="info-block">
    <h2 class="surface-title">Reset Password</h2>
    <p class="surface-note">Update your account password with your username.</p>
</section>
<?php if ($error !== '') { ?><div class="form-msg error"><?php echo htmlspecialchars($error); ?></div><?php } ?>
<?php if ($success !== '') { ?><div class="form-msg success"><?php echo htmlspecialchars($success); ?></div><?php } ?>
<form method="POST" action="" autocomplete="off" style="margin-top: 8px; max-width: 680px;">
    <div class="form-grid" style="grid-template-columns: 1fr;">
        <div class="field">
            <label>Username</label>
            <input type="text" name="user_name" value="<?php echo htmlspecialchars($form['user_name']); ?>" required>
        </div>
        <div class="field">
            <label>New Password</label>
            <input type="password" name="new_password" required>
        </div>
        <div class="field">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" required>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="primary-btn">Reset Password</button>
        <a href="login.php" class="secondary-btn">Back To Login</a>
    </div>
</form>
<?php include 'user_footer.php'; ?>
