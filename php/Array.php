<?php

$arr = [
    ['1','2','3','A'],
    ['1','2','B','C'],
    ['1','D','E','F']
];

echo "<table border='1' cellpadding='10' cellspacing='0'>";
echo "<tr>";

echo "<td>";
for ($i = 0; $i < 3; $i++) {
    for ($j = 0; $j < 3 - $i; $j++) {
        echo $arr[$i][$j] . " ";
    }
    echo "<br>";
}
echo "</td>";

echo "<td>";
$letters = [];
for ($i = 0; $i < 3; $i++) {
    for ($j = 0; $j < 4; $j++) {
        $char = $arr[$i][$j];
        if (($char >= 'A' && $char <= 'Z') || ($char >= 'a' && $char <= 'z')) {
            $letters[] = $char;
        }
    }
}

$index = 0;
for ($i = 1; $i <= 3; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo $letters[$index++] . " ";
    }
    echo "<br>";
}
echo "</td>";

echo "</tr>";
echo "</table>";
?>