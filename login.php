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
:root {
    --bgA: #eef2f7;
    --bgB: #dbe3ee;
    --panel: #ffffff;
    --dark: #0b1220;
    --text: #111827;
    --muted: #64748b;
    --line: #e5e7eb;
    --accentA: #ef4444;
    --accentB: #991b1b;
}
* { box-sizing: border-box; }
html, body {
    height: 100%;
    margin: 0;
    overflow: hidden;
    font-family: "Plus Jakarta Sans", "Segoe UI", sans-serif;
    color: var(--text);
}
body {
    background: radial-gradient(circle at 20% 20%, var(--bgA), var(--bgB));
}
.page {
    height: 100vh;
    display: grid;
    grid-template-rows: auto 1fr auto;
}
.site-header,
.site-footer,
.page-main {
    width: min(1140px, 100%);
    margin: 0 auto;
}
.site-header {
    margin-top: 8px;
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
.site-nav ul {
    margin: 0;
    padding: 0;
    list-style: none;
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
}
.site-nav a {
    color: #fff;
    text-decoration: none;
    font-size: 13px;
    font-weight: 700;
}
.site-nav .search {
    width: 160px;
    max-width: 45%;
    border: 0;
    border-radius: 999px;
    padding: 6px 10px;
    font-size: 12px;
}
.page-main {
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
    height: min(540px, 100%);
    background: var(--panel);
    border-radius: 16px;
    box-shadow: 0 20px 46px rgba(15, 23, 42, 0.16);
    display: grid;
    grid-template-columns: 1.06fr 0.94fr;
    overflow: hidden;
    transform: scale(var(--card-scale));
    transform-origin: center center;
    will-change: transform;
}
.auth-left {
    padding: 20px 22px;
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
    margin: 12px 0 6px;
    font-size: clamp(22px, 2.2vw, 34px);
    line-height: 1.1;
}
.subtitle {
    margin: 0 0 12px;
    color: var(--muted);
    font-size: 12px;
}
.social-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
    margin-bottom: 10px;
}
.social-btn {
    border: 1px solid var(--line);
    border-radius: 999px;
    background: #f8fafc;
    color: #334155;
    font-size: 12px;
    font-weight: 700;
    padding: 8px;
}
.divider {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #8a9099;
    font-size: 11px;
    margin-bottom: 10px;
}
.divider:before,
.divider:after {
    content: "";
    flex: 1;
    height: 1px;
    background: #eceef2;
}
.alert {
    border-radius: 10px;
    padding: 8px 10px;
    font-size: 12px;
    margin-bottom: 8px;
}
.alert-error { background: #fff0f0; color: #8b1313; border: 1px solid #ffd7d7; }
.alert-db { background: #fff3df; color: #874f00; border: 1px solid #ffd59a; }
.field {
    display: flex;
    align-items: center;
    border: 1px solid var(--line);
    border-radius: 10px;
    background: #fafbfc;
    margin-bottom: 8px;
    padding: 0 10px;
}
.field input {
    width: 100%;
    border: 0;
    background: transparent;
    outline: none;
    padding: 10px 6px;
    font-size: 13px;
}
.type-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
    margin: 2px 0 10px;
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
.row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 0 0 10px;
    font-size: 11px;
    color: var(--muted);
}
.row a {
    color: #b91515;
    text-decoration: none;
    font-weight: 800;
}
.login-btn {
    width: 100%;
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
.signup {
    margin: 10px 0 0;
    text-align: center;
    font-size: 12px;
    color: #707782;
}
.signup a {
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
    width: 170px;
    height: 170px;
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
.auth-right h2 {
    margin: 0 0 8px;
    font-size: clamp(24px, 2.2vw, 34px);
}
.auth-right p {
    margin: 0;
    font-size: 13px;
    line-height: 1.6;
    max-width: 320px;
}
.site-footer {
    margin: 0 auto 8px;
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
    .auth-card { grid-template-columns: 1fr; height: min(510px, 100%); }
}
@media (max-height: 760px) {
    .site-title { font-size: clamp(18px, 2vw, 30px); }
}
@media (max-height: 700px) {
    .site-header { margin-top: 4px; }
    .site-title { padding: 8px; }
    .site-nav { padding: 6px 10px; margin: 0 8px 8px; }
    .site-footer { margin-bottom: 4px; padding: 8px 10px; }
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
