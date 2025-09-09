<?php
class MealController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function handleRequest() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST["delete"])) {
                $this->model->deleteMeal((int)$_POST["delete"]);
            } elseif (isset($_POST["foodName"])) {
                $name = htmlspecialchars(trim($_POST["foodName"]));
                $c = (int)$_POST["carbs"];
                $p = (int)$_POST["protein"];
                $f = (int)$_POST["fat"];

                if ($c + $p + $f <= 100) {
                    $this->model->addMeal($name, $c, $p, $f);
                }
            }
        }
        return $this->model->getMeals();
    }
}
