<?php
$page_title = 'Home | Gym Management System';
include 'user_header.php';
?>
<div class="hero-grid">
    <section class="info-block">
        <h2 class="surface-title">Build A Stronger Routine</h2>
        <p class="surface-note">Track training, nutrition, and member operations in one clean workflow.</p>
        <a class="primary-btn" href="dashboard.php">Open Dashboard</a>
    </section>
    <aside class="stats-block">
        <h3>Quick Access</h3>
        <ul class="clean-list">
            <li>Trainer schedules and batch grouping</li>
            <li>Equipment and gym floor overview</li>
            <li>Diet and payment modules</li>
        </ul>
    </aside>
</div>
<div class="card-grid" style="margin-top: 10px;">
    <article class="card">
        <h3>Trainer Batches</h3>
        <p>View members grouped by male and female batches.</p>
        <a class="quick-link" href="batch.php" style="margin-top: 10px;">Open Batches</a>
    </article>
    <article class="card">
        <h3>Equipments</h3>
        <p>Review available gym equipments with details and images.</p>
        <a class="quick-link" href="equipment.php" style="margin-top: 10px;">Open Equipments</a>
    </article>
    <article class="card">
        <h3>Diet Plans</h3>
        <p>Open daily structured diet plans for members.</p>
        <a class="quick-link" href="dietplan.php" style="margin-top: 10px;">Open Diet</a>
    </article>
</div>
<?php include 'user_footer.php'; ?>
