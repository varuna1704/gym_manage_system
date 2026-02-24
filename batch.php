<?php
$page_title = 'Batches | Gym Management System';
include 'user_head.php';
include_once 'pg_con.php';

$maleRows = array();
$femaleRows = array();
$dbError = '';

if (!$con) {
    $dbError = 'Database connection failed. Please verify PostgreSQL settings.';
} else {
    $query = "SELECT user_name, user_email, contact_no, user_add, user_gender FROM users ORDER BY user_name";
    $result = pg_query($con, $query);

    if ($result) {
        while ($row = pg_fetch_assoc($result)) {
            if (strtolower($row['user_gender']) === 'male') {
                $maleRows[] = $row;
            } else if (strtolower($row['user_gender']) === 'female') {
                $femaleRows[] = $row;
            }
        }
    } else {
        $dbError = 'Unable to load batch data.';
    }
}
?>
<section class="info-block">
    <h2 class="surface-title">Member Batches</h2>
    <p class="surface-note">Male and female member groups.</p>
</section>
<?php if ($dbError !== '') { ?>
<div class="form-msg error"><?php echo htmlspecialchars($dbError); ?></div>
<?php } ?>
<div class="hero-grid" style="margin-top: 10px;">
    <section class="data-block">
        <h3>Male Batch</h3>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (count($maleRows) === 0) { ?>
                    <tr><td colspan="4">No male members found.</td></tr>
                <?php } else { ?>
                    <?php foreach ($maleRows as $row) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_email']); ?></td>
                        <td><?php echo htmlspecialchars($row['contact_no']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_add']); ?></td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
    <section class="data-block">
        <h3>Female Batch</h3>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (count($femaleRows) === 0) { ?>
                    <tr><td colspan="4">No female members found.</td></tr>
                <?php } else { ?>
                    <?php foreach ($femaleRows as $row) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_email']); ?></td>
                        <td><?php echo htmlspecialchars($row['contact_no']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_add']); ?></td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
<?php include 'user_footer.php'; ?>
