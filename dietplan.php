<?php
$page_title = 'Diet Plan | Gym Management System';
include 'user_head1.php';
include 'pg_con.php';

$rows = array();
$dbError = '';
$weightInput = isset($_POST['weight_kg']) ? trim($_POST['weight_kg']) : '';
$weightError = '';
$selectedPlan = null;

$weightPlans = array(
    array('min' => 40, 'max' => 45, 'range' => '40-45 kg', 'goal' => 'Healthy Weight Gain', 'calories' => '1800-1950 kcal', 'protein' => '85-95 g', 'focus' => 'More complex carbs with lean protein', 'meals' => array('Breakfast: oats + milk + 2 egg whites + 1 banana', 'Lunch: rice + dal + paneer/chicken + salad', 'Snack: peanut chikki + fruit', 'Dinner: chapati + mixed vegetables + curd')),
    array('min' => 46, 'max' => 50, 'range' => '46-50 kg', 'goal' => 'Lean Muscle Gain', 'calories' => '1950-2100 kcal', 'protein' => '95-105 g', 'focus' => 'Balanced carb and protein timing', 'meals' => array('Breakfast: poha/upma + 3 egg whites', 'Lunch: 2 chapati + chicken/fish + sprouts', 'Snack: whey + almonds', 'Dinner: brown rice + vegetables + curd')),
    array('min' => 51, 'max' => 55, 'range' => '51-55 kg', 'goal' => 'Muscle Build', 'calories' => '2100-2250 kcal', 'protein' => '105-115 g', 'focus' => 'High protein across 4-5 meals', 'meals' => array('Breakfast: paneer sandwich + milk', 'Lunch: 2 chapati + dal + chicken/fish', 'Snack: fruit + roasted chana', 'Dinner: quinoa/rice + veggies + eggs')),
    array('min' => 56, 'max' => 60, 'range' => '56-60 kg', 'goal' => 'Recomposition', 'calories' => '2200-2350 kcal', 'protein' => '115-125 g', 'focus' => 'Muscle gain with controlled fats', 'meals' => array('Breakfast: oats + seeds + egg whites', 'Lunch: brown rice + dal + grilled chicken', 'Snack: buttermilk + nuts', 'Dinner: chapati + paneer + salad')),
    array('min' => 61, 'max' => 65, 'range' => '61-65 kg', 'goal' => 'Maintain + Strength', 'calories' => '2300-2450 kcal', 'protein' => '125-135 g', 'focus' => 'Steady strength nutrition', 'meals' => array('Breakfast: idli + sambar + eggs', 'Lunch: rice + fish/chicken + vegetables', 'Snack: whey + banana', 'Dinner: chapati + dal + curd')),
    array('min' => 66, 'max' => 70, 'range' => '66-70 kg', 'goal' => 'Fat Loss Start', 'calories' => '2100-2250 kcal', 'protein' => '130-140 g', 'focus' => 'Lower sugar, higher protein', 'meals' => array('Breakfast: omelet + oats', 'Lunch: grilled chicken + salad + 1 chapati', 'Snack: green tea + almonds', 'Dinner: paneer/tofu + sauteed vegetables')),
    array('min' => 71, 'max' => 75, 'range' => '71-75 kg', 'goal' => 'Fat Loss + Muscle Hold', 'calories' => '2000-2150 kcal', 'protein' => '135-145 g', 'focus' => 'Calorie deficit with protein priority', 'meals' => array('Breakfast: sprouts + eggs', 'Lunch: dal + chicken + salad', 'Snack: curd + flaxseed', 'Dinner: fish/paneer + soup + vegetables')),
    array('min' => 76, 'max' => 80, 'range' => '76-80 kg', 'goal' => 'Cutting Phase', 'calories' => '1900-2050 kcal', 'protein' => '140-155 g', 'focus' => 'Controlled carbs around workout', 'meals' => array('Breakfast: oats + egg whites', 'Lunch: 1 cup rice + chicken + salad', 'Snack: whey + walnuts', 'Dinner: tofu/paneer + mixed vegetables')),
    array('min' => 81, 'max' => 90, 'range' => '81-90 kg', 'goal' => 'Aggressive Fat Loss', 'calories' => '1800-2000 kcal', 'protein' => '150-165 g', 'focus' => 'High protein, high fiber, low refined carbs', 'meals' => array('Breakfast: eggs + sauteed veggies', 'Lunch: grilled fish/chicken + greens', 'Snack: cucumber + buttermilk', 'Dinner: paneer/chicken soup + salad')),
    array('min' => 91, 'max' => 120, 'range' => '91-120 kg', 'goal' => 'Medical-Safe Fat Loss', 'calories' => '1700-1900 kcal', 'protein' => '160-180 g', 'focus' => 'Strict portions, hydration, walking/cardio support', 'meals' => array('Breakfast: high-protein smoothie + seeds', 'Lunch: lean protein + vegetables', 'Snack: roasted chana + lemon water', 'Dinner: light protein + soup + salad'))
);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['weight_kg'])) {
    if ($weightInput === '' || !is_numeric($weightInput)) {
        $weightError = 'Please enter a valid weight in kilograms.';
    } else {
        $weightValue = (float)$weightInput;
        if ($weightValue < 40 || $weightValue > 120) {
            $weightError = 'Supported range is 40 kg to 120 kg.';
        } else {
            foreach ($weightPlans as $plan) {
                if ($weightValue >= $plan['min'] && $weightValue <= $plan['max']) {
                    $selectedPlan = $plan;
                    break;
                }
            }
        }
    }
}

if (!$con) {
    $dbError = 'Database connection failed. Please verify PostgreSQL settings.';
} else {
    $result = false;
    $queryOptions = array(
        'SELECT diet_time, diet_meal, diet_food FROM dietplan ORDER BY dietplan_id',
        'SELECT diet_time, diet_meal, diet_food FROM dietplan ORDER BY diet_id',
        'SELECT diet_time, diet_meal, diet_food FROM dietplan'
    );

    foreach ($queryOptions as $query) {
        $result = @pg_query($con, $query);
        if ($result) {
            break;
        }
    }

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
    <h3>Weight Based Diet Planner (10 Plans)</h3>
    <p class="surface-note">Enter your weight to get a recommended plan.</p>
    <form method="POST" action="" autocomplete="off" class="form-grid" style="grid-template-columns: 220px auto; max-width: 460px;">
        <label class="field">
            <span>Weight (kg)</span>
            <input type="number" step="0.1" min="40" max="120" name="weight_kg" value="<?php echo htmlspecialchars($weightInput); ?>" placeholder="e.g. 68" required>
        </label>
        <div class="field" style="align-self: end;">
            <button type="submit" class="primary-btn" style="border: 0; cursor: pointer;">Get Plan</button>
        </div>
    </form>
    <?php if ($weightError !== '') { ?>
    <div class="form-msg error" style="margin-top: 10px;"><?php echo htmlspecialchars($weightError); ?></div>
    <?php } ?>
    <?php if ($selectedPlan !== null) { ?>
    <div class="card" style="margin-top: 10px; background: #ffffff;">
        <h3>Recommended Plan: <?php echo htmlspecialchars($selectedPlan['range']); ?></h3>
        <p><strong>Goal:</strong> <?php echo htmlspecialchars($selectedPlan['goal']); ?></p>
        <p><strong>Daily Calories:</strong> <?php echo htmlspecialchars($selectedPlan['calories']); ?> | <strong>Protein:</strong> <?php echo htmlspecialchars($selectedPlan['protein']); ?></p>
        <p><strong>Focus:</strong> <?php echo htmlspecialchars($selectedPlan['focus']); ?></p>
        <ul class="clean-list" style="margin-top: 8px;">
            <?php foreach ($selectedPlan['meals'] as $meal) { ?>
            <li><?php echo htmlspecialchars($meal); ?></li>
            <?php } ?>
        </ul>
    </div>
    <?php } ?>
</section>
<section class="data-block" style="margin-top: 10px;">
    <h3>All 10 Weight Plans</h3>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width: 14%;">Weight</th>
                    <th style="width: 22%;">Goal</th>
                    <th style="width: 18%;">Calories</th>
                    <th style="width: 16%;">Protein</th>
                    <th style="width: 30%;">Focus</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($weightPlans as $plan) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($plan['range']); ?></td>
                    <td><?php echo htmlspecialchars($plan['goal']); ?></td>
                    <td><?php echo htmlspecialchars($plan['calories']); ?></td>
                    <td><?php echo htmlspecialchars($plan['protein']); ?></td>
                    <td><?php echo htmlspecialchars($plan['focus']); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</section>
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
