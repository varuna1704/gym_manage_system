<?php
$page_title = 'Diet Plan | Gym Management System';
include 'user_head1.php';
include 'pg_con.php';

$rows = array();
$dbError = '';

if (!$con) {
    $dbError = 'Database connection failed. Please verify PostgreSQL settings.';
} else {
    $query = 'SELECT diet_time, diet_meal, diet_food FROM dietplan ORDER BY diet_id';
    $result = pg_query($con, $query);

    if ($result) {
        while ($row = pg_fetch_assoc($result)) {
            $rows[] = $row;
        }
    } else {
        $dbError = 'Unable to load diet plan.';
    }
}
?>
<section class="info-block">
    <h2 class="surface-title">Diet Plan</h2>
    <p class="surface-note">Structured meal timing for daily routine.</p>
</section>
<?php if ($dbError !== '') { ?>
<div class="form-msg error"><?php echo htmlspecialchars($dbError); ?></div>
<?php } ?>
<section class="data-block" style="margin-top: 10px;">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width: 20%;">Time</th>
                    <th style="width: 22%;">Meal</th>
                    <th style="width: 58%;">Food Items</th>
                </tr>
            </thead>
            <tbody>
            <?php if (count($rows) === 0) { ?>
                <tr><td colspan="3">No diet records found.</td></tr>
            <?php } else { ?>
                <?php foreach ($rows as $row) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['diet_time']); ?></td>
                    <td><?php echo htmlspecialchars($row['diet_meal']); ?></td>
                    <td><?php echo htmlspecialchars($row['diet_food']); ?></td>
                </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    </div>
</section>
<div class="card-grid" style="margin-top: 10px; grid-template-columns: repeat(2, minmax(0, 1fr));">
    <article class="card"><h3>Before Workout</h3><p>2 bananas or 1 apple.</p></article>
    <article class="card"><h3>After Workout</h3><p>2 scoops gainer with water.</p></article>
</div>
<?php include 'user_foot.php'; ?>
