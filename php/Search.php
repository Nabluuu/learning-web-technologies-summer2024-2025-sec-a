<?php
$array = [7, 13, 10, 23, 1];
$search = 7;
$found = false;

for ($i = 0; $i < count($array); $i++) {
    if ($array[$i] == $search) {
        $found = true;
        break;
    }
}

if ($found) {
    echo "$search  found ";
} else {
    echo "$search  not found ";
}
?>