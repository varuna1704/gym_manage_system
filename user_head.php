<?php
$page_title = isset($page_title) ? $page_title : 'Trainer Portal | Gym Management System';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo htmlspecialchars($page_title); ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="app_shell.css">
</head>
<body>
<div class="page">
    <header class="site-header">
        <h1 class="site-title">GYM MANAGEMENT SYSTEM</h1>
        <nav class="site-nav">
            <ul>
                <li><a href="trainer_index.php">TRAINER HOME</a></li>
                <li><a href="batch.php">BATCHES</a></li>
                <li><a href="equipment.php">EQUIPMENTS</a></li>
                <li><a href="logout.php">LOG OUT</a></li>
            </ul>
            <input class="search" type="text" placeholder="Search Information">
        </nav>
    </header>
    <main class="page-main">
        <div class="fit-wrap">
            <div class="content-surface">
