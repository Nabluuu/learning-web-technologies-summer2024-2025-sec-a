<?php

$x=7;
$y=13;
$z=23;

if($x>=$y && $x>=$z){
    echo"$x is the largest Number";
}
elseif($y>=$x && $y>=$z){
    echo"$y is the largest Number";    
}
elseif($z>=$y && $z>=$x){
    echo"$z is the largest Number"; 
}
?>