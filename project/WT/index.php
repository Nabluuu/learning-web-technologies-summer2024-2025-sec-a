<?php
session_start();
session_destroy();

require_once "model/meal_model.php";
require_once "controller/meal_controller.php";

$model = new MealModel();
$controller = new MealController($model);

include "view/NutrationLog.php";


