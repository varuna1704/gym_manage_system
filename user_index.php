<?php
$page_title = 'Member Home | Gym Management System';
include 'user_head1.php';
?>
<section class="info-block">
    <h2 class="surface-title">Member Dashboard</h2>
    <p class="surface-note">Access equipment, diet plan, and payment quickly.</p>
</section>
<div class="card-grid" style="margin-top: 10px;">
    <article class="card">
        <h3>Equipment</h3>
        <p>Browse gym equipment details and reference images.</p>
        <a class="quick-link" href="equipment.php" style="margin-top: 10px;">Open Equipment</a>
    </article>
    <article class="card">
        <h3>Diet Plan</h3>
        <p>Check your recommended meal distribution by time.</p>
        <a class="quick-link" href="dietplan.php" style="margin-top: 10px;">Open Diet Plan</a>
    </article>
    <article class="card">
        <h3>Payment</h3>
        <p>Submit or review your membership payment details.</p>
        <a class="quick-link" href="payment.php" style="margin-top: 10px;">Open Payment</a>
    </article>
</div>
<?php include 'user_foot.php'; ?>
