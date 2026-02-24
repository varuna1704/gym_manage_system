<?php
$page_title = 'Equipments | Gym Management System';
include 'user_head.php';
include 'pg_con.php';

$rows = array();
$dbError = '';

if (!$con) {
    $dbError = 'Database connection failed. Please verify PostgreSQL settings.';
} else {
    $query = 'SELECT eq_name, eq_img, eq_info FROM equipment ORDER BY eq_id';
    $res = pg_query($con, $query);

    if ($res) {
        while ($row = pg_fetch_assoc($res)) {
            $imageName = '';
            if (!empty($row['eq_img'])) {
                $imageName = trim(pg_unescape_bytea($row['eq_img']));
            }

            $rows[] = array(
                'eq_name' => $row['eq_name'],
                'eq_info' => $row['eq_info'],
                'eq_img' => $imageName
            );
        }
    } else {
        $dbError = 'Unable to load equipment records.';
    }
}
?>
<section class="info-block">
    <h2 class="surface-title">Equipment Directory</h2>
    <p class="surface-note">Reference list of available gym equipment.</p>
</section>
<?php if ($dbError !== '') { ?>
<div class="form-msg error"><?php echo htmlspecialchars($dbError); ?></div>
<?php } ?>
<section class="data-block" style="margin-top: 10px;">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width: 20%;">Equipment</th>
                    <th style="width: 58%;">Information</th>
                    <th style="width: 22%;">Image</th>
                </tr>
            </thead>
            <tbody>
            <?php if (count($rows) === 0) { ?>
                <tr><td colspan="3">No equipment records found.</td></tr>
            <?php } else { ?>
                <?php foreach ($rows as $row) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['eq_name']); ?></td>
                    <td><?php echo nl2br(htmlspecialchars($row['eq_info'])); ?></td>
                    <td>
                        <?php if ($row['eq_img'] !== '' && file_exists($row['eq_img'])) { ?>
                        <img class="table-image" src="<?php echo htmlspecialchars($row['eq_img']); ?>" alt="Equipment image">
                        <?php } else { ?>
                        <span>Image not found</span>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    </div>
</section>
<?php include 'user_footer.php'; ?>
