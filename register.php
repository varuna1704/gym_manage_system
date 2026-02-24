<?php
require('pg_con.php');

$registerError = '';
$registerSuccess = '';
$dbError = '';

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
    'user_type' => isset($_POST['user_type']) ? trim($_POST['user_type']) : 'user'
);

if (!$con) {
    $dbError = 'Database connection failed. Please verify PostgreSQL settings.';
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userPass = isset($_POST['user_pass']) ? trim($_POST['user_pass']) : '';
    $confPass = isset($_POST['conf_pass']) ? trim($_POST['conf_pass']) : '';

    $required = array(
        $form['user_name'], $form['fname'], $form['lname'], $form['user_email'],
        $form['user_age'], $form['user_gender'], $form['contact_no'],
        $form['user_add'], $form['city'], $form['user_type'], $userPass, $confPass
    );

    $hasEmpty = false;
    foreach ($required as $value) {
        if ($value === '') {
            $hasEmpty = true;
            break;
        }
    }

    if ($hasEmpty) {
        $registerError = 'Please fill all required fields.';
    } else if ($userPass !== $confPass) {
        $registerError = 'Password and confirm password do not match.';
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
        $userType = pg_escape_string($con, $form['user_type']);
        $safePass = pg_escape_string($con, $userPass);

        if ($userType === 'admin') {
            $query = "INSERT INTO admin(admin_name,admin_email,admin_age,admin_gender,admin_pass,acontact_no,admin_add,admin_fname,admin_lname,admin_city) VALUES ('$userName','$userEmail','$userAge','$userGender','$safePass','$contactNo','$userAdd','$firstName','$lastName','$userCity')";
        } else if ($userType === 'trainer') {
            $query = "INSERT INTO trainers(trainer_name,trainer_email,trainer_age,trainer_gender,trainer_pass,tcontact_no,trainer_add,trainer_fname,trainer_lname,trainer_city) VALUES ('$userName','$userEmail','$userAge','$userGender','$safePass','$contactNo','$userAdd','$firstName','$lastName','$userCity')";
        } else {
            $query = "INSERT INTO users(user_name,user_pass,user_email,user_age,user_gender,contact_no,user_add,user_fname,user_lname,user_city) VALUES ('$userName','$safePass','$userEmail','$userAge','$userGender','$contactNo','$userAdd','$firstName','$lastName','$userCity')";
        }

        $result = pg_query($con, $query);
        if ($result) {
            $registerSuccess = 'Registration successful. You can now log in.';
            $form = array(
                'user_name' => '', 'fname' => '', 'lname' => '', 'user_email' => '',
                'user_age' => '', 'user_gender' => 'female', 'contact_no' => '',
                'user_add' => '', 'city' => '', 'user_type' => 'user'
            );
        } else {
            $registerError = 'Registration failed. Please try a different username/email.';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register | Gym Management System</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root {
    --bgA: #eef2f7;
    --bgB: #dbe3ee;
    --panel: #ffffff;
    --text: #111827;
    --muted: #64748b;
    --line: #e5e7eb;
    --accentA: #ef4444;
    --accentB: #991b1b;
    --shell-width: min(1140px, calc(100% - 16px));
    --header-offset: 132px;
    --footer-offset: 64px;
}
* { box-sizing: border-box; }
html, body {
    height: 100%;
    margin: 0;
    overflow: hidden;
    font-family: "Plus Jakarta Sans", "Segoe UI", sans-serif;
    color: var(--text);
}
body { background: radial-gradient(circle at 20% 20%, var(--bgA), var(--bgB)); }
.page { height: 100vh; position: relative; }
.site-header,.site-footer,.page-main { width: var(--shell-width); margin: 0; }
.site-header {
    position: fixed;
    top: 8px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 40;
    border-radius: 14px;
    overflow: hidden;
    background: #9ab0d3;
    box-shadow: 0 8px 20px rgba(15, 23, 42, 0.14);
}
.site-title {
    margin: 0;
    padding: 10px;
    text-align: center;
    font-size: clamp(20px, 2.2vw, 32px);
    font-weight: 800;
    letter-spacing: 0.4px;
}
.site-nav {
    background: #0e1117;
    margin: 0 10px 10px;
    border-radius: 12px;
    padding: 8px 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
}
.site-nav ul { margin: 0; padding: 0; list-style: none; display: flex; gap: 16px; flex-wrap: wrap; }
.site-nav a { color: #fff; text-decoration: none; font-size: 13px; font-weight: 700; }
.site-nav .search {
    width: 160px;
    max-width: 45%;
    border: 0;
    border-radius: 999px;
    padding: 6px 10px;
    font-size: 12px;
}
.page-main {
    position: fixed;
    top: var(--header-offset);
    bottom: var(--footer-offset);
    left: 50%;
    transform: translateX(-50%);
    min-height: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px 14px;
    overflow: hidden;
}
.auth-card {
    --card-scale: 1;
    width: 100%;
    height: min(560px, 100%);
    background: var(--panel);
    border-radius: 16px;
    box-shadow: 0 20px 46px rgba(15, 23, 42, 0.16);
    display: grid;
    grid-template-columns: 1.12fr 0.88fr;
    overflow: hidden;
    transform: scale(var(--card-scale));
    transform-origin: center center;
    will-change: transform;
}
.auth-left {
    padding: 18px 20px;
    display: flex;
    flex-direction: column;
}
.brand {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 16px;
    font-weight: 800;
}
.brand-badge {
    width: 28px;
    height: 28px;
    border-radius: 9px;
    display: grid;
    place-items: center;
    color: #fff;
    font-size: 14px;
    background: linear-gradient(145deg, #ff5a4d, #d51717);
}
.auth-left h1 {
    margin: 10px 0 6px;
    font-size: clamp(22px, 2vw, 32px);
    line-height: 1.1;
}
.subtitle {
    margin: 0 0 10px;
    color: var(--muted);
    font-size: 12px;
}
.alert {
    border-radius: 10px;
    padding: 8px 10px;
    font-size: 12px;
    margin-bottom: 8px;
}
.alert-error { background: #fff0f0; color: #8b1313; border: 1px solid #ffd7d7; }
.alert-db { background: #fff3df; color: #874f00; border: 1px solid #ffd59a; }
.alert-ok { background: #ecfdf3; color: #0f5132; border: 1px solid #b7f0c6; }
.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
}
.field {
    border: 1px solid var(--line);
    border-radius: 10px;
    background: #fafbfc;
    padding: 0 10px;
}
.field input,
.field select {
    width: 100%;
    border: 0;
    background: transparent;
    outline: none;
    padding: 10px 6px;
    font-size: 13px;
}
.field.full { grid-column: 1 / -1; }
.type-grid {
    grid-column: 1 / -1;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
}
.type-grid label {
    border: 1px solid var(--line);
    border-radius: 10px;
    text-align: center;
    padding: 8px 4px;
    font-size: 11px;
    font-weight: 800;
    color: #59606c;
    cursor: pointer;
}
.type-grid input { display: none; }
.type-grid label:has(input:checked) {
    border-color: #d61f1f;
    background: #fff3f3;
    color: #bb1111;
}
.action-row {
    margin-top: 10px;
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 10px;
    align-items: center;
}
.register-btn {
    border: 0;
    border-radius: 999px;
    background: linear-gradient(145deg, var(--accentA), var(--accentB));
    color: #fff;
    font-size: 15px;
    font-weight: 800;
    padding: 10px 14px;
    cursor: pointer;
    box-shadow: 0 8px 20px rgba(201, 21, 21, 0.34);
}
.login-link {
    font-size: 12px;
    color: #6b7280;
}
.login-link a {
    color: #c21717;
    font-weight: 800;
    text-decoration: none;
}
.auth-right {
    background: linear-gradient(155deg, #ff3b34 0%, #e01b1b 45%, #9a0f0f 100%);
    color: #fff;
    position: relative;
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
}
.auth-right:before {
    content: "";
    position: absolute;
    width: 180px;
    height: 180px;
    top: -50px;
    right: -30px;
    border-radius: 50%;
    background: rgba(255,255,255,0.1);
}
.shield {
    width: 150px;
    height: 150px;
    border-radius: 22px;
    border: 1px solid rgba(255,255,255,0.25);
    background: linear-gradient(145deg, rgba(255,255,255,0.2), rgba(255,255,255,0.06));
    box-shadow: 0 18px 34px rgba(91, 8, 8, 0.35);
    display: grid;
    place-items: center;
    margin-bottom: 16px;
    position: relative;
    z-index: 1;
}
.shield-icon {
    width: 70px;
    height: 70px;
    border-radius: 18px;
    border: 1px solid rgba(255,255,255,0.35);
    display: grid;
    place-items: center;
    font-size: 26px;
}
.auth-right h2 { margin: 0 0 8px; font-size: clamp(24px, 2.1vw, 34px); }
.auth-right p { margin: 0; font-size: 13px; line-height: 1.6; max-width: 320px; }
.site-footer {
    position: fixed;
    left: 50%;
    bottom: 8px;
    transform: translateX(-50%);
    z-index: 40;
    margin: 0;
    background: linear-gradient(120deg, #111827 0%, #0f172a 55%, #7f1d1d 100%);
    border-top: 3px solid #ef4444;
    color: #f8fafc;
    text-align: center;
    padding: 10px 12px;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    border-radius: 12px;
    box-shadow: 0 10px 24px rgba(15, 23, 42, 0.28);
}
@media (max-width: 900px) {
    .site-nav .search { display: none; }
    .auth-right { display: none; }
    .auth-card { grid-template-columns: 1fr; height: min(535px, 100%); }
}
@media (max-height: 760px) {
    .site-title { font-size: clamp(18px, 2vw, 30px); }
}
@media (max-height: 700px) {
    :root {
        --header-offset: 118px;
        --footer-offset: 56px;
    }
    .site-header { top: 4px; }
    .site-title { padding: 8px; }
    .site-nav { padding: 6px 10px; margin: 0 8px 8px; }
    .site-footer { bottom: 4px; padding: 8px 10px; }
}
</style>
</head>
<body>
<div class="page">
    <header class="site-header">
        <h1 class="site-title">GYM MANAGEMENT SYSTEM</h1>
        <nav class="site-nav">
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="aboutus.php">ABOUT US</a></li>
                <li><a href="services.php">SERVICES</a></li>
                <li><a href="login.php">LOGIN</a></li>
            </ul>
            <input class="search" type="text" placeholder="Search Information">
        </nav>
    </header>

    <main class="page-main">
        <div class="auth-card">
            <section class="auth-left">
                <div class="brand"><span class="brand-badge">F</span>GymFlow</div>
                <h1>Create Your Account</h1>
                <p class="subtitle">Register as Admin, Trainer, or User in one step.</p>

                <?php if ($dbError !== '') { ?>
                <div class="alert alert-db"><?php echo htmlspecialchars($dbError); ?></div>
                <?php } ?>
                <?php if ($registerError !== '') { ?>
                <div class="alert alert-error"><?php echo htmlspecialchars($registerError); ?></div>
                <?php } ?>
                <?php if ($registerSuccess !== '') { ?>
                <div class="alert alert-ok"><?php echo htmlspecialchars($registerSuccess); ?></div>
                <?php } ?>

                <form method="POST" action="" autocomplete="off">
                    <div class="form-grid">
                        <label class="field"><input type="text" name="user_name" placeholder="Username" value="<?php echo htmlspecialchars($form['user_name']); ?>" required></label>
                        <label class="field"><input type="text" name="fname" placeholder="First Name" value="<?php echo htmlspecialchars($form['fname']); ?>" required></label>

                        <label class="field"><input type="text" name="lname" placeholder="Last Name" value="<?php echo htmlspecialchars($form['lname']); ?>" required></label>
                        <label class="field"><input type="email" name="user_email" placeholder="Email" value="<?php echo htmlspecialchars($form['user_email']); ?>" required></label>

                        <label class="field"><input type="number" name="user_age" placeholder="Age" min="1" value="<?php echo htmlspecialchars($form['user_age']); ?>" required></label>
                        <label class="field">
                            <select name="user_gender" required>
                                <option value="female" <?php echo $form['user_gender'] === 'female' ? 'selected' : ''; ?>>Female</option>
                                <option value="male" <?php echo $form['user_gender'] === 'male' ? 'selected' : ''; ?>>Male</option>
                            </select>
                        </label>

                        <label class="field"><input type="text" name="contact_no" placeholder="Contact Number" value="<?php echo htmlspecialchars($form['contact_no']); ?>" required></label>
                        <label class="field"><input type="text" name="city" placeholder="City" value="<?php echo htmlspecialchars($form['city']); ?>" required></label>

                        <label class="field"><input type="password" name="user_pass" placeholder="Password" required></label>
                        <label class="field"><input type="password" name="conf_pass" placeholder="Confirm Password" required></label>

                        <label class="field full"><input type="text" name="user_add" placeholder="Address" value="<?php echo htmlspecialchars($form['user_add']); ?>" required></label>

                        <div class="type-grid">
                            <label><input type="radio" name="user_type" value="admin" <?php echo $form['user_type'] === 'admin' ? 'checked' : ''; ?>><span>Admin</span></label>
                            <label><input type="radio" name="user_type" value="trainer" <?php echo $form['user_type'] === 'trainer' ? 'checked' : ''; ?>><span>Trainer</span></label>
                            <label><input type="radio" name="user_type" value="user" <?php echo $form['user_type'] === 'user' ? 'checked' : ''; ?>><span>User</span></label>
                        </div>
                    </div>

                    <div class="action-row">
                        <button type="submit" class="register-btn">Create Account</button>
                        <div class="login-link">Already have an account? <a href="login.php">Login</a></div>
                    </div>
                </form>
            </section>

            <aside class="auth-right">
                <div class="shield"><div class="shield-icon">R</div></div>
                <h2>Rapid Member Onboarding</h2>
                <p>Register instantly and start managing members, trainers, billing, and gym operations in one secure flow.</p>
            </aside>
        </div>
    </main>

    <footer class="site-footer">Nikam Varuna</footer>
</div>
<script>
(function () {
    function fitAuthCard() {
        var main = document.querySelector('.page-main');
        var card = document.querySelector('.auth-card');
        if (!main || !card) return;

        card.style.setProperty('--card-scale', '1');
        var availableHeight = main.clientHeight - 2;
        var cardHeight = card.scrollHeight;
        if (!availableHeight || !cardHeight) return;

        var scale = Math.min(1, availableHeight / cardHeight);
        card.style.setProperty('--card-scale', scale.toFixed(3));
    }

    window.addEventListener('load', fitAuthCard);
    window.addEventListener('resize', fitAuthCard);
})();
</script>
</body>
</html>
