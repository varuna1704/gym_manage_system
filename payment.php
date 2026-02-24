<?php
$page_title = 'Payment | Gym Management System';
include 'user_head1.php';
require 'pg_con.php';

$form = array(
    'user_name' => isset($_POST['user_name']) ? trim($_POST['user_name']) : '',
    'fname' => isset($_POST['fname']) ? trim($_POST['fname']) : '',
    'lname' => isset($_POST['lname']) ? trim($_POST['lname']) : '',
    'user_email' => isset($_POST['user_email']) ? trim($_POST['user_email']) : '',
    'user_age' => isset($_POST['user_age']) ? trim($_POST['user_age']) : '',
    'user_gender' => isset($_POST['user_gender']) ? trim($_POST['user_gender']) : 'female',
    'contact_no' => isset($_POST['contact_no']) ? trim($_POST['contact_no']) : '',
    'user_add' => isset($_POST['user_add']) ? trim($_POST['user_add']) : '',
    'city' => isset($_POST['city']) ? trim($_POST['city']) : '',
    'joindate' => isset($_POST['joindate']) ? trim($_POST['joindate']) : '',
    'expirydate' => isset($_POST['expirydate']) ? trim($_POST['expirydate']) : '',
    'fees' => isset($_POST['fees']) ? trim($_POST['fees']) : ''
);

$error = '';
$success = '';
$dbError = '';

if (!$con) {
    $dbError = 'Database connection failed. Please verify PostgreSQL settings.';
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $required = array(
        $form['user_name'], $form['fname'], $form['lname'], $form['user_email'],
        $form['user_age'], $form['user_gender'], $form['contact_no'], $form['user_add'],
        $form['city'], $form['joindate'], $form['expirydate'], $form['fees']
    );

    $hasEmpty = false;
    foreach ($required as $value) {
        if ($value === '') {
            $hasEmpty = true;
            break;
        }
    }

    if ($hasEmpty) {
        $error = 'Please fill all required fields.';
    } else {
        $userName = pg_escape_string($con, $form['user_name']);
        $firstName = pg_escape_string($con, $form['fname']);
        $lastName = pg_escape_string($con, $form['lname']);
        $userEmail = pg_escape_string($con, $form['user_email']);
        $userAge = pg_escape_string($con, $form['user_age']);
        $userGender = pg_escape_string($con, $form['user_gender']);
        $contactNo = pg_escape_string($con, $form['contact_no']);
        $userAdd = pg_escape_string($con, $form['user_add']);
        $userCity = pg_escape_string($con, $form['city']);
        $joinDate = pg_escape_string($con, $form['joindate']);
        $expiryDate = pg_escape_string($con, $form['expirydate']);
        $fees = pg_escape_string($con, $form['fees']);

        $query = "INSERT INTO bills(user_name,user_email,user_age,user_gender,contact_no,user_add,user_fname,user_lname,user_city,joindate,expirydate,fees) VALUES ('$userName','$userEmail','$userAge','$userGender','$contactNo','$userAdd','$firstName','$lastName','$userCity','$joinDate','$expiryDate','$fees')";
        $result = pg_query($con, $query);

        if ($result) {
            $success = 'Payment successfully recorded.';
            $form = array(
                'user_name' => '', 'fname' => '', 'lname' => '', 'user_email' => '',
                'user_age' => '', 'user_gender' => 'female', 'contact_no' => '',
                'user_add' => '', 'city' => '', 'joindate' => '', 'expirydate' => '', 'fees' => ''
            );
        } else {
            $error = 'Payment could not be saved. Please try again.';
        }
    }
}
?>
<section class="info-block">
    <h2 class="surface-title">Billing Details</h2>
    <p class="surface-note">Submit membership payment details in one form.</p>
</section>
<?php if ($dbError !== '') { ?><div class="form-msg error"><?php echo htmlspecialchars($dbError); ?></div><?php } ?>
<?php if ($error !== '') { ?><div class="form-msg error"><?php echo htmlspecialchars($error); ?></div><?php } ?>
<?php if ($success !== '') { ?><div class="form-msg success"><?php echo htmlspecialchars($success); ?></div><?php } ?>
<form method="POST" action="" autocomplete="off" style="margin-top: 8px;">
    <div class="form-grid">
        <div class="field"><label>Username</label><input type="text" name="user_name" value="<?php echo htmlspecialchars($form['user_name']); ?>" required></div>
        <div class="field"><label>First Name</label><input type="text" name="fname" value="<?php echo htmlspecialchars($form['fname']); ?>" required></div>
        <div class="field"><label>Last Name</label><input type="text" name="lname" value="<?php echo htmlspecialchars($form['lname']); ?>" required></div>
        <div class="field"><label>Email</label><input type="email" name="user_email" value="<?php echo htmlspecialchars($form['user_email']); ?>" required></div>
        <div class="field"><label>Age</label><input type="number" min="1" name="user_age" value="<?php echo htmlspecialchars($form['user_age']); ?>" required></div>
        <div class="field">
            <label>Gender</label>
            <select name="user_gender" required>
                <option value="female" <?php echo $form['user_gender'] === 'female' ? 'selected' : ''; ?>>Female</option>
                <option value="male" <?php echo $form['user_gender'] === 'male' ? 'selected' : ''; ?>>Male</option>
            </select>
        </div>
        <div class="field"><label>Contact Number</label><input type="text" name="contact_no" value="<?php echo htmlspecialchars($form['contact_no']); ?>" required></div>
        <div class="field"><label>City</label><input type="text" name="city" value="<?php echo htmlspecialchars($form['city']); ?>" required></div>
        <div class="field full"><label>Address</label><textarea name="user_add" required><?php echo htmlspecialchars($form['user_add']); ?></textarea></div>
        <div class="field"><label>Joining Date</label><input type="date" name="joindate" value="<?php echo htmlspecialchars($form['joindate']); ?>" required></div>
        <div class="field"><label>Expiry Date</label><input type="date" name="expirydate" value="<?php echo htmlspecialchars($form['expirydate']); ?>" required></div>
        <div class="field"><label>Fees</label><input type="text" name="fees" value="<?php echo htmlspecialchars($form['fees']); ?>" required></div>
    </div>
    <div class="form-actions">
        <button type="submit" class="primary-btn">Submit Payment</button>
        <a href="user_index.php" class="secondary-btn">Back</a>
    </div>
</form>
<?php include 'user_foot.php'; ?>
