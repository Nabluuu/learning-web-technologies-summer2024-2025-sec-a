<?php
$meals = $controller->handleRequest();

foreach ($meals as $i => $meal) {
    if (is_string($meal)) {
        $parts = explode("|", $meal);
        $meals[$i] = [
            "name" => $parts[0] ?? "",
            "C"    => $parts[1] ?? 0,
            "P"    => $parts[2] ?? 0,
            "F"    => $parts[3] ?? 0
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nutrition Logger</title>
  <link rel="stylesheet" href="view/style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

  <div class="navbar">
    <a href="view/NutrationLog.php">Nutrition Logger</a>
    <a href="view/WaterIntake.php">Water Intake</a>
    <a href="view/WorkoutList.php">Workout List</a>
</div>

  <header>
    <h1>Nutrition Logger</h1>
  </header>
 
  <nav>
    <button onclick="showScreen('diary')">Food Diary</button>
    <button onclick="showScreen('scanner')">Barcode Scanner</button>
    <button onclick="showScreen('dashboard')">Macro Dashboard</button>
  </nav>

  <div id="diary" class="screen active">
    <h2>Food Diary</h2>
    <form method="POST">
      <input type="text" id="foodName" name="foodName" placeholder="Food name" required>
      <input type="number" id="carbs" name="carbs" placeholder="Carbs (g)" required>
      <input type="number" id="protein" name="protein" placeholder="Protein (g)" required>
      <input type="number" id="fat" name="fat" placeholder="Fat (g)" required>
      <button type="submit">Add</button>
    </form>
    
    <div class="meal-list" id="mealList">
      <?php foreach($meals as $i => $meal){ ?>
        <div class="meal-item">
          <?php echo htmlspecialchars($meal["name"]); ?>
          (C:<?php echo (int)$meal["C"]; ?>/P:<?php echo (int)$meal["P"]; ?>/F:<?php echo (int)$meal["F"]; ?>)
          <form method="POST" style="display:inline;">
            <input type="hidden" name="delete" value="<?php echo $i; ?>">
            <button class="delete-btn">X</button>
          </form>
        </div>
      <?php } ?>
    </div>
  </div>


  <div id="scanner" class="screen">
    <h2>Barcode Scanner</h2>
    <input type="text" id="barcodeInput" placeholder="Enter barcode">
    <button onclick="scanBarcode()">Scan</button>
    <div id="scanResult"></div>
  </div>

  
  <div id="dashboard" class="screen">
    <h2>Macro Dashboard</h2>
    <canvas id="macroChart" width="400" height="400"></canvas>
  </div>



  <?php foreach($meals as $meal){ ?>
    <input type="hidden" class="meal-data"
           data-c="<?php echo (int)$meal["C"]; ?>"
           data-p="<?php echo (int)$meal["P"]; ?>"
           data-f="<?php echo (int)$meal["F"]; ?>">
  <?php } ?>

<script src="view/script.js"></script>
</body>
</html>
