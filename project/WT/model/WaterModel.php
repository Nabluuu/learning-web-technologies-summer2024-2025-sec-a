<?php
class WaterModel {
    private $cookieName = "water_intake";
    private $reminderCookie = "water_reminder";


    public function getTodayIntake(): int {
        $today = date('Y-m-d');
        $data = $this->getAllData();
        return $data[$today]['glasses'] ?? 0;
    }

    public function saveIntake(int $glasses) {
        $today = date('Y-m-d');
        $data = $this->getAllData();
        $data[$today]['glasses'] = $glasses;
        setcookie($this->cookieName, json_encode($data), time() + 86400*30, "/");
    }

    public function saveReminder(int $minutes) {
        setcookie($this->reminderCookie, $minutes, time() + 86400*30, "/");
    }

    public function getReminder(): int {
        return $_COOKIE[$this->reminderCookie] ?? 0;
    }

    public function getAllData(): array {
        if(isset($_COOKIE[$this->cookieName])) {
            return json_decode($_COOKIE[$this->cookieName], true);
        }
        return [];
    }


    public function validateGoal(int $goal): bool {
        return $goal >= 1;
    }

    public function getGoal(): int {
        $today = date('Y-m-d');
        $data = $this->getAllData();
        return $data[$today]['goal'] ?? 8;
    }

    public function saveGoal(int $goal) {
        $today = date('Y-m-d');
        $data = $this->getAllData();
        $data[$today]['goal'] = $goal;
        $data[$today]['glasses'] = 0; 
        setcookie($this->cookieName, json_encode($data), time() + 86400*30, "/");
    }
}
