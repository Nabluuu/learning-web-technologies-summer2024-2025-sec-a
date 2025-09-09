<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Water Intake</title>
<style>
body { font-family: Arial,sans-serif; background:#e0f7fa; display:flex; justify-content:center; align-items:flex-start; padding-top:50px; margin:0; }
.container { width:400px; background:#fff; padding:25px; border-radius:10px; box-shadow:2px 2px 12px rgba(0,0,0,0.1); }
h2,h3 { text-align:center; color:#00796b; }
button { padding:12px 20px; font-size:16px; background:#00796b; color:white; border:none; border-radius:6px; cursor:pointer; margin:5px; }
input[type=number] { width:80px; padding:8px; font-size:16px; margin-left:10px; }
.navbar { display:flex; gap:25px; padding:15px 80px; background:rgba(139,176,179,0.85); position:fixed; top:0; width:100%; z-index:10; backdrop-filter:blur(4px); }
.navbar a { color:#00796b; text-decoration:none; font-weight:bold; transition:0.3s; }
.navbar a:hover { color:#a3d8ff; }
.history { margin-top:20px; }
.history p { margin:2px 0; }
</style>
</head>

<body>
  <div class="navbar">
    <a href="view/NutrationLog.php">Nutrition Logger</a>
    <a href="view/WaterIntake.php">Water Intake</a>
    <a href="view/WorkoutList.php">Workout List</a>
</div>

  <header>
    <h1>Water Intake</h1>
  </header>

<div class="container">
  <h2>Water Intake Tracker</h2>

  <?php 
  
  if(!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

  <p>Glasses Today: <strong><?php echo $glasses; ?></strong> / <strong><?php echo $goal; ?></strong></p>

  <form method="POST">
    <button type="submit" name="addGlass">+1 Glass</button>
  </form>

  <h3>Set Daily Goal</h3>
  <form method="POST">
    <input type="number" name="goal" value="<?php echo $goal; ?>" min="1">
    <button type="submit" name="setGoal">Set Goal</button>
  </form>

  <h3>Set Reminder</h3>
  <form method="POST">
    <input type="number" name="reminderInterval" value="<?php echo $reminder ?: 60; ?>" min="1">
    <button type="submit" name="setReminder">Start Reminder</button>
  </form>

  <form method="POST">
    <button type="submit" name="endSession">End Day Session</button>
  </form>

  <div class="history">
    <h3>History</h3>
    <?php
      foreach($history as $day => $data){
          echo "<p>$day: {$data['glasses']} glasses (Goal: {$data['goal']})</p>";
      }
    ?>
  </div>
</div>

</body>
</html>
