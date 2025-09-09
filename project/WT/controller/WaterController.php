<?php
require_once "/../model/WaterModel.php";

class WaterController {
    private $model;

    public function __construct() {
        $this->model = new WaterModel();
    }

    public function handleRequest() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Set goal
            if (isset($_POST['setGoal'])) {
                $goalInput = (int)($_POST['goal'] ?? 0);
                if ($this->model->validateGoal($goalInput)) {
                    $this->model->saveGoal($goalInput);
                } else {
                    $error = "Goal must be at least 1 glass!";
                }
            }

            if (isset($_POST['addGlass'])) {
                $count = $this->model->getTodayIntake() + 1;
                $this->model->saveIntake($count);
            }

            if (isset($_POST['setReminder'])) {
                $interval = (int)($_POST['reminderInterval'] ?? 0);
                if ($interval >= 1) {
                    $this->model->saveReminder($interval);
                } else {
                    $error = "Reminder interval must be at least 1 minute!";
                }
            }

            if (isset($_POST['endSession'])) {
                $count = $this->model->getTodayIntake();
                $historyData = $this->model->getAllData();
                $today = date('Y-m-d');
                if ($count > 0) {
                    $historyData[$today]['glasses'] = $count;
                    setcookie("water_intake", json_encode($historyData), time() + 86400*30, "/");
                }
            }
        }

        $glasses = $this->model->getTodayIntake();
        $goal = $this->model->getGoal();
        $reminder = $this->model->getReminder();
        $history = $this->model->getAllData();

        require "/../view/WaterIntake.php";
    }
}
