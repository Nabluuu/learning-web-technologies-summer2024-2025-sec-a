<?php
if(!isset($_COOKIE['meal_count'])){
    setcookie('meal_count', 0, time()+3600, "/"); 
    $_COOKIE['meal_count'] = 0;
}

$errors = [];
$success = "";
$meal_name = "";
$carbs = "";
$protein = "";
$fat = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $meal_name = trim($_REQUEST['foodName']);
    $carbs     = $_REQUEST['carbs'];
    $protein   = $_REQUEST['protein'];
    $fat       = $_REQUEST['fat'];

    if ($meal_name == "") {
        $errors['foodName'] = "Food name is required.";
    }
    if ($carbs === "" || !is_numeric($carbs)) {
        $errors['carbs'] = "Carbs must be a number.";
    }
    if ($protein === "" || !is_numeric($protein)) {
        $errors['protein'] = "Protein must be a number.";
    }
    if ($fat === "" || !is_numeric($fat)) {
        $errors['fat'] = "Fat must be a number.";
    }

    $total = (int)$carbs + (int)$protein + (int)$fat;
    if ($total > 100) {
        $errors['carbs'] = "Total macros cannot exceed 100g.";
    }

    if (empty($errors)) {
        if ($_COOKIE['meal_count'] < 5) {
            $new_count = $_COOKIE['meal_count'] + 1;
            setcookie('meal_count', $new_count, time()+3600, "/");
            $_COOKIE['meal_count'] = $new_count;

            $success = "Meal '$meal_name' added successfully! (You added ".$_COOKIE['meal_count']." meals)";
        } else {
            $errors['limit'] = "You cannot add more than 5 meals in this session (cookie limit reached).";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Nutrition Logger (PHP + Cookie)</title>
  <style>
    body { font-family: Arial, sans-serif; background:#f5f5f5; padding:20px; }
    .error { color:red; font-size:0.9em; }
    .success { color:green; font-weight:bold; }
  </style>
</head>
<body>

<h1>Nutrition Logger (PHP Validation + Cookie)</h1>

<form method="post" action="">
    <label>Food Name:</label><br>
    <input type="text" name="foodName" value="<?php echo htmlspecialchars($meal_name); ?>"><br>
    <span class="error"><?php echo $errors['foodName'] ?? ''; ?></span><br><br>

    <label>Carbs (g):</label><br>
    <input type="number" name="carbs" value="<?php echo htmlspecialchars($carbs); ?>"><br>
    <span class="error"><?php echo $errors['carbs'] ?? ''; ?></span><br><br>

    <label>Protein (g):</label><br>
    <input type="number" name="protein" value="<?php echo htmlspecialchars($protein); ?>"><br>
    <span class="error"><?php echo $errors['protein'] ?? ''; ?></span><br><br>

    <label>Fat (g):</label><br>
    <input type="number" name="fat" value="<?php echo htmlspecialchars($fat); ?>"><br>
    <span class="error"><?php echo $errors['fat'] ?? ''; ?></span><br><br>

    <button type="submit">Add Meal</button>
</form>

<br>
<div class="success"><?php echo $success; ?></div>
<div class="error"><?php echo $errors['limit'] ?? ''; ?></div>

<p><strong>Meals added so far (cookie):</strong> <?php echo $_COOKIE['meal_count']; ?></p>

</body>
</html>
