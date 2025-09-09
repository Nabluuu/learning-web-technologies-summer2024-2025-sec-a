<?php
session_start();

class MealModel {
    public function __construct() {
        if (!isset($_SESSION["meals"])) {
            $_SESSION["meals"] = [];
        }
    }

    public function getMeals() {
        return $_SESSION["meals"];
    }

    public function addMeal($name, $c, $p, $f) {
        $_SESSION["meals"][] = [
            "name" => $name,
            "C"    => $c,
            "P"    => $p,
            "F"    => $f
        ];
    }

    public function deleteMeal($index) {
        if (isset($_SESSION["meals"][$index])) {
            unset($_SESSION["meals"][$index]);
            $_SESSION["meals"] = array_values($_SESSION["meals"]);
        }
    }
}
