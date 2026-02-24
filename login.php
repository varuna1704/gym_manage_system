<?php
require('pg_con.php');
session_start();

$loginError = '';
$dbError = '';
$userType = isset($_POST['user_type']) ? $_POST['user_type'] : 'user';

if (!$con) {
    $dbError = 'Database connection failed. Please verify PostgreSQL settings.';
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userName = isset($_POST['user_name']) ? trim($_POST['user_name']) : '';
    $userPass = isset($_POST['user_pass']) ? trim($_POST['user_pass']) : '';

    if ($userName === '' || $userPass === '') {
        $loginError = 'Username and password are required.';
    } else {
        $userName = pg_escape_string($con, $userName);
        $userPass = pg_escape_string($con, $userPass);

        if ($userType === 'admin') {
            $query = "SELECT * FROM admin WHERE admin_name='$userName' AND admin_pass='$userPass'";
            $redirect = 'index.php';
        } else if ($userType === 'trainer') {
            $query = "SELECT * FROM trainers WHERE trainer_name='$userName' AND trainer_pass='$userPass'";
            $redirect = 'trainer_index.php';
        } else {
            $query = "SELECT * FROM users WHERE user_name='$userName' AND user_pass='$userPass'";
            $redirect = 'user_index.php';
        }

        $result = pg_query($con, $query);
        if ($result && pg_num_rows($result) === 1) {
            $_SESSION['user_name'] = $userName;
            header("Location: $redirect");
            exit;
        }
        $loginError = 'Invalid username, password, or account type.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login | Gym Management System</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
* { box-sizing: border-box; }
body {
    margin: 0;
    min-height: 100vh;
    font-family: "Plus Jakarta Sans", "Segoe UI", sans-serif;
    background: radial-gradient(circle at 20% 20%, #f5f5f5 0%, #ebedf0 45%, #dde1e6 100%);
    color: #111111;
}
.page-main {
    width: 100%;
    max-width: 1120px;
    margin: 0 auto;
    padding: 24px;
    min-height: calc(100vh - 210px);
    display: grid;
    place-items: center;
}
.site-header {
    width: 100%;
    max-width: 1120px;
    margin: 18px auto 0;
    border-radius: 18px;
    background: #98add2;
    box-shadow: 0 10px 24px rgba(21, 34, 54, 0.12);
    overflow: hidden;
}
.site-title {
    margin: 0;
    padding: 20px 12px;
    text-align: center;
    font-size: 56px;
    font-weight: 800;
    letter-spacing: 1px;
}
.site-nav {
    background: #0e0e0f;
    border-radius: 18px;
    margin: 0 16px 16px;
    padding: 10px 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 14px;
}
.site-nav ul {
    margin: 0;
    padding: 0;
    list-style: none;
    display: flex;
    gap: 30px;
}
.site-nav a {
    color: #ffffff;
    text-decoration: none;
    font-size: 31px;
    font-weight: 700;
}
.site-nav .search {
    width: 180px;
    border: 0;
    border-radius: 999px;
    padding: 8px 12px;
    font-size: 22px;
}
.site-footer {
    width: 100%;
    max-width: 1120px;
    margin: 0 auto 18px;
    border-radius: 12px;
    background: #0e0e0f;
    color: #ffffff;
    text-align: center;
    padding: 14px 16px;
    font-size: 24px;
    font-weight: 500;
}
.auth-card {
    width: min(980px, 100%);
    min-height: 620px;
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 24px 64px rgba(15, 23, 42, 0.16);
    display: grid;
    grid-template-columns: 1.08fr 1fr;
    overflow: hidden;
}
.auth-left {
    padding: 48px 52px;
    display: flex;
    flex-direction: column;
}
.brand {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-size: 31px;
    font-weight: 700;
}
.brand-badge {
    width: 34px;
    height: 34px;
    border-radius: 10px;
    background: linear-gradient(145deg, #ff5a4d, #d51717);
    display: grid;
    place-items: center;
    color: #ffffff;
    font-size: 18px;
    box-shadow: 0 8px 20px rgba(213, 23, 23, 0.35);
}
h1 {
    margin: 24px 0 8px;
    font-size: 40px;
    line-height: 1.1;
}
.subtitle {
    margin: 0 0 22px;
    color: #6d7683;
    font-size: 14px;
}
.social-row {
    display: flex;
    gap: 12px;
    margin-bottom: 18px;
}
.social-btn {
    flex: 1;
    border: 1px solid #e7e8eb;
    border-radius: 999px;
    background: #fbfbfc;
    color: #2f3540;
    font-size: 13px;
    font-weight: 600;
    padding: 11px 10px;
}
.divider {
    display: flex;
    align-items: center;
    gap: 12px;
    color: #8a9099;
    font-size: 12px;
    margin-bottom: 16px;
}
.divider:before, .divider:after {
    content: "";
    flex: 1;
    height: 1px;
    background: #eceef2;
}
.alert {
    border-radius: 12px;
    padding: 10px 12px;
    font-size: 13px;
    margin-bottom: 12px;
}
.alert-error { background: #fff0f0; color: #8b1313; border: 1px solid #ffd7d7; }
.alert-db { background: #fff3df; color: #874f00; border: 1px solid #ffd59a; }
.field {
    display: flex;
    align-items: center;
    border: 1px solid #e6e8ec;
    border-radius: 12px;
    background: #fafbfc;
    margin-bottom: 12px;
    padding: 0 12px;
}
.field input {
    width: 100%;
    border: 0;
    background: transparent;
    outline: none;
    padding: 14px 8px;
    font-size: 15px;
}
.type-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    margin: 8px 0 14px;
}
.type-grid label {
    border: 1px solid #e7e9ee;
    border-radius: 12px;
    text-align: center;
    padding: 9px 6px;
    font-size: 12px;
    font-weight: 700;
    color: #59606c;
    cursor: pointer;
}
.type-grid input {
    display: none;
}
.type-grid input:checked + span {
    color: #bb1111;
}
.type-grid label:has(input:checked) {
    border-color: #d61f1f;
    background: #fff3f3;
}
.row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 4px 0 20px;
    font-size: 13px;
    color: #6d7683;
}
.row a {
    color: #b91515;
    text-decoration: none;
    font-weight: 700;
}
.login-btn {
    width: 100%;
    border: 0;
    border-radius: 999px;
    background: linear-gradient(145deg, #ff4339, #c91515);
    color: #ffffff;
    font-size: 18px;
    font-weight: 800;
    letter-spacing: 0.2px;
    padding: 14px 18px;
    cursor: pointer;
    box-shadow: 0 10px 24px rgba(201, 21, 21, 0.35);
}
.signup {
    margin: 18px 0 0;
    text-align: center;
    font-size: 14px;
    color: #707782;
}
.signup a {
    color: #c21717;
    font-weight: 700;
    text-decoration: none;
}
.auth-right {
    background: linear-gradient(155deg, #ff3b34 0%, #e01b1b 45%, #9a0f0f 100%);
    color: #ffffff;
    position: relative;
    padding: 56px 42px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
}
.auth-right:before, .auth-right:after {
    content: "";
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.09);
}
.auth-right:before {
    width: 250px;
    height: 250px;
    top: -70px;
    right: -40px;
}
.auth-right:after {
    width: 180px;
    height: 180px;
    bottom: -45px;
    left: -30px;
}
.shield {
    width: 210px;
    height: 210px;
    border-radius: 28px;
    border: 1px solid rgba(255, 255, 255, 0.25);
    background: linear-gradient(145deg, rgba(255,255,255,0.2), rgba(255,255,255,0.06));
    box-shadow: inset 0 0 0 1px rgba(255,255,255,0.05), 0 24px 40px rgba(91, 8, 8, 0.35);
    display: grid;
    place-items: center;
    margin-bottom: 28px;
    position: relative;
    z-index: 2;
}
.shield-icon {
    width: 86px;
    height: 86px;
    border-radius: 22px;
    border: 1px solid rgba(255,255,255,0.3);
    display: grid;
    place-items: center;
    font-size: 34px;
}
.auth-right h2 {
    margin: 0 0 10px;
    font-size: 42px;
}
.auth-right p {
    margin: 0;
    font-size: 15px;
    line-height: 1.7;
    max-width: 320px;
    color: rgba(255,255,255,0.92);
}
@media (max-width: 940px) {
    .site-title {
        font-size: 34px;
    }
    .site-nav {
        flex-direction: column;
        align-items: stretch;
    }
    .site-nav ul {
        justify-content: center;
        gap: 18px;
        flex-wrap: wrap;
    }
    .site-nav a {
        font-size: 18px;
    }
    .site-nav .search {
        width: 100%;
        font-size: 15px;
    }
    .site-footer {
        font-size: 16px;
    }
    .auth-card {
        grid-template-columns: 1fr;
    }
    .auth-right {
        min-height: 300px;
        border-radius: 0;
    }
    .auth-left {
        padding: 36px 22px;
    }
    h1 { font-size: 32px; }
}
</style>
</head>
<body>
<header class="site-header">
    <h1 class="site-title">GYM MANAGEMENT SYSTEM</h1>
    <nav class="site-nav">
        <ul>
            <li><a href="index.php">HOME</a></li>
            <li><a href="aboutus.php">ABOUT US</a></li>
            <li><a href="services.php">SERVICES</a></li>
            <li><a href="login.php">LOGIN</a></li>
        </ul>
        <input class="search" type="text" placeholder="search Information">
    </nav>
</header>

<main class="page-main">
<div class="auth-card">
    <section class="auth-left">
        <div class="brand"><span class="brand-badge">F</span>GymFlow</div>
        <h1>Log in to your Account</h1>
        <p class="subtitle">Welcome back. Select your access type and continue.</p>

        <div class="social-row">
            <button type="button" class="social-btn">Sign In with Google</button>
            <button type="button" class="social-btn">Sign In with Apple</button>
        </div>
        <div class="divider">or continue with username</div>

        <?php if ($dbError !== '') { ?>
        <div class="alert alert-db"><?php echo htmlspecialchars($dbError); ?></div>
        <?php } ?>
        <?php if ($loginError !== '') { ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($loginError); ?></div>
        <?php } ?>

        <form action="" method="POST" name="login" autocomplete="off">
            <label class="field">
                <input type="text" name="user_name" placeholder="Username" required>
            </label>
            <label class="field">
                <input type="password" name="user_pass" placeholder="Password" required>
            </label>

            <div class="type-grid">
                <label><input type="radio" name="user_type" value="admin" <?php echo $userType === 'admin' ? 'checked' : ''; ?>><span>Admin</span></label>
                <label><input type="radio" name="user_type" value="trainer" <?php echo $userType === 'trainer' ? 'checked' : ''; ?>><span>Trainer</span></label>
                <label><input type="radio" name="user_type" value="user" <?php echo $userType === 'user' ? 'checked' : ''; ?>><span>User</span></label>
            </div>

            <div class="row">
                <label><input type="checkbox" name="remember_me"> Remember me</label>
                <a href="resetpassword.php">Forgot Password?</a>
            </div>

            <button type="submit" class="login-btn">Explore Now</button>
        </form>
        <p class="signup">Don't have an account? <a href="register.php">Sign Up</a></p>
    </section>

    <aside class="auth-right">
        <div class="shield"><div class="shield-icon">S</div></div>
        <h2>Ironclad Access Core</h2>
        <p>Enterprise-grade login for admin, trainers, and members backed by a secure PostgreSQL workflow.</p>
    </aside>
</div>
</main>

<footer class="site-footer">
Nikam Varuna
</footer>
</body>
</html>

