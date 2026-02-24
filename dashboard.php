<?php
$page_title = 'Dashboard | Gym Management System';
include 'user_header.php';
include 'pg_con.php';

$dbError = '';
$stats = array(
    array('label' => 'Admins', 'count' => null, 'href' => 'admin/login.php'),
    array('label' => 'Trainers', 'count' => null, 'href' => 'trainer_index.php'),
    array('label' => 'Users', 'count' => null, 'href' => 'user_index.php'),
    array('label' => 'Equipments', 'count' => null, 'href' => 'equipment.php'),
    array('label' => 'Diet Plans', 'count' => null, 'href' => 'dietplan.php'),
    array('label' => 'Payments', 'count' => null, 'href' => 'payment.php')
);
$recentUsers = array();
$recentBills = array();

function count_rows_with_fallback($con, $queries) {
    foreach ($queries as $query) {
        $result = @pg_query($con, $query);
        if (!$result) {
            continue;
        }
        $row = pg_fetch_assoc($result);
        if ($row && isset($row['total'])) {
            return (int)$row['total'];
        }
    }
    return null;
}

if (!$con) {
    $dbError = 'Database connection failed. Please verify PostgreSQL settings.';
} else {
    $stats[0]['count'] = count_rows_with_fallback($con, array(
        'SELECT COUNT(*) AS total FROM admin'
    ));
    $stats[1]['count'] = count_rows_with_fallback($con, array(
        'SELECT COUNT(*) AS total FROM trainers'
    ));
    $stats[2]['count'] = count_rows_with_fallback($con, array(
        'SELECT COUNT(*) AS total FROM users'
    ));
    $stats[3]['count'] = count_rows_with_fallback($con, array(
        "SELECT COUNT(DISTINCT LOWER(TRIM(eq_name)) || '|' || COALESCE(eq_info, '')) AS total FROM equipment",
        'SELECT COUNT(*) AS total FROM equipment'
    ));
    $stats[4]['count'] = count_rows_with_fallback($con, array(
        'SELECT COUNT(*) AS total FROM dietplan'
    ));
    $stats[5]['count'] = count_rows_with_fallback($con, array(
        'SELECT COUNT(*) AS total FROM bills'
    ));

    $userResult = @pg_query($con, 'SELECT user_name, user_email, user_city FROM users ORDER BY user_id DESC LIMIT 5');
    if ($userResult) {
        while ($row = pg_fetch_assoc($userResult)) {
            $recentUsers[] = $row;
        }
    }

    $billResult = @pg_query($con, 'SELECT user_name, joindate, expirydate, fees FROM bills ORDER BY bill_id DESC LIMIT 5');
    if ($billResult) {
        while ($row = pg_fetch_assoc($billResult)) {
            $recentBills[] = $row;
        }
    }
}
?>
<style>
.stat-grid {
    display: grid;
    grid-template-columns: repeat(6, minmax(0, 1fr));
    gap: 10px;
}
.stat-card {
    display: block;
    text-decoration: none;
    border: 1px solid var(--line);
    border-radius: 12px;
    background: #f8fafc;
    padding: 12px;
    transition: transform 0.15s ease, box-shadow 0.15s ease;
}
.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(15, 23, 42, 0.12);
}
.stat-card h3 {
    margin: 0 0 6px;
    font-size: 13px;
    color: #1f2937;
}
.stat-value {
    margin: 0;
    font-size: 24px;
    font-weight: 800;
    color: #111827;
}
.quick-grid {
    margin-top: 10px;
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 10px;
}
@media (max-width: 1150px) {
    .stat-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    .quick-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}
@media (max-width: 740px) {
    .stat-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .quick-grid { grid-template-columns: 1fr; }
}
</style>

<section class="info-block">
    <h2 class="surface-title">System Dashboard</h2>
    <p class="surface-note">Overview of members, trainers, plans, payments, and quick navigation.</p>
</section>

<?php if ($dbError !== '') { ?>
<div class="form-msg error"><?php echo htmlspecialchars($dbError); ?></div>
<?php } ?>

<section class="stat-grid" style="margin-top: 10px;">
    <?php foreach ($stats as $item) { ?>
    <a class="stat-card" href="<?php echo htmlspecialchars($item['href']); ?>">
        <h3><?php echo htmlspecialchars($item['label']); ?></h3>
        <p class="stat-value"><?php echo $item['count'] === null ? '-' : htmlspecialchars((string)$item['count']); ?></p>
    </a>
    <?php } ?>
</section>

<section class="quick-grid">
    <a class="primary-btn" href="register.php">Create Account</a>
    <a class="secondary-btn" href="batch.php">Manage Batches</a>
    <a class="secondary-btn" href="equipment.php">View Equipments</a>
    <a class="secondary-btn" href="dietplan.php">View Diet Plan</a>
    <a class="secondary-btn" href="payment.php">Open Payments</a>
    <a class="secondary-btn" href="trainer_index.php">Trainer Panel</a>
    <a class="secondary-btn" href="user_index.php">Member Panel</a>
    <a class="secondary-btn" href="services.php">Support</a>
</section>

<div class="hero-grid" style="margin-top: 10px;">
    <section class="data-block">
        <h3>Recent Users</h3>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>City</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (count($recentUsers) === 0) { ?>
                    <tr><td colspan="3">No user records available.</td></tr>
                <?php } else { ?>
                    <?php foreach ($recentUsers as $row) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_email']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_city']); ?></td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="data-block">
        <h3>Recent Payments</h3>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Join Date</th>
                        <th>Expiry</th>
                        <th>Fees</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (count($recentBills) === 0) { ?>
                    <tr><td colspan="4">No payment records available.</td></tr>
                <?php } else { ?>
                    <?php foreach ($recentBills as $row) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['joindate']); ?></td>
                        <td><?php echo htmlspecialchars($row['expirydate']); ?></td>
                        <td><?php echo htmlspecialchars($row['fees']); ?></td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<?php include 'user_footer.php'; ?>
